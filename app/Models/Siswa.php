<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;
    protected $connection = "mysql";
    protected $table = "siswa";
    protected $primaryKey = 'nis';
    public $incrementing = false;

    public function absens()
    {
        return $this->hasMany(Absen::class, 'siswa_id', 'nis'); // siswa_id di tabel absen mengacu ke nis di tabel siswa
    }
}
