<?php

use App\Common\CustomBlueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateOutletsTable extends Migration
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

        $schema->create('Outlets', function (CustomBlueprint $table) {
            $table->id();
            $table->bigInteger('merchant_id');
            $table->string('outlet_name', 40);
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
        Schema::dropIfExists('Outlets');
    }
}
