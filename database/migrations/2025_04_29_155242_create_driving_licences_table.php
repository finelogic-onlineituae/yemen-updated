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
        Schema::create('driving_licences', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone_number');
            $table->string('emirates_id');
            $table->string('driving_licence_number');
            $table->foreignIdFor(App\Models\DrivingLicenceCenter::class);            
            $table->date('issued_on');
            $table->date('expires_on');
            $table->foreignIdFor(App\Models\VehicleCategory::class);
            $table->foreignIdFor(App\Models\Passport::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('driving_licences');
    }
};
