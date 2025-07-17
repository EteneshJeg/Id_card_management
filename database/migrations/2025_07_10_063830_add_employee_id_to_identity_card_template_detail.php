<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('identity_card_template_details', function (Blueprint $table) {
            //
            $table->unsignedInteger('employee_id');
            $table->foreign('employee_id')->references('id')->on('employees');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('identity_card_template_details', function (Blueprint $table) {
            //
            $table->dropForeign(['employee_id']);
            $table->dropColumn('employee_id');
        });
    }
};
