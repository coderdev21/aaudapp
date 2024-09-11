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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            //Datos Generales
            $table->string('nombre');
            $table->string('segundo_nombre')->nullable();
            $table->string('apellido_paterno');
            $table->string('apellido_materno')->nullable();
            $table->string('fullname')->virtualAs("CONCAT(nombre, ' ', segundo_nombre, ' ', apellido_paterno, ' ', apellido_materno)");
            $table->string('shortfullname')->virtualAs("CONCAT(nombre, ' ', apellido_paterno)");
            $table->string('cedula')->unique();
            $table->string('seguro_social')->default('0');
            $table->boolean('genero')->default(false);
            $table->boolean('estado_civil')->default(false);
            $table->date('fecha_nacimiento')->default('1900-01-01');
            $table->string('tipo_sangre')->default('O+');
            $table->string('image_url')->nullable();

            //Datos de Dirección
            $table->foreignId('state_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('city_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('town_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->string('address')->default('Panamá');

            //Datos de Contratación
            $table->string('employee_number');
            $table->foreignId('employee_type_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->string('status')->nullable();
            $table->date('start')->default('1900-01-01');
            $table->date('end')->default('1900-01-01');
            $table->foreignId('agency_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('department_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->string('numero_resolucion')->default('00000');
            $table->string('numero_contrato')->default('00000');
            $table->string('numero_posicion');
            $table->string('objeto_gasto')->default('0');
            $table->string('numero_planilla')->default('0');
            $table->string('numero_partida')->default('0');
            $table->float('salary')->default('0.00');

            //Datos de Planilla
            $table->float('gastos_representacion')->default('0');
            $table->string('numero_partida_gasto_representacion')->default('0');
            //$table->float('aditional_payment')->default('0');
            $table->foreignId('bank_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->string('tipo_cuenta')->nullable();
            $table->string('accout_number')->nullable();
            $table->string('tipo_cuenta_beneficiario')->nullable();
            $table->string('card_type')->nullable();

            //Datos de usuario
            //$table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
