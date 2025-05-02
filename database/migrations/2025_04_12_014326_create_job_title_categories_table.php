<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobTitleCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_title_categories', function (Blueprint $table) {
            $table->id(); // This will create an unsignedBigInteger by default.
            $table->timestamps();
            $table->string('name', 255)->nullable();
            $table->string('description', 1000)->nullable();
            $table->string('parent')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_title_categories');
    }
}
