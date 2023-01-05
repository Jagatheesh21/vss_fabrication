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
        Schema::create('po_masters', function (Blueprint $table) {
            $table->id();
            $table->string('rm_po_number');
            $table->integer('supplier_id');
            $table->integer('raw_material_id');
            $table->integer('uom_id');
            $table->date('po_date');
            $table->string('invoice_number');
            $table->decimal('po_quantity',16,2);
            $table->decimal('material_quantity',16,2);
            $table->integer('material_uom_id');
            $table->decimal('unit_material_quantity',16,2);
            $table->text('remarks')->nullable();
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
        Schema::dropIfExists('po_masters');
    }
};
