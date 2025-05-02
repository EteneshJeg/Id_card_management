<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


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
            $table->integer('martial_status_id')->unsigned()->nullable()->index();
            $table->string('nation')->nullable();
            $table->string('employment_id')->nullable();
            $table->date('job_position_start_date')->nullable();
            $table->date('job_position_end_date')->nullable();
            $table->string('address')->nullable();
            $table->string('house_number')->nullable();
            $table->string('status')->nullable();
            $table->date('id_issue_date')->nullable();
            $table->date('id_expire_date')->nullable();
            $table->string('id_status')->nullable();


            $table->unsignedInteger('job_position_id');
            $table->foreign('job_position_id')->references('id')->on('job_positions');

            $table->foreignId('organization_unit_id')->constrained('organization_units');
            $table->foreignId('job_title_category_id')->constrained('job_title_categories');
            $table->foreignId('salary_id')->constrained('salaries');
            $table->foreignId('region_id')->constrained('regions');
            $table->foreignId('zone_id')->constrained('zones');
            $table->foreignId('woreda_id')->constrained('woredas');
            

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
