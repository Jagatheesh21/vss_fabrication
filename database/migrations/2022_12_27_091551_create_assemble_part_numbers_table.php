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
        Schema::create('assemble_part_numbers', function (Blueprint $table) {
            $table->id();
            $table->integer('part_type_id');
            $table->string('name');
            $table->string('project_name');
            $table->string('revision_number');
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
        Schema::dropIfExists('assemble_part_numbers');
    }
};
