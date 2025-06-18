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
       Schema::create('profil', function (Blueprint $table) {
            $table->id();
            $table->foreignId('users_id')->unique()->constrained('users')->onDelete('cascade');
              $table->string('nama')->nullable();
            $table->string('alamat');
            $table->string('no_hp');
            $table->string('foto');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profil');
    }
};
