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
        Schema::create('good_received_notes', function (Blueprint $table) {
            $table->id();
            $table->text('grn_number');
            $table->integer('purchase_order_id');
            $table->integer('raw_material_id');
            $table->integer('uom_id');
            $table->decimal('checked_quantity')->default(0.00);
            $table->integer('checked_by');
            $table->timestamp('checked_date');
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
        Schema::dropIfExists('good_received_notes');
    }
};
