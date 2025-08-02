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
        Schema::create('new_passports', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone_number');
            $table->text('photo');
            $table->text('birth_certificate');
            $table->text('father_passport')->nullable();
            $table->text('father_id_card')->nullable();
            $table->text('mother_passport')->nullable();
            $table->text('mother_id_card')->nullable();
            $table->text('marriage_certificate_parents')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('new_passports');
    }
};
