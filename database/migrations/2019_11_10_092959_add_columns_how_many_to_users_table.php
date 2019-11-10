<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsHowManyToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('q_how_many_adults')->after('q3')->nullable();
            $table->integer('q_how_many_child')->after('q_how_many_adults')->nullable();
            $table->integer('q_how_many_age')->after('q_how_many_child')->nullable();
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
            $table->dropColumn('q_how_many_adults');
            $table->dropColumn('q_how_many_child');
            $table->dropColumn('q_how_many_age');
        });
    }
}
