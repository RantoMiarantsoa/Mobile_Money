<?php

namespace App\Models;

use CodeIgniter\Model;
use Config\Database;

class MouvementModel extends Model
{
    protected $table         = 'mouvement';
    protected $primaryKey    = 'id';
    protected $allowedFields = ['id_operation', 'id_type_mouvement', 'montant', 'date_mouvement'];
    protected $returnType    = 'array';
    protected $useTimestamps = false;

    protected $validationRules = [
        'id_operation'      => 'required|integer|is_not_unique[operation.id]',
        'id_type_mouvement' => 'required|integer|is_not_unique[type_mouvement.id]',
        'montant'           => 'required|integer|greater_than[0]',
    ];

    protected $validationMessages = [
        'id_operation' => [
            'required'      => "L'opération liée est obligatoire.",
            'is_not_unique' => "Cette opération n'existe pas.",
        ],
        'id_type_mouvement' => [
            'required'      => 'Le type de mouvement est obligatoire.',
            'is_not_unique' => "Ce type de mouvement n'existe pas.",
        ],
        'montant' => [
            'required'     => 'Le montant est obligatoire.',
            'greater_than' => 'Le montant doit être supérieur à 0.',
        ],
    ];

    protected $skipValidation = false;

    
public function calculerSolde($idClient): int
{
    $row = $this->where('id_client', $idClient)
                ->first();

    return (int) ($row['solde'] ?? 0);
}

public function getAllCredit($idClient){
    $row = $this->where('id_client',$idClient)
        ->where('id_type_mouvement',1)
        ->findAll();
    return $row;
    }

    function getAllDebit($idClient){
    $row = $this->where('id_client',$idClient)
        ->where('id_type_mouvement',2)
        ->findAll();
    return $row;
    }
}
