<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('candidates', function (Blueprint $table) {
            // Create a new timestamp column (e.g., birthdate_unix) with the desired type
            $table->timestamp('birthdate_unix')->nullable();
        });

        // Copy data from the old column to the new one
        DB::table('candidates')->update(['birthdate_unix' => DB::raw('UNIX_TIMESTAMP(birthdate)')]);

        // Remove the old column
        Schema::table('candidates', function (Blueprint $table) {
            $table->dropColumn('birthdate');
        });

        // Rename the new column to match the old one
        Schema::table('candidates', function (Blueprint $table) {
            $table->renameColumn('birthdate_unix', 'birthdate');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
