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
        Schema::create('application_family_members', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('emirates_id');
            $table->string('information_provided');
            $table->string('phone_number');
            $table->text('residance_permit');
            $table->foreignIdFor(App\Models\Passport::class);
            $table->timestamps();
        });
    }
 
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('application_family_members');
    }
};
