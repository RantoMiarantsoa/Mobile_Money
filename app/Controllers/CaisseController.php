<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\CaisseModel;


class CaisseController extends BaseController
{
    public function index()
    {
        if (! session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $caisseModel = new CaisseModel();
        $caisses = $caisseModel->getAll();

        return view('caisse/caisse', ['caisses' => $caisses]);
    }

    
}

