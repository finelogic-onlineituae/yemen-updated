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
        Schema::create('marriage_certificates', function (Blueprint $table) {
            $table->id();
            $table->string('husband_emirates_id');
            $table->string('wife_emirates_id');
            $table->string('husband_name');
            $table->string('wife_name');
            $table->string('phone_number');
            $table->string('contract_issued_by');
            $table->date('contract_issued_on');
            $table->string('registration_number');
            $table->text('husband_residance_permit');
            $table->text('wife_residance_permit');
            $table->text('marriage_document');
            $table->unsignedBigInteger('husband_passport_id');
            $table->foreign('husband_passport_id')->references('id')->on('passports');
            $table->unsignedBigInteger('wife_passport_id');
            $table->foreign('wife_passport_id')->references('id')->on('passports');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('marriage_certificates');
    }
};
