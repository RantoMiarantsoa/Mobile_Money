<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\MouvementModel;
use App\Models\TypeMouvementModel;
use App\Models\OperationModel;
use App\Models\TypeOperationModel;
use App\Models\BaremeFraisModel;
class MvmntController extends BaseController
{
  public function operation(int $idClientSource,int $idClientDestinataire,int $montant,int $idTypeTransfert){
        if($idClientSource == $idClientDestinataire){
              return ['success' => false, 'error' => 'Le client source et destinataire doivent être différents.'];
        }
    $operationModel = new OperationModel();
    $typeOperationModel = new TypeOperationModel();
    $baremeModel = new BaremeFraisModel();
    $mvmntModel = new MouvementModel();
$typeMouvementModel = new TypeMouvementModel();


$typeOperation = $typeOperationModel->find($idTypeTransfert);

if (!$typeOperation) {
    return [
        'success' => false,
        'error' => "Le type d'opération n'existe pas."
    ];
}

    if (! $idTypeTransfert) {
        return ['success' => false, 'error' => "Le type d'opération  n'existe pas."];
    }

    $nomOperation = $typeOperationModel->getNomById($idTypeTransfert);
$solde = $mvmntModel->calculerSolde($idClientSource);
  $bareme = $baremeModel->trouverBareme((int) $idTypeTransfert, (int) $montant);
        $frais  = $bareme ? (int) $bareme['frais'] : 0;
        $montantTotal = (int) $montant + $frais;

if($solde<$montantTotal){
    return ['success' => false, 'error' => 'Le solde de la client source est insuffisant.'];
}
   $idTypeDebit  = $typeMouvementModel->getIdByNom('Debit');
    $idTypeCredit = $typeMouvementModel->getIdByNom('Credit');


$idOperation = $operationModel->insert([
    'id_type_operation'  => $idTypeTransfert,
    'client_source'      => $idClientSource,
    'client_destination' => $idClientDestinataire,
    'montant'            => $montant,
    'frais'              => $frais,
], true);
    if ($nomOperation === 'Depot') {
            // L'argent entre : un seul crédit chez le client
            $mvmntModel->insert([
                'id_operation'      => $idOperation,
                'id_type_mouvement' => $idTypeCredit,
                'montant'           => $montant,
            ]);
        } elseif ($nomOperation === 'Retrait') {
            // L'argent sort : un seul débit chez le client (montant + frais)
            $mvmntModel->insert([
                'id_operation'      => $idOperation,
                'id_type_mouvement' => $idTypeDebit,
                'montant'           => $montantTotal,
            ]);
        } else {
            // Transfert : débit chez la source (montant + frais), crédit chez le destinataire (montant seul)
            $mvmntModel->insert([
                'id_operation'      => $idOperation,
                'id_type_mouvement' => $idTypeDebit,
                'montant'           => $montantTotal,
            ]);
 
            $mvmntModel->insert([
                'id_operation'      => $idOperation,
                'id_type_mouvement' => $idTypeCredit,
                'montant'           => $montant,
            ]);
        }
return [
    'success' => true,
    'id_operation' => $idOperation
];
    }


    public function getSolde(int $idClient){
      $mouvementModel = new MouvementModel();
      $solde = $mouvementModel->calculerSolde($idClient);

     return $solde;

    }
}