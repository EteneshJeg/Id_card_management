<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrganizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organizations', function(Blueprint $table)
        {
            $table->increments('id');
            $table->timestamps();
            $table->string('en_name')->nullable();
            $table->string('motto')->nullable();
            $table->string('mission')->nullable();
            $table->string('vision')->nullable();
            $table->string('core_value')->nullable();
            $table->string('logo')->nullable();
            $table->string('address')->nullable();
            $table->string('website')->nullable();
            $table->string('email')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('fax_number')->nullable();
            $table->string('po_box')->nullable();
            $table->string('tin_number')->nullable();
            $table->string('abbreviation')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('organizations');
    }
}
