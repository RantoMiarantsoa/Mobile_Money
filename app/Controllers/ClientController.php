<?php
namespace App\Controllers;
use App\Models\OperationModel;
use App\Models\SoldeModel;

class ClientController extends BaseController
{

  public function accueil()
{
    if(!session()->get('connecte')){
        return redirect()->to('/login');
    }

  $idClient = session()->get('id_client');

    $soldeModel = new SoldeModel();
    $solde = $soldeModel->calculerSolde($idClient);

    return view('client/accueil',[
        'nom' => session()->get('nom'),
        'telephone' => session()->get('telephone'),
        'solde' => $solde
    ]);
}


    public function depot()
    {
        return view('client/depot');
    }



    public function retrait()
    {
        return view('client/retrait');
    }



    public function transfert()
    {
        return view('client/transfert');
    }
public function historique()
{
    $idClient = session()->get('id_client');

    if(!$idClient){
        return redirect()->to('/login');
    }

    $operationModel = new OperationModel();

    return view('client/historique',[
        'historique'=>$operationModel
            ->getHistoriqueClient($idClient)
    ]);
}
}