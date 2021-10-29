<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSparkSkillDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spark_skill_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('spark_skill_id');
            $table->unsignedBigInteger('company_profile_id');
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
        Schema::dropIfExists('spark_skill_details');
    }
}
