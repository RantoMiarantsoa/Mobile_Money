<?php

namespace App\Models;

use CodeIgniter\Model;

class PrefixeModel extends Model
{
    protected $table         = 'prefixe';
    protected $primaryKey    = 'id';
    protected $allowedFields = ['id_operateur', 'code'];
    protected $returnType    = 'array';
    protected $useTimestamps = false;

    protected $validationRules = [
        'id_operateur' => 'required|integer|is_not_unique[operateur.id]',
        'code'         => 'required|exact_length[3]|numeric|is_unique[prefixe.code,id,{id}]',
    ];

    protected $validationMessages = [
        'id_operateur' => [
            'required'      => "L'opérateur est obligatoire.",
            'integer'       => "L'identifiant de l'opérateur est invalide.",
            'is_not_unique' => "Cet opérateur n'existe pas.",
        ],
        'code' => [
            'required'     => 'Le préfixe est obligatoire.',
            'exact_length' => 'Le préfixe doit contenir exactement 3 chiffres (ex: 033).',
            'numeric'      => 'Le préfixe doit être uniquement composé de chiffres.',
            'is_unique'    => 'Ce préfixe est déjà attribué à un opérateur.',
        ],
    ];

    protected $skipValidation = false;
}
