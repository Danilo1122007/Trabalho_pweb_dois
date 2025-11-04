<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('parking', function (Blueprint $table) {
            $table->foreignId('vehicle_type_id')
                  ->after('motorista')
                  ->nullable()
                  ->constrained('vehicle_types')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('parking', function (Blueprint $table) {
            $table->dropForeign(['vehicle_type_id']);
            $table->dropColumn('vehicle_type_id');
        });
    }
};  