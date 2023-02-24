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
        Schema::create('store_transactions', function (Blueprint $table) {
            $table->id();
            $table->enum('transaction_type',['Receive','Issue']);
            $table->foreignId('category_id');
            $table->foreignId('type_id');
            $table->foreignId('raw_material_id');
            $table->foreignId('child_part_number_id')->nullable();
            $table->foreignId('nesting_id')->nullable();
            $table->foreignId('purchase_order_id')->nullable();
            $table->foreignId('uom_id');
            $table->foreignId('route_card_type_id')->nullable();
            $table->string('route_card_number')->nullable();
            $table->string('grn_number')->nullable();
            $table->decimal('received_quantity',16,3)->default('0.000');
            $table->decimal('issue_quantity',16,3)->default('0.000');
            $table->integer('status')->default(1);
            $table->integer('route_card_status')->default(1);
            $table->timestamp('closed_date')->nullable();
            $table->integer('reason_for_closing')->nullable();
            $table->integer('closed_by')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('store_transactions');
    }
};
