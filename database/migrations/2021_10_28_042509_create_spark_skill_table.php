<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSparkSkillTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spark_skill', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('personal_profile_id');
            $table->unsignedInteger('skill_id');
            $table->integer('spark_skill_count')->default(0);
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
        Schema::dropIfExists('spark_skill');
    }
}
