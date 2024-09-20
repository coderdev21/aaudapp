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
        Schema::create('comercial_clients', function (Blueprint $table) {
            $table->id();
            $table->string('nic');
            $table->string('finca');
            $table->string('ruc');
            $table->string('name');
            $table->string('phone');
            $table->string('email');
            $table->foreignId('state_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('city_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('town_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->string('address');
            $table->boolean('convenio_bancario')->default(false);
            $table->boolean('arreglo_pago')->default(false);
            $table->unsignedTinyInteger('cantidad_bolsas');
            $table->unsignedTinyInteger('generacion');
            $table->unsignedTinyInteger('dias_laborables');
            $table->float('tipo_bolsa');
            $table->float('metros_cubicos_mensuales');
            $table->float('yardas_cubicas_mensuales');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comercial_clients');
    }
};
