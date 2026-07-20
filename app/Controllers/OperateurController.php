<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\OperationModel;
use App\Models\ClientModel;
use App\Models\TypeOperationModel;
use App\Models\OperateurModel;
use App\Models\BaremeFraisModel;
use App\Models\PrefixeModel;
use App\Models\CompteClientModel;


class OperateurController extends BaseController
{

    public function dashboard()
    {

        $operationModel = new OperationModel();
        $clientModel    = new ClientModel();


        $data = [

            'nombreClients' => $clientModel->countAll(),

            'nombreOperations' => $operationModel->countAll(),

            'gainRetrait' => $operationModel->gainTotalRetrait(),

            'gainTransfert' => $operationModel->gainTotalTransfert(),

            'gainTotal' => $operationModel->gainTotal(),

        ];


        return view('operateur/dashboard', $data);

    }

    public function gains()
    {

        $operationModel = new OperationModel();

        $data = [

            'gainRetrait' => 
                $operationModel->gainTotalRetrait(),


            'gainTransfert' => 
                $operationModel->gainTotalTransfert(),


            'gainTotal' => 
                $operationModel->gainTotal(),

        ];


        return view('operateur/gains', $data);

    }


    public function clients()
    {

        $clientModel = new ClientModel();


        $data = [

            'clients' => $clientModel->findAll()

        ];


        return view('operateur/clients', $data);

    }

    public function operateurs()
    {
    $operateurModel = new OperateurModel();

    $data = [
        'operateurs' => $operateurModel->findAll()
    ];

    return view('operateur/operateurs', $data);
    }

    public function baremes()
    {
    $baremeModel = new BaremeFraisModel();


    $data = [
        'baremes' => $baremeModel->listeBaremes()
    ];

    return view(
        'operateur/baremes',
        $data
    );
    }

    public function prefixes()
{
    $prefixeModel = new PrefixeModel();

    $data = [
        'prefixes' => $prefixeModel->listePrefixes()
    ];

    return view('operateur/prefixes',$data);

}
  public function comptesClients()
{

    $compteClientModel = new CompteClientModel();


    $data = [

        'comptes' => $compteClientModel->listeComptesClients()

    ];


    return view(
        'operateur/comptes_clients',
        $data
    );

}
}