<?php

namespace App\Models;

use CodeIgniter\Model;

class PromotionModel extends Model
{
    protected $table = 'promotion';
    protected $primaryKey = 'id';
    protected $allowedFields = ['pourcentage'];


    public function getPourcentage(){
         $row = $this
        ->select('promotion.pourcentage')
        ->first();

       return $row ?  $row['pourcentage'] : null;
    }
}