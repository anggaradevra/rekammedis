<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->date('tgl');
            $table->string('nama');
            $table->string('no_registrasi');
            $table->text('alamat');
            $table->string('no_telepon');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->string('jasa_tindakan');
            $table->decimal('harga_obatobatan', 10, 2);
            $table->decimal('jasa_pemeriksaan_lain', 10, 2);
            $table->decimal('total', 10, 2);
            $table->decimal('laba_bersih', 10, 2);
            $table->timestamps();

            // Menambahkan kolom untuk menyimpan ID pasien
            $table->unsignedBigInteger('pasien_id');
            $table->foreign('pasien_id')->references('id')->on('pasiens')->onDelete('cascade');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
};
