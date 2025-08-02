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
        Schema::create('damaged_passports', function (Blueprint $table) {
            $table->id();
            $table->string('phone_number');
            $table->string('emirates_id');
            $table->text('photo');
            $table->text('left_thumb');
            $table->text('emirates_id_copy');
            $table->foreignIdFor(App\Models\Passport::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('damaged_passports');
    }
};
