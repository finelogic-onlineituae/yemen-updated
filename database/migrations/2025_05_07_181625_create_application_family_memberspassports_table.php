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
        Schema::create('application_family_memberspassports', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('residance_permit');
            $table->text('birth_certificiate');
            $table->unsignedBigInteger('passport_id');
            $table->foreign('passport_id')->references('id')->on('passports');
            $table->unsignedBigInteger('family_member_id');
            $table->foreign('family_member_id')->references('id')->on('application_family_members');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('application_family_memberspassports');
    }
};
