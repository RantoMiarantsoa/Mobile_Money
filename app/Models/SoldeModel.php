<?php

namespace App\Models;

use CodeIgniter\Model;

class SoldeModel extends Model
{
    protected $table = 'v_solde_client';
    protected $primaryKey = 'id_client';
    protected $returnType = 'array';


    public function calculerSolde($idClient): int
    {
        $row = $this->where('id_client', $idClient)
                    ->first();

        return (int) ($row['solde'] ?? 0);
    }
}