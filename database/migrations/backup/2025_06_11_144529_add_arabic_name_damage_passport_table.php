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
        Schema::table('damaged_passports', function (Blueprint $table) {
            $table->string('name_arabic');
            $table->string('profession');
            $table->string('place_of_birth');
            $table->date('date_of_birth')->nullable();
            $table->string('relative_in_uae');
            $table->string('relative_in_uae_number');
            $table->string('relative_in_yemen');
            $table->string('relative_in_yemen_number');
            $table->text('id_card');
            $table->string('address');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('damaged_passports', function (Blueprint $table) {
            //
        });
    }
};
