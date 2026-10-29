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
            $table->string('name');
            $table->string('personal_number');
            $table->string('email')->nullable();
            $table->string('jnv_name');
            $table->string('batch')->nullable();
            $table->string('official_contact_number')->nullable();
            $table->string('address_city')->nullable();
            $table->string('business_name_city')->nullable();
            $table->string('business_category')->nullable();
            $table->string('website')->nullable();
            $table->text('products_services')->nullable();
            $table->boolean('willing_volunteer')->default(false);
            $table->boolean('willing_sponsor')->default(false);
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
