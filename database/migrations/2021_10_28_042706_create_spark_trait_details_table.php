<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSparkTraitDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spark_trait_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('spark_trait_id');
            $table->unsignedBigInteger('personal_profile_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('spark_trait_details');
    }
}
