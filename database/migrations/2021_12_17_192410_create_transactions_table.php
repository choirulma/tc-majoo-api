<?php

use App\Common\CustomBlueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
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

        $schema->create('Transactions', function (CustomBlueprint $table) {
            $table->id();
            $table->bigInteger('merchant_id');
            $table->bigInteger('outlet_id');
            $table->double('bill_total');
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
        Schema::dropIfExists('Transactions');
    }
}
