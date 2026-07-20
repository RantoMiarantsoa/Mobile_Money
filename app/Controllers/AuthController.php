<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ClientModel;

class AuthController extends BaseController
{

public function login()
{
    // Si déjà connecté, aller directement à l'accueil
    if(session()->get('connecte')){
        return redirect()->to('/client');
    }

    return view('auth/login');
}

    public function authentifier()
    {

        $telephone = trim(
            $this->request->getPost('telephone')
        );


        if(empty($telephone)){

            return view('auth/login',[
                'error'=>"Veuillez entrer un numéro."
            ]);
        }


        $clientModel = new ClientModel();


        // Recherche par téléphone
        $client = $clientModel
            ->where('telephone', $telephone)
            ->first();



        if(!$client){

            return view('auth/login',[
                'error'=>"Numéro incorrect : ".$telephone
            ]);

        }



        // Création de la session client

        session()->set([

            'id_client' => $client['id'],

            'telephone' => $client['telephone'],

            'nom' => $client['nom'],

            'connecte' => true

        ]);



        // Redirection vers accueil client

        return redirect()->to('/client');

    }



    public function logout()
    {

        session()->destroy();

        return redirect()->to('/login');

    }

}