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
        Schema::create('raw_material_delivery_challans', function (Blueprint $table) {
            $table->id();
            $table->string('dc_number');
            $table->integer('grn_id');
            $table->integer('sub_contractor_id');
            $table->integer('raw_material_id');
            $table->integer('uom_id');
            $table->integer('part_number_id');
            $table->decimal('issued_quantity',16,3)->default(0.000);
            $table->decimal('received_quantity',16,3)->default(0.000);
            $table->decimal('rework_quantity',16,3)->default(0.000);
            $table->decimal('reject_quantity',16,3)->default(0.000);
            $table->integer('closed_status')->default(0);
            $table->date('closed_date')->nullable();
            $table->integer('created_by')->nullable();
            $table->string('created_ip');
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
        Schema::dropIfExists('raw_material_deliver_challans');
    }
};
