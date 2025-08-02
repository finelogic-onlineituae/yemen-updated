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
        Schema::table('birth_certificates', function (Blueprint $table) {
            Schema::table('birth_certificates', function (Blueprint $table) {
                $table->string('place_of_birth')->nullable();
                $table->string('emirates_id');
                $table->date('date_of_birth')->nullable();
                $table->string('marital_status');
                $table->string('fathers_name')->nullable();
                $table->date('fathers_issued_on')->nullable();
                $table->string('fathers_passport_number')->nullable();
                $table->string('fathers_nationality')->nullable();
                $table->string('mothers_name')->nullable();
                $table->date('mothers_issued_on')->nullable();
                $table->string('mothers_passport_number')->nullable();
                $table->string('mothers_nationality')->nullable();
                $table->text('residance_permit');
                $table->text('fathers_passport')->nullable();
                $table->text('mothers_passport')->nullable();
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('birth_certificates', function (Blueprint $table) {
            //
        });
    }
};
