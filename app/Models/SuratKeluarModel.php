<?php

namespace App\Models;

use CodeIgniter\Model;

class SuratKeluarModel extends Model
{
    protected $table      = 'mod_surat_keluar';
    protected $primaryKey = 'id';
    protected $useTimestamps = true;
    protected $allowedFields = ['id_desa', 'id_user', 'no_surat', 'sifat_surat', 'kategori_surat', 'perihal', 'penandatangan', 'isi', 'jlh_lampiran', 'satuan', 'file_lampiran', 'tujuan','tgl_surat', 'pokja'];
}
