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
        Schema::create('joinings', function (Blueprint $table) {
            $table->id();
            $table->string('personal_number');
            $table->string('email')->unique();
            $table->string('jnv_name');
            $table->string('batch');
            $table->string('official_contact_number');
            $table->string('address_city');
            $table->string('business_name_city');
            $table->string('business_category');
            $table->string('website')->nullable();
            $table->text('products_services');
            $table->boolean('willing_volunteer');
            $table->boolean('willing_sponsor');
            $table->string('status')->default('pending_payment');
            $table->string('upi_transaction_id')->nullable();
            $table->string('payment_screenshot')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('joinings');
    }
};
