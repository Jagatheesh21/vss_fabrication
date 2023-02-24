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
        Schema::create('store_stocks', function (Blueprint $table) {
            $table->id();
            $table->string('grn_number');
            $table->foreignId('category_id');
            $table->foreignId('type_id');
            $table->foreignId('raw_material_id');
            $table->foreignId('material_type_id');
            $table->foreignId('material_uom_id');
            $table->foreignId('uom_id');
            $table->decimal('inward_quantity',16,3)->default(0.000);
            $table->decimal('inward_material_quantity',16,3)->default(0.000);
            $table->decimal('checked_quantity',16,3)->default(0.000);
            $table->decimal('rejection_quantity',16,3)->default(0.000);
            $table->decimal('issued_quantity',16,3)->default(0.000);
            $table->decimal('unit_material_quantity',16,3)->default(0.000);
            $table->decimal('issued_material_quantity',16,3)->default(0.000);
            $table->decimal('available_quantity',16,3)->default(0.000);
            $table->integer('status')->default(1);
            $table->foreignId('created_by');
            $table->foreignId('updated_by');
            $table->integer('approved_by')->nullable();
            $table->date('approved_date')->nullable();
            $table->integer('approved_status')->default(0);
            $table->integer('confirm')->default(0);
            $table->string('inspection_report')->nullable();
            $table->text('remarks')->nullable();
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
        Schema::dropIfExists('store_stocks');
    }
};
