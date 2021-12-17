<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsAtUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('Users', function (Blueprint $table) {
            $table->string('name', 45)->change();
            $table->string('user_name', 45)->after('name');
            $table->bigInteger('created_by');
            $table->bigInteger('updated_by');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('Users', function (Blueprint $table) {
            $table->dropColumn('updated_by');
            $table->dropColumn('created_by');
            $table->dropColumn('user_name');
        });
    }
}
