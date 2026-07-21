<?php

namespace App\Models;

use CodeIgniter\Model;

class OperateurModel extends Model
{
    protected $table         = 'operateur';
    protected $primaryKey    = 'id';
    protected $allowedFields = ['nom'];
    protected $returnType    = 'array';
    protected $useTimestamps = false;

    protected $validationRules = [
        'nom' => 'required|min_length[2]|max_length[100]|is_unique[operateur.nom,id,{id}]',
    ];

    protected $validationMessages = [
        'nom' => [
            'required'   => "Le nom de l'opérateur est obligatoire.",
            'min_length' => "Le nom de l'opérateur doit contenir au moins 2 caractères.",
            'is_unique'  => 'Cet opérateur existe déjà.',
        ],
    ];

    protected $skipValidation = false;
}
