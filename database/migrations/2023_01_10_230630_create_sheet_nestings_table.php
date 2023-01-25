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
        Schema::create('sheet_nestings', function (Blueprint $table) {
            $table->id();
            $table->string('nesting_number');
            $table->integer('raw_material_id');
            $table->integer('category_id');
            $table->integer('type_id');
            $table->integer('child_part_number_id');
            $table->decimal('quantity',16,2);
            $table->decimal('unit_weight',16,2)->default(0.00);
            $table->decimal('total_weight',16,2)->default(0.00);
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
        Schema::dropIfExists('sheet_nestings');
    }
};
