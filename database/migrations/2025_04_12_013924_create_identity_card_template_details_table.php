<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

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
            $table->integer('identity_card_template_id')->unsigned()->nullable()->index();
            $table->integer('identity_card_detail_id')->unsigned()->nullable()->index();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('identity_card_template_details');
    }
}
