<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSparkDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spark_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('spark_id');
            $table->unsignedBigInteger('spark_from_user_id');
            $table->timestamps();

            $table->foreign('spark_from_user_id')->references('id')->on('users');
            $table->foreign('spark_id')->references('id')->on('sparks')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('spark_details');
    }
}
