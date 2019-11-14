<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnQWhoTravelsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('q_who_travels')->after('q3')->nullable();
            $table->dropColumn('q_how_many_age');
        });
        //todo remove users -> q3
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('q_who_travels');
            $table->string('q_how_many_age')->after('q_how_many_child')->nullable();
        });
    }
}
