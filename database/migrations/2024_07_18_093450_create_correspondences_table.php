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
        Schema::create('correspondences', function (Blueprint $table) {
            $table->id();
            $table->dateTime('date_received');
            $table->string('sender');
            $table->dateTime('document_date');
            $table->string('document_number');
            $table->string('subject');
            $table->boolean('is_active')->default(true);
            //$table->foreignId('user_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('correspondence_type_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('correspondences');
    }
};
