<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnQHowLongToToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('q_how_long', 'q_how_long_from');
        });
        Schema::table('users', function (Blueprint $table) {
            $table->string('q_how_long_to')->after('q_how_long_from')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('q_how_long_to');
            $table->renameColumn('q_how_long_from', 'q_how_long');
        });
    }
}
