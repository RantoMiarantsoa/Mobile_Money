<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ClientModel;
use App\Models\PrefixeModel;

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


    // Vérification du préfixe
    $prefixe = substr($telephone, 0, 3);

    if($prefixe != '034' && $prefixe != '038'){

        return view('auth/login',[
            'error'=>"Le numéro doit commencer par 034 ou 038."
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


    // Création session
    session()->set([

        'id_client' => $client['id'],
        'telephone' => $client['telephone'],
        'nom' => $client['nom'],
        'connecte' => true

    ]);


    return redirect()->to('/client');
}



    public function logout()
    {

        session()->destroy();

        return redirect()->to('/login');

    }

}