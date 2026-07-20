<?php

namespace App\Controllers;

class ClientController extends BaseController
{

    public function accueil()
    {
        if(!session()->get('connecte')){
            return redirect()->to('/login');
        }


        return view('client/accueil',[
            'nom'=>session()->get('nom'),
            'telephone'=>session()->get('telephone')
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

}