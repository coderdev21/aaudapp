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
        Schema::create('certificates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->string('nic');
            $table->string('finca');
            $table->string('customer_name');
            $table->foreignId('state_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('city_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('town_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->string('address');
            $table->string('control_number');
            $table->string('agency');
            $table->string('created_by');
            $table->string('canceled_by')->nullable();
            $table->text('description')->nullable();
            $table->date('expiration_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('certificates');
    }
};
