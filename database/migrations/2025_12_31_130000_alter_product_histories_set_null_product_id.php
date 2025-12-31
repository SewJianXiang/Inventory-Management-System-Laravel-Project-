<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Drop the existing foreign key (if present)
        Schema::table('product_histories', function (Blueprint $table) {
            $table->dropForeign(['product_id']);
        });

        // Make product_id nullable. Use raw SQL to avoid requiring the DBAL package.
        // This statement is for MySQL. If you use a different driver adjust accordingly.
        DB::statement('ALTER TABLE `product_histories` MODIFY `product_id` BIGINT UNSIGNED NULL');

        // Recreate the foreign key with ON DELETE SET NULL
        Schema::table('product_histories', function (Blueprint $table) {
            $table->foreign('product_id')->references('id')->on('products')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_histories', function (Blueprint $table) {
            $table->dropForeign(['product_id']);
        });

        // Revert product_id to NOT NULL
        DB::statement('ALTER TABLE `product_histories` MODIFY `product_id` BIGINT UNSIGNED NOT NULL');

        Schema::table('product_histories', function (Blueprint $table) {
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }
};
