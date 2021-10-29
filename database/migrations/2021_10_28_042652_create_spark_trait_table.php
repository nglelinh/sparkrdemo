<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSparkTraitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spark_trait', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('company_profile_id');
            $table->unsignedInteger('trait_id');
            $table->integer('spark_trait_count')->default(0);
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
        Schema::dropIfExists('spark_trait');
    }
}
