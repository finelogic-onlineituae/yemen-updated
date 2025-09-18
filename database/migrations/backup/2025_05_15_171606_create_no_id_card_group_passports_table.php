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
        Schema::create('no_id_card_group_passports', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('submitted_to');
            $table->string('emirates_id');
            $table->string('residance_permit');
            $table->unsignedBigInteger('passport_id');
            $table->foreign('passport_id')->references('id')->on('passports');
            $table->unsignedBigInteger('no_id_card_group_id');
            $table->foreign('no_id_card_group_id')->references('id')->on('no_id_card_groups');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('no_id_card_group_passports');
    }
};
