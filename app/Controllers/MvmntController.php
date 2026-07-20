<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MouvementModel;
use App\Models\TypeMouvementModel;
use App\Models\OperationModel;
use App\Models\TypeOperationModel;
use App\Models\BaremeFraisModel;
use App\Models\ClientModel;
use App\Models\SoldeModel;
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

        // Depot = type_operation 1
        $idOperation = $operationModel->insert([
            'id_type_operation'=>1,
            'client_source'=>null,
            'client_destination'=>$idClient,
            'montant'=>$montant,
            'frais'=>0
        ],true);


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


    }catch(\Exception $e){

        $this->db->transRollback();

        return $this->response->setJSON([
            'success'=>false,
            'error'=>$e->getMessage()
        ]);
    }
}



public function retrait()
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


    $mvmntModel = new MouvementModel();
    $operationModel = new OperationModel();
    $typeMouvementModel = new TypeMouvementModel();
    $baremeModel = new BaremeFraisModel();

$soldeModel = new SoldeModel();

$solde = $soldeModel->calculerSolde($idClient);

    // Récupération frais retrait
    $bareme = $baremeModel->trouverBareme(2, $montant);

    $frais = $bareme ? (int)$bareme['frais'] : 0;


    $montantTotal = $montant + $frais;



    if ($solde < $montantTotal) {

        return $this->response->setJSON([
            'success'=>false,
            'error'=>"Solde insuffisant",
            'solde'=>$solde,
            'demande'=>$montantTotal
        ]);
    }



    $idDebit = $typeMouvementModel->getIdByNom('Debit');


    if (!$idDebit) {
        return $this->response->setJSON([
            'success'=>false,
            'error'=>"Type Debit introuvable"
        ]);
    }



    $this->db->transBegin();


    try {


        // Création opération
        $idOperation = $operationModel->insert([

            'id_type_operation'=>2,
            'client_source'=>$idClient,
            'client_destination'=>null,
            'montant'=>$montant,
            'frais'=>$frais

        ], true);



        if (!$idOperation) {

            throw new \Exception(
                implode(
                    ",",
                    $operationModel->errors()
                )
            );

        }



        // Mouvement débit
        $ok = $mvmntModel->insert([

            'id_operation'=>$idOperation,
            'id_client'=>$idClient,
            'id_type_mouvement'=>$idDebit,
            'montant'=>$montantTotal

        ]);



        if (!$ok) {

            throw new \Exception(
                implode(
                    ",",
                    $mvmntModel->errors()
                )
            );

        }



        $this->db->transCommit();


        return $this->response->setJSON([

            'success'=>true,
            'id_operation'=>$idOperation,
            'frais'=>$frais,
            'solde_avant'=>$solde,
            'solde_apres'=>$solde-$montantTotal

        ]);



    } catch(\Exception $e) {


        $this->db->transRollback();


        return $this->response->setJSON([

            'success'=>false,
            'error'=>$e->getMessage()

        ]);
    }
}



public function transfert()
{
    $idClientSource = session()->get('id_client');

    $telephoneDestinataire = trim(
        $this->request->getPost('telephoneDestinataire')
    );

    $montant = (int) $this->request->getPost('montant');


    if (!$idClientSource) {

        return $this->response->setJSON([
            'success'=>false,
            'error'=>"Utilisateur non connecté"
        ]);
    }


    if (empty($telephoneDestinataire)) {

        return $this->response->setJSON([
            'success'=>false,
            'error'=>"Numéro du destinataire obligatoire"
        ]);
    }


    if ($montant <= 0) {

        return $this->response->setJSON([
            'success'=>false,
            'error'=>"Montant invalide"
        ]);
    }



    $clientModel = new ClientModel();
    $mvmntModel = new MouvementModel();
    $operationModel = new OperationModel();
    $typeMouvementModel = new TypeMouvementModel();
    $baremeModel = new BaremeFraisModel();


$soldeModel = new SoldeModel();



    // Recherche du destinataire par téléphone

    $idClientDestinataire = $clientModel
        ->getIdByTelephone($telephoneDestinataire);



    if (!$idClientDestinataire) {

        return $this->response->setJSON([
            'success'=>false,
            'error'=>"Destinataire introuvable"
        ]);
    }



    // Empêcher transfert vers soi-même

    if ($idClientSource == $idClientDestinataire) {

        return $this->response->setJSON([
            'success'=>false,
            'error'=>"Impossible de transférer vers votre propre numéro"
        ]);
    }


 $bareme = $baremeModel->trouverBareme(3, $montant);

    $frais = $bareme ? (int)$bareme['frais'] : 0;


    $montantTotal = $montant + $frais;
  
$solde = $soldeModel->calculerSolde($idClientSource);




    if ($solde < $montantTotal) {

        return $this->response->setJSON([
            'success'=>false,
            'error'=>"Solde insuffisant"
        ]);
    }




    // Types mouvement

    $idDebit = $typeMouvementModel
        ->getIdByNom('Debit');


    $idCredit = $typeMouvementModel
        ->getIdByNom('Credit');




    $this->db->transBegin();


    try {


        // Création opération
        // Transfert = id_type_operation 3

        $idOperation = $operationModel->insert([

            'id_type_operation'=>3,

            'client_source'=>$idClientSource,

            'client_destination'=>$idClientDestinataire,

            'montant'=>$montant,

            'frais'=>$frais

        ], true);



        if(!$idOperation){

            throw new \Exception(
                "Erreur création opération"
            );
        }




        // Débit du compte source

        $debit = $mvmntModel->insert([

            'id_operation'=>$idOperation,

            'id_client'=>$idClientSource,

            'id_type_mouvement'=>$idDebit,

            'montant'=>$montantTotal

        ]);




        // Crédit du destinataire

        $credit = $mvmntModel->insert([

            'id_operation'=>$idOperation,

            'id_client'=>$idClientDestinataire,

            'id_type_mouvement'=>$idCredit,

            'montant'=>$montant

        ]);



        if(!$debit || !$credit){

            throw new \Exception(
                "Erreur enregistrement mouvement"
            );
        }




        $this->db->transCommit();



        return $this->response->setJSON([

            'success'=>true,

            'message'=>"Transfert effectué avec succès",

            'id_operation'=>$idOperation,
            'frais'=>$frais

        ]);



    } catch(\Exception $e){


        $this->db->transRollback();



        return $this->response->setJSON([

            'success'=>false,

            'error'=>$e->getMessage()

        ]);

    }

}
    public function getSolde(int $idClient)
    {
        $mouvementModel = new MouvementModel();

        return $this->response->setJSON(['solde' => $mouvementModel->calculerSolde($idClient)]);
    }

    public function formOperation()
    {
        $typeOperationModel = new TypeOperationModel();

        return view('client/operation', [
            'types' => $typeOperationModel->findAll(),
        ]);
    }
}