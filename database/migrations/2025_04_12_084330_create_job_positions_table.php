<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobPositionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_positions', function (Blueprint $table) {
            $table->increments('id'); // Primary key
            $table->timestamps();
            $table->string('job_description')->nullable();
            $table->string('position_code')->nullable();
            $table->unsignedBigInteger('position_id')->nullable()->index();
            $table->string('status')->nullable();

            // Foreign key definitions
            $table->foreignId('organization_unit_id')->constrained('organization_units');
            // Change the job_title_category_id to match the unsignedBigInteger type of id in job_title_categories
            $table->unsignedBigInteger('job_title_category_id'); 
            $table->foreign('job_title_category_id')->references('id')->on('job_title_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_positions');
    }
}
