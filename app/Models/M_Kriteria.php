<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Kriteria extends Model
{
    protected $table = 'kriteria';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;

    protected $allowedFields = ['n_akademik, h_projek, minat, kemampuan'];

    // Tambahan properti atau metode lainnya sesuai kebutuhan
}
