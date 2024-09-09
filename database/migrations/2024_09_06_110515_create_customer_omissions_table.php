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
        Schema::create('customer_omissions', function (Blueprint $table) {
            $table->id();
            $table->string('contrato')->unique();
            $table->string('finca')->unique();
            $table->foreignId('customer_type_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('tasa_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->dateTime('start');
            $table->foreignId('agency_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->string('name');
            $table->string('cedula');
            $table->string('telefono');
            $table->string('email');
            $table->foreignId('urbanization_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->string('status');
            $table->foreignId('user_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_omissions');
    }
};
