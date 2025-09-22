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
        Schema::create('attestations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('nationality');
            $table->foreignIdFor(App\Models\Passport::class)->constrained();
            $table->string('emirate_id_attachment');
            $table->string('document_type');
            $table->integer('issuing_country');
            $table->string('issuing_authority');
            $table->string('document_to_attest');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attestations');
    }
};
