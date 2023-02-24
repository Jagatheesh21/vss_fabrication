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
        Schema::create('route_card_transactions', function (Blueprint $table) {
            $table->id();
            $table->integer('route_card_type_id')->nullable();
            $table->string('route_card_number')->nullable();
            $table->integer('from_operation_id');
            $table->integer('to_operation_id');
            $table->string('prev_route_card_type_id')->nullable();
            $table->string('prev_route_card_number')->nullable();
            $table->integer('raw_material_id')->nullable();
            $table->decimal('issued_raw_material_quantity',16,3)->default(0.000);
            $table->integer('child_part_number_id');
            $table->integer('nesting_type_id');
            $table->decimal('issued_quantity',16,3)->default(0.000);
            $table->decimal('ok_quantity',16,3)->default(0.000);
            $table->decimal('rejected_quantity',16,3)->default(0.000);
            $table->decimal('rework_quantity',16,3)->default(0.000);
            $table->integer('status')->default(1);
            $table->timestamp('closed_date')->nullable();
            $table->integer('user_id');
            $table->string('ip_address');
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
        Schema::dropIfExists('route_card_transactions');
    }
};
