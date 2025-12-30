<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id')->index();
            $table->unsignedBigInteger('user_id')->nullable()->index();
            $table->string('user_name')->nullable();
            $table->string('action'); // 'created' or 'updated'
            $table->json('previous_values')->nullable();
            $table->json('new_values')->nullable();
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_histories');
    }
};
