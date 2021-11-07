<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCompletedAtToToDoItemsTable extends Migration
{
    public function up(): void
    {
        Schema::table('to_do_items', function (Blueprint $table) {
            $table->timestamp('completed_at')->nullable()->default(null)->after('title');
        });
    }

    public function down(): void
    {
        Schema::table('to_do_items', function (Blueprint $table) {
            $table->dropColumn('completed_at');
        });
    }
}
