<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Transaksi extends Model
{
    use HasFactory;
    protected $fillable = [
        'tgl', // tambahkan 'tgl' ke dalam array $fillable
        // daftar kolom lainnya yang dapat diisi secara massal
        'tanggal',
        'nama',
        'no_registrasi',
        'alamat',
        'no_telepon',
        'jenis_kelamin',
        'jasa_tindakan',
        'harga_obatobatan',
        'jasa_pemeriksaan_lain',
        'total',
        'laba_bersih',
        'pasien_id',
    ];
}
