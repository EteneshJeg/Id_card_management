<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganizationUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organization_units', function (Blueprint $table) {
            // Change 'id' to 'bigIncrements' to match the foreign keys
            $table->bigIncrements('id'); 
            $table->timestamps();
            $table->string('en_name')->nullable();
            $table->string('en_acronym')->nullable();
            $table->string('location')->nullable();
            $table->boolean('is_root_unit')->nullable();
            $table->boolean('is_category')->nullable();
            $table->string('synchronize_status')->nullable();

            $table->string('organization_id')->nullable();

            $table->string('parent')->nullable();
            $table->string('reports_to')->nullable();
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
        Schema::dropIfExists('organization_units');
    }
}
