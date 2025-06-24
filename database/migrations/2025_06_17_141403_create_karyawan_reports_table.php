<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('karyawan_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('karyawan_id')->constrained('karyawans')->onDelete('cascade');
            $table->date('tanggal');
            $table->string('shift');
            $table->string('jam_kerja'); // Format: "08:00 - 17:00"
            $table->text('pelayanan')->nullable();
            $table->json('dokumentasi')->nullable();
            $table->timestamps();

            $table->index(['karyawan_id', 'tanggal']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('karyawan_reports');
    }
};
