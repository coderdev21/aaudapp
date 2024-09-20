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
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->string('marbete');
            $table->foreignId('brand_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('asset_type_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('brand_modelo_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->string('serial');
            $table->foreignId('agency_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('department_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('employee_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('condition_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->string('image_url')->nullable();
            $table->tinyText('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assets');
    }
};
