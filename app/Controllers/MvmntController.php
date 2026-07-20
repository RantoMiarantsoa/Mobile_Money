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




public function transfert()
{
    $idClientSource = session()->get('id_client');

    $telephoneDestinataire = trim(
        $this->request->getPost('telephoneDestinataire')
    );

    
    $montant = (int)$this->request->getPost('montant');


    $clientModel = new ClientModel();
    $operationModel = new OperationModel();
    $mvmntModel = new MouvementModel();
    $typeMouvementModel = new TypeMouvementModel();
    $baremeModel = new BaremeFraisModel();
    $soldeModel = new SoldeModel();



    // Recherche du destinataire
    // Peut retourner null si le numéro n'existe pas
    $idClientDestinataire =
        $clientModel->getIdByTelephone($telephoneDestinataire);



    // Calcul frais transfert
    $bareme = $baremeModel->trouverBareme(3, $montant);

    $frais = $bareme ? (int)$bareme['frais'] : 0;


    $montantTotal = $montant + $frais;


    // Vérification solde
    $solde =
        $soldeModel->calculerSolde($idClientSource);



    if($solde < $montantTotal){

        return $this->response->setJSON([

            'success'=>false,
            'error'=>"Solde insuffisant"

        ]);

    }

   



    $idDebit =
        $typeMouvementModel->getIdByNom('Debit');


    $idCredit =
        $typeMouvementModel->getIdByNom('Credit');



    $this->db->transBegin();


    try{


        // Création opération
        $idOperation = $operationModel->insert([

            'id_type_operation'=>3,

            'client_source'=>$idClientSource,

            // Peut être NULL si inconnu
            'client_destination'=>$idClientDestinataire,

            // On garde toujours le numéro
            'telephone_destination'=>$telephoneDestinataire,

            'montant'=>$montant,

            'frais'=>$frais


        ],true);



        if(!$idOperation){

            throw new \Exception(
                "Erreur création opération"
            );

        }



        // Débit de l'expéditeur
        $mvmntModel->insert([

            'id_operation'=>$idOperation,

            'id_client'=>$idClientSource,

            'id_type_mouvement'=>$idDebit,

            'montant'=>$montantTotal

        ]);




        // Crédit seulement si le client existe
        if($idClientDestinataire){

            $mvmntModel->insert([

                'id_operation'=>$idOperation,

                'id_client'=>$idClientDestinataire,

                'id_type_mouvement'=>$idCredit,

                'montant'=>$montant

            ]);

        }



        $this->db->transCommit();



        return $this->response->setJSON([

            'success'=>true,

            'message'=>"Transfert effectué",

            'frais'=>$frais,

            'destinataire'=>$telephoneDestinataire

        ]);



    }catch(\Exception $e){


        $this->db->transRollback();


        return $this->response->setJSON([

            'success'=>false,

            'error'=>$e->getMessage()

        ]);

    }
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

}