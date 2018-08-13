<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            /**
             * Principal data
             */
            $table->increments('id');
            $table->string('name');
            $table->string('surname');
            $table->string('email')->unique();
            $table->string('password');
            /**
             * Personal data
             */
            $table->string('address')->nullable();
            $table->string('location')->nullable();
            $table->string('phone1')->nullable();
            $table->string('phone2')->nullable();
            $table->string('phone3')->nullable();
            $table->date('birthday')->nullable();
            $table->date('death_date')->nullable();
            $table->char('gender')->nullable();
            $table->char('civil_status')->nullable();
            $table->text('notes')->nullable();
            $table->boolean('active')->default(true);
            /**
             * Family relations
             */
            $table->integer('spouse_id')->unsigned()->nullable();
            $table->foreign('spouse_id')->references('id')->on('users');
            $table->integer('father_id')->unsigned()->nullable();
            $table->foreign('father_id')->references('id')->on('users');
            $table->integer('mother_id')->unsigned()->nullable();
            $table->foreign('mother_id')->references('id')->on('users');
            $table->integer('mentor_id')->unsigned()->nullable();
            $table->foreign('mentor_id')->references('id')->on('users');
            /**
             * Fk's
             */
            $table->integer('occupation_id')->unsigned()->nullable();
            $table->foreign('occupation_id')->references('id')->on('occupations');
            $table->integer('church_id')->unsigned();
            $table->foreign('church_id')->references('id')->on('churches');

            $table->nullableTimestamps();
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
