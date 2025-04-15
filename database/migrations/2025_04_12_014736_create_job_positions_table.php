<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateJobPositionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_positions', function(Blueprint $table)
        {
            $table->increments('id');
            $table->timestamps();
            $table->integer('organization_unit_id')->unsigned()->nullable()->index();
            $table->integer('job_title_category_id')->unsigned()->nullable()->index();
            $table->string('job_description')->nullable();
            $table->string('position_code')->nullable();
            $table->integer('position_id')->unsigned()->nullable()->index();
            $table->integer('salary_id')->unsigned()->nullable()->index();
            $table->string('status')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('job_positions');
    }
}
