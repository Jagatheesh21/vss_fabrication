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
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->id();
            $table->string('purchase_order_number');
            $table->integer('supplier_id');
            $table->integer('cgst');
            $table->integer('sgst');
            $table->integer('igst');
            $table->integer('tax');
            $table->decimal('sub_total',16,2);
            $table->decimal('tax_price',16,2);
            $table->decimal('total_price',16,0);
            $table->timestamp('purchase_order_date');
            $table->string('invoice_number');
            $table->string('reference_number');
            $table->string('gst_number');
            $table->text('address');
            $table->string('state');
            $table->integer('state_code');
            $table->string('delivery_terms');
            $table->string('mode_of_dispatch');
            $table->string('payment_terms');
            $table->integer('status')->default(1);
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
        Schema::dropIfExists('purchase_orders');
    }
};
