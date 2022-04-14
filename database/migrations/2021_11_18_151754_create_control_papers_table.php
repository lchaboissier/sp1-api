<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateControlPapersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('control_papers', function (Blueprint $table) {
            $table->id();
            $table->integer('type');
            $table->integer('kilometers');
            $table->dateTime('dateTime');
            $table->string('observations');
            $table->foreignId('vehicle_id')
                ->constrained('vehicles');
            $table->boolean('signed');
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
        Schema::dropIfExists('control_papers');
    }
}
