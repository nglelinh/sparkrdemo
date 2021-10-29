<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Sparkr\Domain\UserManagement\User\Enums\UserStatus;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',100)->nullable();
            $table->string('email',100)->unique();
            $table->string('password');
            $table->string('image', 255)->nullable();
            $table->unsignedInteger('user_type_id')->nullable()
                ->comment('1 = Person, 2 = Company');
            $table->unsignedInteger('experience_level_id')->nullable();
            $table->integer('spark_count')->default(0)
                ->comment("Number of sparks");
            $table->integer('following_count')->default(0);
            $table->integer('followed_count')->default(0);
            $table->timestamp('last_login')->nullable();
            $table->tinyInteger('status')->default(UserStatus::Active)
                ->comment('1 = Active, 0 = Inactive');
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
        Schema::dropIfExists('users');
    }
}
