<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MouvementModel;
use App\Models\TypeMouvementModel;
use App\Models\OperationModel;
use App\Models\TypeOperationModel;
use App\Models\BaremeFraisModel;
use App\Models\ClientModel;
use App\Models\CommissionAutreOperateurModel;
use App\Models\SoldeModel;
use App\Models\PrefixeModel;
use App\Models\CommissionOperateurModel;
class MvmntController extends BaseController
{
    protected $db;


    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }


    public function depot()
    {
        $idClient = session()->get('id_client');
        $montant = (int)$this->request->getPost('montant');


        if (!$idClient) {
            return $this->response->setJSON([
                'success'=>false,
                'error'=>"Utilisateur non connecté"
            ]);
        }


        if ($montant <= 0) {
            return $this->response->setJSON([
                'success'=>false,
                'error'=>"Montant invalide"
            ]);
        }


        $operationModel = new OperationModel();
        $mvmntModel = new MouvementModel();
        $typeMouvementModel = new TypeMouvementModel();


        $idCredit = $typeMouvementModel->getIdByNom('Credit');


        $this->db->transBegin();


        try {

            $idOperation = $operationModel->insert([

                'id_type_operation'=>1,
                'client_source'=>null,
                'client_destination'=>$idClient,
                'montant'=>$montant,
                'frais'=>0

            ], true);



            $mvmntModel->insert([

                'id_operation'=>$idOperation,
                'id_client'=>$idClient,
                'id_type_mouvement'=>$idCredit,
                'montant'=>$montant

            ]);


            $this->db->transCommit();


            return $this->response->setJSON([

                'success'=>true,
                'id_operation'=>$idOperation

            ]);


        } catch(\Exception $e){

            $this->db->transRollback();

            return $this->response->setJSON([

                'success'=>false,
                'error'=>$e->getMessage()

            ]);
        }
    }




    public function retrait(){
        $idClient = session()->get('id_client');
        $montant = (int)$this->request->getPost('montant');


        if (!$idClient) {
            return $this->response->setJSON([
                'success'=>false,
                'error'=>"Utilisateur non connecté"
            ]);
        }


        $operationModel = new OperationModel();
        $mvmntModel = new MouvementModel();
        $typeMouvementModel = new TypeMouvementModel();
        $baremeModel = new BaremeFraisModel();
        $soldeModel = new SoldeModel();



        $solde = $soldeModel->calculerSolde($idClient);



        $bareme = $baremeModel->trouverBareme(2,$montant);

        $frais = $bareme ? (int)$bareme['frais'] : 0;


        $montantTotal = $montant + $frais;



        if($solde < $montantTotal){

            return $this->response->setJSON([

                'success'=>false,
                'error'=>"Solde insuffisant"

            ]);
        }



        $idDebit = $typeMouvementModel->getIdByNom('Debit');



        $this->db->transBegin();


        try{


            $idOperation = $operationModel->insert([

                'id_type_operation'=>2,
                'client_source'=>$idClient,
                'client_destination'=>null,
                'montant'=>$montant,
                'frais'=>$frais

            ],true);



            $mvmntModel->insert([

                'id_operation'=>$idOperation,
                'id_client'=>$idClient,
                'id_type_mouvement'=>$idDebit,
                'montant'=>$montantTotal

            ]);



            $this->db->transCommit();


            return $this->response->setJSON([

                'success'=>true,
                'frais'=>$frais

            ]);



        }catch(\Exception $e){


            $this->db->transRollback();


            return $this->response->setJSON([

                'success'=>false,
                'error'=>$e->getMessage()

            ]);

        }
    }

    private function getDestinataires(): array{
    $telephones =
        $this->request->getPost('telephones');


    // Cas MVOLA
    if (is_array($telephones)) {

        $resultat = [];

        foreach ($telephones as $telephone) {

            $telephone = trim($telephone);

            if (!empty($telephone)) {

                $resultat[] = $telephone;

            }

        }

        return $resultat;
    }


    // Cas transfert simple
    $telephone =
        trim(
            $this->request->getPost(
                'telephoneDestinataire'
            )
        );


    if (!empty($telephone)) {

        return [$telephone];

    }


    return [];
}


    public function getSolde(int $idClient)
    {
        $soldeModel = new SoldeModel();


        return $this->response->setJSON([

            'solde'=>$soldeModel->calculerSolde($idClient)

        ]);
    }




    public function formOperation()
    {
        $typeOperationModel = new TypeOperationModel();


        return view('client/operation',[

            'types'=>$typeOperationModel->findAll()

        ]);
    }

