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
        Schema::create('child_part_unit_boms', function (Blueprint $table) {
            $table->id();
            $table->integer('child_part_number_id');
            $table->integer('uom_id');
            $table->decimal('bom',16,3);
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
        Schema::dropIfExists('child_part_unit_boms');
    }
};
