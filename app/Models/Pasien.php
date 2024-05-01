<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    use HasFactory;

    protected $fillable = [
        'tanggal',
        'nama',
        'no_registrasi',
        'alamat',
        'no_telepon',
        'jenis_kelamin',
    ];
}
