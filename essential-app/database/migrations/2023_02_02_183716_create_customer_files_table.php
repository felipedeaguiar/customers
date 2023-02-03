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
        Schema::create('customer_files', function (Blueprint $table) {
            $table->unsignedBigInteger('id_customer');
            $table->unsignedBigInteger('id_file');
            $table->foreign('id_customer')->references('id')->on('customers');
            $table->foreign('id_file')->references('id')->on('files');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer_files');
    }
};
