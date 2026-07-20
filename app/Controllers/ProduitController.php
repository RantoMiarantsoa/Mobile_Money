<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class ProduitController extends BaseController
{
    public function index()
    {
        $produitModel = new \App\Models\ProduitModel();
        $produits = $produitModel->findAll();

        return view('Produit/Index', ['produits' => $produits]);
    }

    public function create()
    {
        
        return view('Produit/Create');
    }
}
