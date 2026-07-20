<?php
namespace App\Models;
use CodeIgniter\Model;

class AchatModel extends Model
{
    protected $table      = 'achat';      // ← obligatoire
    protected $primaryKey = 'id';
    protected $returnType = 'array';      // ← important pour accéder avec []

    protected $allowedFields = [
        'produit_id',
        'caisse_id',
        'quantite',
        'user_id',
    ];



   

  
    public function getByCaisse($id_caisse){
         return $this->where('caisse_id', $id_caisse)->findAll();
    }

    public function getAchatProduit($caisse_id = null)
    {
        $caisse_id = $caisse_id ?? session()->get('caisse_id');

        return $this->select('achat.*, produit.designation, produit.prix AS prix_unitaire')
            ->join('produit', 'produit.id = achat.produit_id')
            ->where('achat.caisse_id', $caisse_id)
            ->findAll();
    }
}

