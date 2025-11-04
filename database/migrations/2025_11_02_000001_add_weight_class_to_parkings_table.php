<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('parking', function (Blueprint $table) {
            $table->unsignedBigInteger('weight_class_id')->nullable()->after('vehicle_type_id');
            $table->foreign('weight_class_id')->references('id')->on('weight_classes')->onDelete('set null');
        });
    }
    public function down(): void {
        Schema::table('parking', function (Blueprint $table) {
            $table->dropForeign(['weight_class_id']);
            $table->dropColumn('weight_class_id');
        });
    }
};
