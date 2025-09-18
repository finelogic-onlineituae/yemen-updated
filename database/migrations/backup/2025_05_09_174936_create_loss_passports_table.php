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
        Schema::create('loss_passports', function (Blueprint $table) {
            $table->id();
            $table->string('phone_number');
            $table->string('emirates_id');
            $table->string('new_name');
            $table->string('present_passholder')->nullable();
            $table->text('photo');
            $table->text('left_thumb')->nullable();
            $table->text('emirates_id_copy');
            $table->text('police_reporting_letter');
            $table->text('supporting_document')->nullable();
            $table->foreignIdFor(App\Models\Passport::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loss_passports');
    }
};
