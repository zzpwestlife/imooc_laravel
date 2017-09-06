<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStatusToSchoolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('schools', 'status')) {
            Schema::table('schools', function (Blueprint $table) {
                $table->tinyInteger('status')->default(0)->after('name')->comment('0 有效 -1 已删除');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('schools', 'status')) {
            Schema::table('schools', function (Blueprint $table) {
                $table->dropColumn('status');
            });
        };
    }
}
