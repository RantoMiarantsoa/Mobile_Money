<?php

namespace App\Models;

use CodeIgniter\Model;

class TypeMouvementModel extends Model
{
    protected $table         = 'type_mouvement';
    protected $primaryKey    = 'id';
    protected $allowedFields = ['nom'];
    protected $returnType    = 'array';
    protected $useTimestamps = false;

    protected $validationRules = [
        'nom' => 'required|min_length[2]|max_length[50]|is_unique[type_mouvement.nom,id,{id}]',
    ];

    protected $validationMessages = [
        'nom' => [
            'required'  => 'Le nom du type de mouvement est obligatoire.',
            'is_unique' => 'Ce type de mouvement existe déjà.',
        ],
    ];

    protected $skipValidation = false;

      public function getIdByNom(string $nom): ?int
{
    $type = $this->where('nom', $nom)->first();

    return $type ? (int) $type['id'] : null;
}
}
