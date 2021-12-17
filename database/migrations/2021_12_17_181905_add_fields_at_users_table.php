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
        Schema::rename('users', 'Users');

        Schema::table('Users', function (Blueprint $table) {
            $table->string('name', 45)->change();
            $table->dropColumn('email');
            $table->dropColumn('email_verified_at');
            $table->dropColumn('remember_token');
            $table->string('user_name', 45)->unique()->after('name');
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
            $table->dropColumn('user_name');
            $table->string('remember_token', 100)->nullable()->after('password');
            $table->timestamp('email_verified_at')->nullable()->after('name');
            $table->string('email')->after('name');
        });

        Schema::rename('Users', 'users');
    }
}
