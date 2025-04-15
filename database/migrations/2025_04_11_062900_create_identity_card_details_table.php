<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateIdentityCardDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('identity_card_details', function(Blueprint $table)
        {
            $table->increments('id');
            $table->timestamps();
            $table->string('field_label')->nullable();
            $table->string('label_length')->nullable();
            $table->string('field_name')->nullable();
            $table->string('type')->nullable();
            $table->string('text_content')->nullable();
            $table->string('text_positionx')->nullable();
            $table->string('text_positiony')->nullable();
            $table->string('text_font_type')->nullable();
            $table->string('text_font_size')->nullable();
            $table->string('text_font_color')->nullable();
            $table->string('image_file')->nullable();
            $table->string('image_width')->nullable();
            $table->string('image_height')->nullable();
            $table->boolean('has_mask')->nullable();
            $table->string('circle_diameter')->nullable();
            $table->string('circle_positionx')->nullable();
            $table->string('circle_positiony')->nullable();
            $table->string('circle_background')->nullable();
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
        Schema::drop('identity_card_details');
    }
}
