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
      $table->string('finca')->nullable()->unique();
      $table->foreignId('customer_type_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
      $table->float('tasa')->nullable()->default(0.00);
      $table->date('start');
      $table->foreignId('agency_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
      $table->string('name');
      $table->string('cedula');
      $table->string('telefono')->nullable();
      $table->string('email')->nullable();
      $table->string('name2')->nullable();
      $table->string('cedula2')->nullable();
      $table->string('telefono2')->nullable();
      $table->string('email2')->nullable();
      $table->string('address')->nullable();
      $table->foreignId('urbanization_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
      $table->string('status');
      $table->text('observacion')->nullable();
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
