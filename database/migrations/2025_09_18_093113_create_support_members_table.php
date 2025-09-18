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
        Schema::create('support_members', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('emirate_id_attachment');
            $table->foreignIdFor(App\Models\Passport::class);
            $table->foreignIdFor(App\Models\Support::class);
            $table->string('relationship');
            $table->integer('nationality');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('support_members');
    }
};
