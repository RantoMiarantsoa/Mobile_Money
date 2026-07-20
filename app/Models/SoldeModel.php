<?php

namespace App\Models;

use CodeIgniter\Model;

class SoldeModel extends Model
{
    protected $table = 'v_solde_client';
    protected $primaryKey = 'id_client';
    protected $returnType = 'array';


 public function listeComptesClients()
{
    return $this
        ->distinct()
        ->select('
            v.id_client,
            v.nom,
            v.telephone,
            v.solde,
            COALESCE(o.nom, "Inconnu") AS operateur
        ')
        ->from('v_solde_client v')
        ->join(
            'prefixe p',
            'SUBSTR(v.telephone,1,3) = p.code',
            'left'
        )
        ->join(
            'operateur o',
            'o.id = p.id_operateur',
            'left'
        )
        ->orderBy('v.nom','ASC')
        ->findAll();
}

    public function calculerSolde($idClient): int
    {
        $row = $this
            ->where('id_client', $idClient)
            ->first();

        return (int) ($row['solde'] ?? 0);
    }
}