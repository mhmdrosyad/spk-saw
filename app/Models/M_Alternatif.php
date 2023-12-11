<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Alternatif extends Model
{
    protected $table = 'alternatif';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;

    protected $allowedFields = ['topic'];

    // Tambahan properti atau metode lainnya sesuai kebutuhan
}
