<?php

use App\Common\CustomBlueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateMerchantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $schema = \DB::connection()->getSchemaBuilder();

        $schema->blueprintResolver(function($table, $callback) {
            return new CustomBlueprint($table, $callback);
        });

        $schema->create('Merchants', function (CustomBlueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->string('merchant_name', 40);
            $table->commonFields();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Merchants');
    }
}