private function transfertSimple(int $idClientSource, string $telephoneDestinataire, int $montant, bool $ajouterRetrait = false)
{
    $telephoneSource = session()->get('telephone');
    $clientModel = new ClientModel();
    $prefixModel = new PrefixeModel();
    $baremeModel = new BaremeFraisModel();
    $configModel = new CommissionAutreOperateurModel();
    $soldeModel = new SoldeModel();
    $operationModel = new OperationModel();
    $mvmntModel = new MouvementModel();
    $typeMouvementModel = new TypeMouvementModel();
    $commissionModel = new CommissionOperateurModel();

    if (empty($telephoneSource)) return ['success' => false, 'error' => 'Numéro source introuvable'];

    $prefixSource = substr($telephoneSource, 0, 3);
    $prefixDestination = substr($telephoneDestinataire, 0, 3);
    $idOperateurSource = $prefixModel->getIdOperateurByPrefix($prefixSource);
    $idOperateurDestination = $prefixModel->getIdOperateurByPrefix($prefixDestination);

    if ($idOperateurSource === null) return ['success' => false, 'error' => 'Opérateur source introuvable'];
    if ($idOperateurDestination === null) return ['success' => false, 'error' => 'Opérateur destination introuvable'];

    $memeOperateur = false;
    if ($idOperateurSource === $idOperateurDestination) $memeOperateur = true;

    $idClientDestinataire = $clientModel->getIdByTelephone($telephoneDestinataire);

    if ($idClientDestinataire && $idClientSource == $idClientDestinataire) {
        return ['success' => false, 'error' => 'Impossible de transférer vers votre propre numéro'];
    }

    // Frais de transfert
    $bareme = $baremeModel->trouverBareme(3, $montant);
    $frais = $bareme ? (int) $bareme['frais'] : 0;

    // Frais de retrait uniquement pour le même opérateur
    $fraisRetrait = 0;
    if ($memeOperateur && $ajouterRetrait) {
        $baremeRetrait = $baremeModel->trouverBareme(2, $montant);
        $fraisRetrait = $baremeRetrait ? (int) $baremeRetrait['frais'] : 0;
    }

    // Commission uniquement pour un autre opérateur
    $pourcentage = 0;
    $commission = 0;

    if (!$memeOperateur) {
        $pourcentage = $configModel->trouverCommission($idOperateurDestination);
        $commission = (int) round($montant * $pourcentage / 100);
    }

    $montantTotal = $montant + $frais + $fraisRetrait + $commission;
    $solde = $soldeModel->calculerSolde($idClientSource);

    if ($solde < $montantTotal) return ['success' => false, 'error' => 'Solde insuffisant'];

    $idDebit = $typeMouvementModel->getIdByNom('Debit');
    $idCredit = $typeMouvementModel->getIdByNom('Credit');

    $this->db->transBegin();                                          

    try {
        // Création opération
        $idOperation = $operationModel->insert([
            'id_type_operation' => 3,
            'client_source' => $idClientSource,
            'client_destination' => $idClientDestinataire,
            'telephone_destination' => $telephoneDestinataire,
            'montant' => $montant,
            'frais' => $frais + $fraisRetrait
        ], true);

        if (!$idOperation) {
            throw new \Exception('Erreur création opération : ' . implode(', ', $operationModel->errors()));
        }

        // Enregistrement commission autre opérateur
        if (!$memeOperateur && $commission > 0) {
            $commissionId = $commissionModel->insert([
                'operateur_source' => (int) $idOperateurSource,
                'operateur_destination' => (int) $idOperateurDestination,
                'commission' => (int) $commission
            ]);

            if (!$commissionId) {
                throw new \Exception('Erreur enregistrement commission : ' . implode(', ', $commissionModel->errors()));
            }
        }

        // Débit source
        $debit = $mvmntModel->insert([
            'id_operation' => $idOperation,
            'id_client' => $idClientSource,
            'id_type_mouvement' => $idDebit,
            'montant' => (int) $montantTotal
        ]);

        if (!$debit) {
            throw new \Exception('Erreur débit du compte : ' . implode(', ', $mvmntModel->errors()));
        }

        // Crédit destinataire
        if ($idClientDestinataire) {
            $credit = $mvmntModel->insert([
                'id_operation' => $idOperation,
                'id_client' => $idClientDestinataire,
                'id_type_mouvement' => $idCredit,
                'montant' => (int) $montant
            ]);

            if (!$credit) {
                throw new \Exception('Erreur crédit du destinataire : ' . implode(', ', $mvmntModel->errors()));
            }
        }

        if ($this->db->transStatus() === false) {
            throw new \Exception('Erreur pendant la transaction');
        }

        $this->db->transCommit();

        return [
            'success' => true,
            'message' => 'Transfert effectué',
            'destinataire' => $telephoneDestinataire,
            'montant' => $montant,
            'frais' => $frais,
            'fraisRetrait' => $fraisRetrait,
            'pourcentage' => $pourcentage,
            'commission' => $commission,
            'total' => $montantTotal,
            'meme_operateur' => $memeOperateur
        ];

    } catch (\Exception $e) {
        $this->db->transRollback();
        return ['success' => false, 'error' => $e->getMessage()];
    }
}

