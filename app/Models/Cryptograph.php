<?php
namespace App\Models;

use CodeIgniter\Model;

class Cryptograph extends Model
{
    protected $table = 'testing';
    protected $primaryKey = 'id';
    protected $allowedFields = ['text'];
    public function getData()
    {
        $builder = $this->db->table('testing');
        return $builder->get();
    }

}