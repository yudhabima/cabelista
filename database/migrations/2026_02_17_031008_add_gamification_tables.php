<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // 1. CEK TABEL MATERIALS
        // Jika tabel materials BELUM ADA, kita buat dulu (sekalian sama kolom XP-nya)
        if (!Schema::hasTable('materials')) {
            Schema::create('materials', function (Blueprint $table) {
                $table->id();
                $table->string('title');        // Judul
                $table->text('description');    // Deskripsi
                $table->longText('content');    // Isi Materi
                $table->string('image')->nullable();
                $table->integer('xp_point')->default(0);
                $table->integer('total_score')->default(0);
                $table->integer('progress_level')->default(0);
                $table->timestamps();
            });
        } else {
            // Jika tabel SUDAH ADA, kita cuma tambah kolom xp_reward
            if (!Schema::hasColumn('materials', 'xp_reward')) {
                Schema::table('materials', function (Blueprint $table) {
                    $table->integer('xp_reward')->default(100);
                });
            }
        }

        // 2. UPDATE USER (Tambah kolom XP)
        if (!Schema::hasColumn('users', 'total_xp')) {
            Schema::table('users', function (Blueprint $table) {
                $table->integer('total_xp')->default(0);
            });
        }

        // 3. BUAT TABEL LANGKAH (Sub-Materi)
        if (!Schema::hasTable('material_steps')) {
            Schema::create('material_steps', function (Blueprint $table) {
                $table->id();
                $table->foreignId('material_id')->constrained('materials')->onDelete('cascade');
                $table->integer('step_number'); 
                $table->string('title');        
                $table->longText('content');    
                $table->timestamps();
            });
        }

        // 4. BUAT TABEL PROGRESS USER
        if (!Schema::hasTable('material_progress')) {
            Schema::create('material_progress', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
                $table->foreignId('material_id')->constrained('materials')->onDelete('cascade');
                $table->integer('current_step')->default(1); 
                $table->boolean('is_completed')->default(false); 
                $table->timestamps();
            });
        }
    }

    public function down()
    {
        // Hapus tabel jika di-rollback
        Schema::dropIfExists('material_progress');
        Schema::dropIfExists('material_steps');
        // Kita tidak menghapus materials/users agar data aman
    }
};