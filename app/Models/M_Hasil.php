<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Hasil extends Model
{
    protected $table = 'hasil';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama', 'nim', 'rekomendasi'];

    // Tambahkan method untuk menyimpan hasil
    public function simpanHasil($data)
    {
        $this->insert($data);
    }
}
