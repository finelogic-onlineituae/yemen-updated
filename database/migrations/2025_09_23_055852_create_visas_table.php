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
        Schema::create('visas', function (Blueprint $table) {
            $table->id();

            $table->string('name_arabic');
            $table->string('name_english');
            $table->foreignIdFor(App\Models\Passport::class);
            $table->string('nationality');
            $table->date('date_of_birth');
            $table->string('place_of_birth');
            $table->string('profession');
            $table->string('place_of_work');
            $table->string('permanent_address');
            $table->string('uae_address');
            $table->string('travel_purpose');
            $table->string('roy_address');
            $table->string('sponsor_name');
            $table->string('sponsor_address');
            $table->date('previous_visit_1')->nullable();
            $table->date('previous_visit_2')->nullable();
            $table->string('emirate_id_attachment');
            $table->string('sponsor_passport');
            $table->string('sponsor_noc');
            $table->string('photo');
            $table->boolean('has_accompany')->default(false);
            $table->string('accompany_name')->nullable();
            $table->string('accompany_passport')->nullable();
            $table->string('accompany_id_card')->nullable();
              
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visas');
    }
};
