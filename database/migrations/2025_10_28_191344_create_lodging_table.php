<?php
// 2025_08_26_191344_create_lodging_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lodging', function (Blueprint $table) {
            $table->id();
            $table->foreignId('animal_id')->constrained('animals')->onDelete('cascade');
            $table->date('dia_entrada')->nullable();
            $table->date('dia_saida')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lodging');
    }
};