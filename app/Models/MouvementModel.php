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

    /**
     * Calcule le solde d'un client = somme des crédits reçus - somme des débits effectués,
     * en s'appuyant sur les opérations où il est source ou destinataire.
     * Comme il n'y a pas de table "compte", le solde est toujours recalculé à la volée.
     */
    public function calculerSolde(int $idClient): int
    {
        $db = Database::connect();

        $credit = $db->table('mouvement m')
            ->selectSum('m.montant')
            ->join('operation o', 'o.id = m.id_operation')
            ->join('type_mouvement tm', 'tm.id = m.id_type_mouvement')
            ->where('o.client_destination', $idClient)
            ->where('tm.nom', 'Credit')
            ->get()
            ->getRow('montant');

        $debit = $db->table('mouvement m')
            ->selectSum('m.montant')
            ->join('operation o', 'o.id = m.id_operation')
            ->join('type_mouvement tm', 'tm.id = m.id_type_mouvement')
            ->where('o.client_source', $idClient)
            ->where('tm.nom', 'Debit')
            ->get()
            ->getRow('montant');

        return (int) ($credit ?? 0) - (int) ($debit ?? 0);
    }
}
