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
        Schema::create('child_part_boms', function (Blueprint $table) {
            $table->id();
            $table->string('bom_id');
            $table->foreignId('category_id');
            $table->foreignId('type_id');
            $table->foreignId('raw_material_id');
            $table->foreignId('nesting_id');
            $table->foreignId('nesting_type_id');
            $table->foreignId('child_part_number_id');
            $table->double('quantity',16,0)->default(0.00);
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
        Schema::dropIfExists('child_part_boms');
    }
};
