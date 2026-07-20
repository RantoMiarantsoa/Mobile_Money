<?php

namespace App\Models;

use CodeIgniter\Model;


class PrefixeModel extends Model
{

    protected $table = 'prefixe';

    protected $primaryKey = 'id';


    protected $allowedFields = [
        'id_operateur',
        'code'
    ];


    protected $returnType = 'array';


    protected $useTimestamps = false;


    public function listePrefixes()
    {

        return $this->select('
                prefixe.*,
                operateur.nom AS operateur
            ')
            ->join(
                'operateur',
                'operateur.id = prefixe.id_operateur'
            )
            ->findAll();

    }


}