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
        Schema::create('visa_applications', function (Blueprint $table) {
            $table->id();
            $table->string('nationality');
            $table->string('religion');
            $table->text('permanent_address');
            $table->text('uae_address');
            $table->date('date_of_birth');
            $table->string('place_of_birth');
            $table->string('proffession');
            $table->string('place_of_work');
            $table->text('purpose_of_travel');
            $table->integer('period_required');
            $table->text('address_in_roy');
            $table->string('sponsor1_name');
            $table->text('sponsor1_address');
            $table->string('sponsor2_name')->nullable();
            $table->text('sponsor2_address')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visa_applications');
    }
};
