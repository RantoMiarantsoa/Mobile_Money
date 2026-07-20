<?php

namespace App\Models;

use CodeIgniter\Model;

class OperationModel extends Model
{
    protected $table         = 'operation';
    protected $primaryKey    = 'id';
    protected $allowedFields = [
        'id_type_operation',
        'client_source',
        'client_destination',
        'montant',
        'frais',
        'date_operation',
    ];
    protected $returnType    = 'array';
    protected $useTimestamps = false;

    protected $validationRules = [
        'id_type_operation'  => 'required|integer|is_not_unique[type_operation.id]|callback_coherenceClients',
        'client_source'      => 'permit_empty|integer|is_not_unique[client.id]',
        'client_destination' => 'permit_empty|integer|is_not_unique[client.id]',
        'montant'            => 'required|integer|greater_than[0]',
        'frais'              => 'permit_empty|integer|greater_than_equal_to[0]',
    ];

    protected $validationMessages = [
        'id_type_operation' => [
            'required'      => "Le type d'opération est obligatoire.",
            'is_not_unique' => "Ce type d'opération n'existe pas.",
        ],
        'client_source' => [
            'is_not_unique' => "Le client source n'existe pas.",
        ],
        'client_destination' => [
            'is_not_unique' => "Le client destinataire n'existe pas.",
        ],
        'montant' => [
            'required'     => 'Le montant est obligatoire.',
            'greater_than' => 'Le montant doit être supérieur à 0.',
        ],
        'frais' => [
            'greater_than_equal_to' => 'Le frais doit être positif ou nul.',
        ],
    ];

    protected $skipValidation = false;

    /**
     * Vérifie la cohérence client_source / client_destination selon le type d'opération :
     * - Depot      : uniquement client_destination
     * - Retrait    : uniquement client_source
     * - Transfert  : les deux, et différents l'un de l'autre
     */
    public function coherenceClients(string $idTypeOperation, string $fields, array $data, ?string &$error = null): bool
    {
        $type = new TypeOperationModel()->find((int) $idTypeOperation);

        if (! $type) {
            return true; // déjà couvert par is_not_unique
        }

        $source = $data['client_source'] ?? null;
        $dest   = $data['client_destination'] ?? null;

        switch ($type['nom']) {
            case 'Depot':
                if ($source || ! $dest) {
                    $error = 'Un dépôt doit avoir uniquement un client destinataire.';
                    return false;
                }
                break;

            case 'Retrait':
                if ($dest || ! $source) {
                    $error = 'Un retrait doit avoir uniquement un client source.';
                    return false;
                }
                break;

            case 'Transfert':
                if (! $source || ! $dest) {
                    $error = 'Un transfert nécessite un client source et un client destinataire.';
                    return false;
                }
                if ($source === $dest) {
                    $error = 'Le client source et le client destinataire doivent être différents.';
                    return false;
                }
                break;
        }

        return true;
    }

    /**
     * Calcule le frais applicable à partir du barème pour un type et un montant donnés.
     */
    public function calculerFrais(int $idTypeOperation, int $montant): int
    {
        $bareme = new BaremeFraisModel()->trouverBareme($idTypeOperation, $montant);

        return $bareme ? (int) $bareme['frais'] : 0;
    }


    public function gainTotalRetrait(): int
    {
        $result = $this->where('id_type_operation', 2)
                       ->selectSum('frais')
                       ->first();

        return (int) ($result['frais'] ?? 0);
    }

     public function gainTotalTransfert(): int
    {
        $result = $this->where('id_type_operation', 3)
                       ->selectSum('frais')
                       ->first();

        return (int) ($result['frais'] ?? 0);
    }

     public function gainTotal(): int
    {
        return $this->gainTotalRetrait() + $this->gainTotalTransfert();
    }

}
