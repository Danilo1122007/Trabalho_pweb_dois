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
        Schema::create('lodging', function (Blueprint $table) {
            $table->id();
            $table->string('nome',100);
            $table->string('nome_animal',100);
            $table->date('dia_entrada')->nullable();
            $table->date('dia_saida')->nullable();
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lodging');
    }
};
