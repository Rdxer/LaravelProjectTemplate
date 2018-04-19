<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('user_id')->unsigned()->comment('当前用户id')->unique();
            $table->foreign('user_id')->references('id')->on('users');

            $table->string('name')->comment('姓名');
            $table->string('nickname')->default("")->comment('昵称');
            $table->string('contact')->default("")->comment('联系方式');
            $table->string('gender')->default("UNDEFINED")->comment('性别');
            $table->string('email')->default("")->comment('邮箱');
            $table->string('address')->default("")->comment('联系地址');
            $table->string('avatar')->default("")->comment('头像');

            $table->string('marker')->nullable()->comment('标记备注');

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
        Schema::dropIfExists('profiles');
    }
}
