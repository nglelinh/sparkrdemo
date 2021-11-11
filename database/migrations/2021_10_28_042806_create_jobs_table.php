<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Sparkr\Utility\Enums\Status;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->unsignedBigInteger('company_profile_id');
            $table->unsignedInteger('job_type_id')->nullable();
            $table->tinyInteger('availability')->nullable();
            $table->text('description');
            $table->tinyInteger('status')->default(Status::Active);
            $table->integer('applied_job_count')->default(0);
            $table->integer('interested_job_count')->default(0);
            $table->timestamps();

            $table->foreign('company_profile_id')->references('id')->on('company_profiles')->cascadeOnDelete();
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
        Schema::dropIfExists('jobs');
    }
}
