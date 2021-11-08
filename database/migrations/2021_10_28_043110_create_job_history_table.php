<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_history', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('personal_profile_id');
            $table->string('title');
            $table->string('company_name');
            $table->timestamp('start_date')->nullable();
            $table->timestamp('end_date')->nullable();
            $table->text('description');
            $table->unsignedInteger('job_type_id')->nullable();
            $table->tinyInteger('availability')->nullable();
            $table->timestamps();

            $table->foreign('personal_profile_id')->references('id')->on('personal_profiles')->cascadeOnDelete();
            $table->foreign('job_type_id')->references('id')->on('job_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_history');
    }
}
