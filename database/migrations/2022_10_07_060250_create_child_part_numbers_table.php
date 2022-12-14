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
        Schema::create('child_part_numbers', function (Blueprint $table) {
            $table->id();
            $table->integer('part_type_id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->text('project_name')->nullable();
            $table->text('revision_number')->nullable();
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
        Schema::dropIfExists('child_part_numbers');
    }
};
