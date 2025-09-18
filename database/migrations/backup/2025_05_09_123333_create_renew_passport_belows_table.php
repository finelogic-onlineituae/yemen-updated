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
        Schema::create('renew_passport_belows', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone_number');
            $table->string('emirates_id');
            $table->foreignIdFor(App\Models\Passport::class);
            $table->text('photo');
            $table->text('id_card_passport_holder');
            $table->text('father_passport');
            $table->text('father_id_card');
            $table->text('mother_passport');
            $table->text('mother_id_card');
            $table->text('applicante_id_card');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('renew_passport_belows');
    }
};
