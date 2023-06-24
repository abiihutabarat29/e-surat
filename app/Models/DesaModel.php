<?php

namespace App\Models;

use CodeIgniter\Model;

class DesaModel extends Model
{
    protected $table      = 'mod_desa';
    protected $primaryKey = 'id';
    protected $useTimestamps = true;
    protected $allowedFields = ['kode', 'nama_desa'];

    public function getNamaDesaById($id)
    {
        return $this->select('nama_desa')->where('id', $id)->get()->getRow()->nama_desa;
    }
}
