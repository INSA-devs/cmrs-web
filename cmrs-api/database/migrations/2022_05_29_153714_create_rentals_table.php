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
        Schema::create('rentals', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->string('phone');
            $table->float('price');
            $table->string('status');
            $table->json('address');
            $table->json('_geo');
            $table->timestamps();

            $table->foreignId('equipment_id')->constrained();
            $table->foreignId('pricing_type_id')->constrained();;
            $table->foreignId('user_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rentals');
    }
};
