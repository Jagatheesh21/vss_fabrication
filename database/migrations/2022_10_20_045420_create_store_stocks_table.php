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
            $table->foreignId('category_id');
            $table->foreignId('type_id');
            $table->foreignId('raw_material_id');
            $table->foreignId('uom_id');
            $table->decimal('inward_quantity',16,2);
            $table->decimal('checked_quantity',16,2)->default(0.00);
            $table->decimal('rejection_quantity',16,2)->default(0.00);
            $table->integer('status')->default(1);
            $table->foreignId('created_by');
            $table->foreignId('updated_by');
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
