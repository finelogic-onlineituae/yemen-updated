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
        Schema::create('passport_centers', function (Blueprint $table) {
            $table->id();
            $table->string('center_name');
        });

        Schema::table('passports', function (Blueprint $table) {
            $table->foreignIdFor(App\Models\PassportCenter::class)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('passport_centers');
    }
};
