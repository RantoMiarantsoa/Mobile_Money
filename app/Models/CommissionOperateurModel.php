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
}