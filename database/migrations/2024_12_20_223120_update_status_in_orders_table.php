<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateStatusInOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            // Check if the 'status' column exists
            if (Schema::hasColumn('orders', 'status')) {
                // Modify the column to use the enum type with the desired values
                $table->enum('status', ['pending', 'processing', 'shipped', 'delivered', 'cancelled'])
                    ->default('pending')
                    ->change();
            } else {
                // Add the 'status' column if it does not exist
                $table->enum('status', ['pending', 'processing', 'shipped', 'delivered', 'cancelled'])
                    ->default('pending')
                    ->after('total');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            // Restore the status column to its previous state
            $table->string('status')->default('pending')->change();
        });
    }
}
