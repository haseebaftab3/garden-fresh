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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->datetime('start_date')->nullable();
            $table->datetime('end_date')->nullable();
            $table->string('discount_type')->default('percentage'); // 'percentage' or 'fixed'
            $table->decimal('discount_value', 8, 2)->default(0.00);
            $table->string('applicable_to')->default('sitewide'); // 'sitewide', 'category', 'product'
            $table->integer('usage_limit')->nullable(); // Optional usage limit
            $table->boolean('is_visible')->default(true); // Visibility before sale start
            $table->boolean('status')->default(true); // true for active, false for inactive
            $table->timestamps();

            $table->index('start_date');
            $table->index('end_date');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
