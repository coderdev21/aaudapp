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
    Schema::create('customers', function (Blueprint $table) {
      $table->id();
      $table->string('nic');
      $table->string('finca');
      $table->string('cedula')->nullable();
      $table->string('name');
      $table->foreignId('state_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
      $table->foreignId('city_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
      $table->foreignId('town_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
      $table->string('address');
      $table->boolean('arreglo_pago')->default(false);
      $table->boolean('convenio_bancario')->default(false);
      $table->string('email')->nullable();
      $table->string('telefono')->nullable();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('customers');
  }
};
