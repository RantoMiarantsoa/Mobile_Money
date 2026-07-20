<?php

namespace App\Models;

use CodeIgniter\Model;

class TypeOperationModel extends Model
{
    protected $table         = 'type_operation';
    protected $primaryKey    = 'id';
    protected $allowedFields = ['nom'];
    protected $returnType    = 'array';
    protected $useTimestamps = false;

    protected $validationRules = [
        'nom' => 'required|min_length[2]|max_length[50]|is_unique[type_operation.nom,id,{id}]',
    ];

    protected $validationMessages = [
        'nom' => [
            'required'  => "Le nom du type d'opération est obligatoire.",
            'is_unique' => "Ce type d'opération existe déjà.",
        ],
    ];

    protected $skipValidation = false;

        public function getNomById(int $id): ?int
{
    $type = $this->where('id', $id)->first();

    return $type ? (string) $type['nom'] : null;
}
}
