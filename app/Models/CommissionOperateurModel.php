<?php

namespace App\Models;

use CodeIgniter\Model;

class CommissionOperateurModel extends Model
{
    protected $table = 'commission_operateur';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'operateur_source',
        'operateur_destination',
        'commission'
    ];

    protected $returnType = 'array';
    protected $useTimestamps = false;

  
    public function getCommission($source, $destination)
    {
        return $this->where('operateur_source', $source)
                    ->where('operateur_destination', $destination)
                    ->first();
    }

    public function trouverCommission($idOperateurDestination)
    {
        return $this
            ->where(
                'operateur_destination',
                $idOperateurDestination
            )
            ->first();
    }

    public function getGainParOperateur()
{
    return $this
        ->select('
            o.nom AS operateur,
            SUM(commission_operateur.commission) AS gain
        ')
        ->join(
            'operateur o',
            'o.id = commission_operateur.operateur_destination'
        )
        ->groupBy('o.id')
        ->findAll();
}
}