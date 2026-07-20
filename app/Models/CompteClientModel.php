<?php

namespace App\Models;

use CodeIgniter\Model;


class CompteClientModel extends Model
{

    protected $table = 'v_solde_client';

    protected $returnType = 'array';



    public function listeComptesClients()
    {

        return $this->db->query("
        
            SELECT 
                v.id_client,
                v.nom,
                v.telephone,
                v.solde,
                o.nom AS operateur

            FROM v_solde_client v


            LEFT JOIN prefixe p

            ON SUBSTR(v.telephone, 1, 3) = p.code


            LEFT JOIN operateur o

            ON o.id = p.id_operateur

        ")->getResultArray();

    }


}