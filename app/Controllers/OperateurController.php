<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\OperationModel;
use App\Models\ClientModel;
use App\Models\TypeOperationModel;


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


}