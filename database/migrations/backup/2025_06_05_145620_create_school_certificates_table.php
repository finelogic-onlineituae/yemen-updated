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
        Schema::create('school_certificates', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignIdFor(App\Models\Passport::class);
            $table->string('emirates_id');
            $table->string('phone_number');
            $table->text('supporting_reason')->nullable();
            $table->text('supporting_document')->nullable();
            $table->string('guardian_name');
           // $table->string('guardian_phone_number');
            $table->string('guardian_emirates_id');
            $table->string('guardian_id_card');
            $table->unsignedBigInteger('guardian_passport_id');
            $table->foreign('guardian_passport_id')->references('id')->on('passports');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('school_certificates');
    }
};
