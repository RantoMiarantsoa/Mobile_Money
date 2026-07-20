<?php
namespace App\Controllers;

use App\Controllers\BaseController;

use CodeIgniter\HTTP\ResponseInterface;
use App\Models\CaisseModel;
use App\Models\AchatModel;
use App\Models\ProduitModel;

class AchatController extends BaseController
{
     public function index()
    {
        if (! session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        // Récupérer depuis GET ou session
        $caisse_id = $this->request->getGet('caisse') ?? session()->get('caisse_id');

        if (!$caisse_id) {
            return redirect()->to('/caisse');
        }

        // Stocker en session
        session()->set('caisse_id', $caisse_id);

        $caisseModel = new CaisseModel();
        $achatModel = new AchatModel();
        $produitModel = new ProduitModel();

        $caisse = $caisseModel->find($caisse_id);
        $achats = $achatModel->getAchatProduit($caisse_id);
        $produits = $produitModel->findAll();

        return view('achat/SaisieAchat', [
            'caisse' => $caisse,
            'achats' => $achats,
            'produits' => $produits
        ]);
    }

    public function create()
    {
        if (! session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $produitId = $this->request->getPost('produit');
        $quantite  = $this->request->getPost('quantite');

        if (empty($produitId) || empty($quantite)) {
            return redirect()->back()->with('error', 'Produit et quantité requis');
        }

        $achatModel = new \App\Models\AchatModel();
        $achatModel->insert([
            'produit_id' => $produitId,
            'quantite'   => $quantite,
            'caisse_id'  => session()->get('caisse_id'),
             'user_id'    => session()->get('user_id'),
        ]);

        return redirect()->to('/achat');
    }

    public function cloturer()
    {
        if (! session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $caisseId = session()->get('caisse_id');

        if (! $caisseId) {
            return redirect()->to('/caisse')->with('error', 'Aucune caisse sélectionnée');
        }

        $achatModel = new \App\Models\AchatModel();
        $achatModel->where('caisse_id', $caisseId)->delete();

        return redirect()->to('/achat')->with('success', 'Achat clôturé avec succès');
    }

    public function getAllAchatByCaisse($id)
    {
        session()->set('caisse_id', $id);

        return $this->index();
    }
}