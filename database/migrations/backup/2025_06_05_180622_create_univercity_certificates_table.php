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
        Schema::create('univercity_certificates', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignIdFor(App\Models\Passport::class);
            $table->string('emirates_id');
            $table->string('phone_number');
            $table->text('id_card');
            $table->text('grade_statements');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('univercity_certificates');
    }
};
