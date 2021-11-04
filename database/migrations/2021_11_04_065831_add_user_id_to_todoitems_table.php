<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdToTodoitemsTable extends Migration
{
    public function up()
    {
        Schema::table('to_do_items', function (Blueprint $table) {
            $table->bigInteger('user_id')->after('id');
        });
    }

    public function down()
    {
        Schema::table('to_do_items', function (Blueprint $table) {
            $table->dropColumn('user_id');
        });
    }
}
