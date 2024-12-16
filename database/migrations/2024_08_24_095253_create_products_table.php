<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('title');
            $table->unsignedBigInteger('category_id')->nullable();
            $table->mediumText('description');
            $table->string('cover_image');
            $table->enum('status', ['Published', 'Scheduled', 'Draft'])->default('Draft');
            $table->timestamp('publish_date')->nullable();
            $table->enum('visibility', ['Public', 'Hidden'])->default('Public');
            $table->decimal('price', 10, 2);
            $table->decimal('discount', 10, 2)->default(0.00);
            $table->integer('orders')->nullable();
            $table->string('sku')->nullable();
            $table->string('manufacturer_name')->nullable();
            $table->string('manufacturer_brand')->nullable();
            $table->decimal('weight', 8, 2)->nullable();
            $table->boolean('return_policy')->default(false);
            $table->integer('return_period')->nullable();
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories')->onDelete('restrict');
        });

        // Add check constraint via raw SQL
        DB::statement("ALTER TABLE products ADD CONSTRAINT chk_status_publish_date CHECK (status != 'Scheduled' OR publish_date IS NOT NULL)");
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            // Drop the check constraint
            DB::statement('ALTER TABLE products DROP CONSTRAINT IF EXISTS chk_status_publish_date');
        });

        Schema::dropIfExists('products');
    }
}
