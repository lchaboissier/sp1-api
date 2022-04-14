<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDamagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('damages', function (Blueprint $table) {
            $table->foreignId('control_paper_id')
                ->constrained('control_papers');
            $table->foreignId('damage_type_id')
                ->constrained('damage_types');
            $table->foreignId('part_id')
                ->constrained('parts');
            $table->primary(['control_paper_id', 'part_id']);
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
        Schema::dropIfExists('damages');
    }
}