private function transfertMultiple(int $idClientSource, array $destinataires, int $montant){
    $nombre = count($destinataires);

    if ($nombre <= 0) {
        return $this->erreur('Aucun destinataire');
    }

    if ($montant < $nombre) {
        return $this->erreur('Montant insuffisant pour le nombre de destinataires');
    }

    $montantParDestinataire = intdiv($montant, $nombre);
    $ajouterRetrait = $this->request->getPost('ajouterRetrait') === '1';

    $prefixModel = new PrefixeModel();
    $telephoneSource = session()->get('telephone');
    $prefixSource = substr($telephoneSource, 0, 3);
    $idOperateurSource = $prefixModel->getIdOperateurByPrefix($prefixSource);

    if ($idOperateurSource === null) {
        return $this->erreur('Opérateur source introuvable');
    }

    foreach ($destinataires as $telephone) {
        $prefix = substr($telephone, 0, 3);
        $idOperateurDestination = $prefixModel->getIdOperateurByPrefix($prefix);

        if ($idOperateurDestination === null) {
            return $this->erreur('Opérateur introuvable pour : ' . $telephone);
        }

        if ($idOperateurDestination !== $idOperateurSource) {
            return $this->erreur(
                'Tous les destinataires doivent être du même opérateur'
            );
        }
    }

    foreach ($destinataires as $telephone) {
        $resultat = $this->transfertSimple(
            $idClientSource,
            $telephone,
            $montantParDestinataire,
            $ajouterRetrait
        );

        if (!$resultat['success']) {
            return $this->erreur($resultat['error']);
        }
    }

    return $this->response->setJSON([
        'success' => true,
        'message' => 'Transferts multiples effectués',
        'nombre' => $nombre,
        'montantParDestinataire' => $montantParDestinataire,
        'ajouterRetrait' => $ajouterRetrait
    ]);
}

public function transfert()
{
    $idClientSource = session()->get('id_client');

    if (!$idClientSource) {
        return $this->response->setJSON([
            'success' => false,
            'error' => 'Utilisateur non connecté'
        ]);
    }

    $montant = (int) $this->request->getPost('montant');

    if ($montant <= 0) {
        return $this->response->setJSON([
            'success' => false,
            'error' => 'Montant invalide'
        ]);
    }

    $destinataires = $this->getDestinataires();

    if (empty($destinataires)) {
        return $this->response->setJSON([
            'success' => false,
            'error' => 'Numéro du destinataire obligatoire'
        ]);
    }

    if (count($destinataires) > 1) {

        $resultat = $this->transfertMultiple(
            $idClientSource,
            $destinataires,
            $montant
        );

    } else {

        $ajouterRetrait =
            $this->request->getPost('ajouterRetrait') === '1';

        $resultat = $this->transfertSimple(
            $idClientSource,
            $destinataires[0],
            $montant,
            $ajouterRetrait
        );
    }

    return $this->response->setJSON($resultat);
}
}