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
        Schema::create('discounts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->enum('discount_type', ['percentage', 'fixed']);
            $table->decimal('value', 8, 2); // Discount value (e.g., 10.00 for $10 or 10.00 for 10%)
            $table->decimal('maximum_discount', 8, 2)->nullable(); // Maximum discount for percentage discounts
            $table->decimal('minimum_purchase', 8, 2)->nullable(); // Minimum purchase amount to apply the discount
            $table->string('discount_code')->nullable()->unique(); // Discount code for applying discounts
            $table->unsignedInteger('usage_limit')->nullable(); // Maximum number of times this discount can be used
            $table->unsignedInteger('used_count')->default(0); // Track the number of times this discount has been used
            $table->boolean('status')->default(true); // Active or Inactive
            $table->timestamp('start_date')->nullable();
            $table->timestamp('end_date')->nullable();
            $table->boolean('apply_to_cart')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('discounts');
    }
};
