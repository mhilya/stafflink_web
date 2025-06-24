<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('penilaian_manajers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('manajer_id')->constrained('manajers')->onDelete('cascade');
            $table->foreignId('penilai_id')->constrained('hrds')->onDelete('cascade');
            $table->text('corrective_action')->nullable();
            $table->text('feedback_manajer')->nullable();
            $table->json('kompetensi_items')->nullable();
            $table->decimal('total_skill', 10, 2);
            $table->decimal('total_kinerja', 10, 2);
            $table->decimal('total_attitude', 10, 2);
            $table->decimal('total_score', 10, 2);
            $table->decimal('total_persentase', 5, 2);
            $table->string('indeks', 1);
            $table->string('periode');
            $table->date('tanggal_penilaian');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penilaian_manajers');
    }
};
