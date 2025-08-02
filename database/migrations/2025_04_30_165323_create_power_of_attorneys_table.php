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
        Schema::create('power_of_attorneys', function (Blueprint $table) {
            $table->id();
            $table->string('client_name');
            $table->string('emirate_id');
            $table->text('residance_permit');
            $table->string('agent_name');
            $table->text('poa_document');
            $table->text('purpose');
            $table->unsignedBigInteger('client_passport_id');
            $table->foreign('client_passport_id')->references('id')->on('passports');
            $table->unsignedBigInteger('agent_passport_id');
            $table->foreign('agent_passport_id')->references('id')->on('passports');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('power_of_attorneys');
    }
};
