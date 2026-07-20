<?php

namespace App\Models;

use CodeIgniter\Model;

class BaremeFraisModel extends Model
{
    protected $table         = 'bareme_frais';
    protected $primaryKey    = 'id';
    protected $allowedFields = ['id_type_operation', 'montant_min', 'montant_max', 'frais'];
    protected $returnType    = 'array';
    protected $useTimestamps = false;

    protected $validationRules = [
        'id_type_operation' => 'required|integer|is_not_unique[type_operation.id]',
        'montant_min'       => 'required|integer|greater_than_equal_to[0]',
        'montant_max'       => 'required|integer|callback_montantMaxSuperieurAMin',
        'frais'             => 'required|integer|greater_than_equal_to[0]',
    ];

    protected $validationMessages = [
        'id_type_operation' => [
            'required'      => "Le type d'opération est obligatoire.",
            'is_not_unique' => "Ce type d'opération n'existe pas.",
        ],
        'montant_min' => [
            'required'              => 'Le montant minimum est obligatoire.',
            'greater_than_equal_to' => 'Le montant minimum doit être positif ou nul.',
        ],
        'montant_max' => [
            'required' => 'Le montant maximum est obligatoire.',
        ],
        'frais' => [
            'required'              => 'Le frais est obligatoire.',
            'greater_than_equal_to' => 'Le frais doit être positif ou nul.',
        ],
    ];

    protected $skipValidation = false;

    /**
     * Règle personnalisée : le montant_max doit être strictement supérieur
     * au montant_min de la même tranche.
     */
    public function montantMaxSuperieurAMin(string $montantMax, string $fields, array $data, ?string &$error = null): bool
    {
        if ((int) $montantMax <= (int) ($data['montant_min'] ?? 0)) {
            $error = 'Le montant maximum doit être supérieur au montant minimum.';
            return false;
        }

        return true;
    }

    /**
     * Retourne le barème applicable pour un type d'opération et un montant donnés.
     */
    public function trouverBareme(int $idTypeOperation, int $montant): ?array
    {
        return $this->where('id_type_operation', $idTypeOperation)
            ->where('montant_min <=', $montant)
            ->where('montant_max >=', $montant)
            ->first();
    }

    public function listeBaremes()
    {
    return $this->select('
            bareme_frais.*,
            type_operation.nom AS type_operation
        ')
        ->join(
            'type_operation',
            'type_operation.id = bareme_frais.id_type_operation'
        )
        ->findAll();
    }
}
