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
        Schema::table('users', function (Blueprint $table) {
            // Add 'employee' column
            $table->unsignedInteger('employee')->nullable();

            // Define foreign key explicitly using 'employee'
            $table->foreign('employee')
                  ->references('id')
                  ->on('employees')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->dropForeign(['employee']); // drop constraint first
            $table->dropColumn('employee');
        });
    }
};
