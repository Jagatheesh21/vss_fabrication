<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('route_card_transactions', function (Blueprint $table) {
            $table->integer('store_stock_id')->nullable();
            $table->integer('type_of_issue')->nullable();
            $table->string('nesting_number')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('route_card_transactions', function (Blueprint $table) {
            //
        });
    }
};
