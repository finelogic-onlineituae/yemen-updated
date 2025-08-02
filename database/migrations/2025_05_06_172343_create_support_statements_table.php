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
        Schema::create('support_statements', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignIdFor(App\Models\Passport::class);
            $table->string('emirates_id');
            $table->string('phone_number');
            $table->string('relation_to_beneficiary');
            $table->string('information_provided');
            $table->string('beneficiary_name');
            $table->string('beneficiary_passport_number');
            $table->string('beneficiary_issued_by');
            $table->date('beneficiary_issued_on');
            $table->text('breadwinner_passport');
            $table->text('beneficiary_passport');
            $table->text('birth_certificate');
            $table->text('registration_summary');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('support_statements');
    }
};
