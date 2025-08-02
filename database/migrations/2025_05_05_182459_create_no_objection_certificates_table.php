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
        Schema::create('no_objection_certificates', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('emirates_id');
            $table->string('birth_certifcate_no');
            $table->string('birth_certifcate_issuing_authority');
            $table->string('modified_name');
            $table->text('amendment_or_correction');
            $table->string('modified_issued_by');
            $table->date('modified_issued_on')->nullable();
            $table->text('birth_certifcate');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('no_objection_certificates');
    }
};
