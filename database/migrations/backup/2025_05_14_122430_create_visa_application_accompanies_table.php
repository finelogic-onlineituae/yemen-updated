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
        Schema::create('visa_application_accompanies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('emirates_id');
            $table->unsignedBigInteger('passport_id');
            $table->foreign('passport_id')->references('id')->on('passports');
            $table->unsignedBigInteger('visa_application_id');
            $table->foreign('visa_application_id')->references('id')->on('visa_applications');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visa_application_accompanies');
    }
};
