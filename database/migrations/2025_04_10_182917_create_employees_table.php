<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function(Blueprint $table)
        {
            $table->increments('id');
            $table->timestamps();
            $table->string('en_name')->nullable();
            $table->string('title', 255)->nullable();
            $table->string('sex')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->date('joined_date')->nullable();
            $table->string('photo', 255)->nullable();
            $table->string('phone_number')->nullable();
            $table->integer('organization_unit_id')->unsigned()->nullable()->index();
            $table->integer('job_position_id')->unsigned()->nullable()->index();
            $table->integer('job_title_category_id')->unsigned()->nullable()->index();
            $table->integer('salary_id')->unsigned()->nullable()->index();
            $table->integer('martial_status_id')->unsigned()->nullable()->index();
            $table->string('nation')->nullable();
            $table->integer('employment_id')->unsigned()->nullable()->index();
            $table->date('job_position_start_date')->nullable();
            $table->date('job_position_end_date')->nullable();
            $table->string('address')->nullable();
            $table->string('house_number')->nullable();
            $table->integer('region_id')->unsigned()->nullable()->index();
            $table->integer('zone_id')->unsigned()->nullable()->index();
            $table->integer('woreda_id')->unsigned()->nullable()->index();
            $table->string('status')->nullable();
            $table->date('id_issue_date')->nullable();
            $table->date('id_expire_date')->nullable();
            $table->string('id_status')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('employees');
    }
}
