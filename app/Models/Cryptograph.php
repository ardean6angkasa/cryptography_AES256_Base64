<?php
namespace App\Models;

use CodeIgniter\Model;

class Cryptograph extends Model
{
    protected $table = 'cryptool';
    protected $primaryKey = 'id';
    protected $allowedFields = ['text'];
    public function getData()
    {
        $builder = $this->db->table('cryptool');
        return $builder->get();
    }

}