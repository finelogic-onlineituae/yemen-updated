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
        Schema::create('group_id_card_members', function (Blueprint $table) {
            $table->id();
            $table->string('name_arabic');
            $table->foreignIdFor(App\Models\Passport::class);
            $table->foreignIdFor(App\Models\NoIdentityCard::class);
            $table->boolean('is_above_18')->default(true);
            $table->boolean('is_emirati_wife')->default(false);
            $table->string('emirate_id_attachment');
            $table->string('husband_passport_attachment')->nullable();
            $table->string('marriage_document')->nullable();
            $table->string('father_passport')->nullable();
            $table->string('mother_passport')->nullable();
            $table->string('father_emirate_id')->nullable();
            $table->string('mother_emirate_id')->nullable();
            $table->string('birth_certificate')->nullable();
            $table->string('photo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('group_id_card_members');
    }
};
