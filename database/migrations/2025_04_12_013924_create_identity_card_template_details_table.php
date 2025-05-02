<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIdentityCardTemplateDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('identity_card_template_details', function(Blueprint $table)
        {
            $table->increments('id');
            $table->timestamps();

            $table->foreignId('identity_card_template_id')
                ->constrained('identity_card_templates')
                ->onDelete('cascade');

            $table->foreignId('identity_card_detail_id')->constrained('identity_card_details'); 

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('identity_card_template_details');
    }
}
