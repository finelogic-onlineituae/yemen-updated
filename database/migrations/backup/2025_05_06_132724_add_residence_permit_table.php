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
        Schema::table('no_objection_certificates', function (Blueprint $table) {
            $table->text('residance_permit');
            $table->foreignIdFor(App\Models\Passport::class);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('no_objection_certificates', function (Blueprint $table) {
            //
        });
    }
};
