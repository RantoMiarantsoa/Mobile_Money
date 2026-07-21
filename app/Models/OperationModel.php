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
    'telephone_destination',
    'montant',
    'frais'
];
    protected $returnType    = 'array';
    protected $useTimestamps = false;

protected $validationRules = [

    'id_type_operation' => 'required|integer',

    'client_source' => 'permit_empty|integer',

    'client_destination' => 'permit_empty|integer',

    'montant' => 'required|integer',

    'frais' => 'permit_empty|integer'

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
  public function coherenceClients($value, string $fields, array $data)
{
    $typeOperationModel = new TypeOperationModel();

    $type = $typeOperationModel->find(
        (int)($data['id_type_operation'] ?? 0)
    );


    if (!$type) {
        return true;
    }


    $source = $data['client_source'] ?? null;
    $dest   = $data['client_destination'] ?? null;



    switch ($type['nom']) {


        case 'Depot':

            if ($source !== null || $dest === null) {

                return false;
            }

            break;



        case 'Retrait':

            if ($dest !== null || $source === null) {

                return false;
            }

            break;



        case 'Transfert':

            if ($source === null || $dest === null) {

                return false;
            }


            if ($source == $dest) {

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
        $bareme = model(BaremeFraisModel::class)->trouverBareme($idTypeOperation, $montant);

        return $bareme ? (int) $bareme['frais'] : 0;
    }

    /**
     * Somme des frais perçus pour un type d'opération donné (par nom : 'Retrait', 'Transfert'...).
     */
    protected function gainParType(string $nomTypeOperation): int
    {
        $result = \Config\Database::connect()
            ->table('operation o')
            ->selectSum('o.frais')
            ->join('type_operation t', 't.id = o.id_type_operation')
            ->where('t.nom', $nomTypeOperation)
            ->get()
            ->getRow('frais');

        return (int) ($result ?? 0);
    }

    public function gainTotalRetrait(): int
    {
        return $this->gainParType('Retrait');
    }

    public function gainTotalTransfert(): int
    {
        return $this->gainParType('Transfert');
    }

    /**
     * Somme de tous les frais perçus, tous types d'opérations confondus.
     */
    public function gainTotal(): int
    {
        $result = \Config\Database::connect()
            ->table('operation')
            ->selectSum('frais')
            ->get()
            ->getRow('frais');

        return (int) ($result ?? 0);
    }

public function getHistoriqueClient($idClient)
{
    return $this
        ->select('
            operation.*,
            type_operation.nom as type_operation,
            cd.telephone as telephone_client
        ')
        ->join(
            'type_operation',
            'type_operation.id = operation.id_type_operation'
        )
        ->join(
            'client cd',
            'cd.id = operation.client_destination',
            'left'
        )
        ->groupStart()

            ->where('operation.client_source',$idClient)

            ->orWhere('operation.client_destination',$idClient)

        ->groupEnd()

        ->orderBy(
            'operation.date_operation',
            'DESC'
        )

        ->findAll();
}
}