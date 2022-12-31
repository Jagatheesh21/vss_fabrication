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
            $table->integer('raw_material_id');
            $table->integer('uom_id');
            $table->decimal('quantity',16,0);
            $table->decimal('unit_quantity',16,0);
            $table->decimal('total_quantity',16,0);
            $table->timestamp('purchase_order_date')->useCurrent();
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
