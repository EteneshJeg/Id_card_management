<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrganizationUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organization_units', function(Blueprint $table)
        {
            $table->increments('id');
            $table->timestamps();
            $table->string('en_name')->nullable();
            $table->string('en_acronym')->nullable();
            $table->string('parent')->nullable();
            $table->string('reports_to')->nullable();
            $table->string('location')->nullable();
            $table->boolean('is_root_unit')->nullable();
            $table->boolean('is_category')->nullable();
            $table->string('synchronize_status')->nullable();
            $table->string('chairman')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('organization_units');
    }
}
