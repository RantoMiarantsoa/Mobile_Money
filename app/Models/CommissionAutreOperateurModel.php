<?php

namespace App\Models;

use CodeIgniter\Model;

class CommissionAutreOperateurModel extends Model
{
    protected $table = 'commission_autre_operateur';

    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $allowedFields = [
        'id_operateur_destination',
        'pourcentage'
    ];


    /**
     * Trouver la commission pour un opérateur destination
     */
    public function trouverCommission(int $idOperateurDestination): float
    {
        $row = $this
            ->where('id_operateur_destination', $idOperateurDestination)
            ->first();

        return (float) ($row['pourcentage'] ?? 0);
    }


    /**
     * Calculer le montant de commission
     */
    public function calculerCommission(
        int $idOperateurDestination,
        float $montant
    ): float {

        $pourcentage = $this->trouverCommission($idOperateurDestination);

        return $montant * $pourcentage / 100;
    }

}