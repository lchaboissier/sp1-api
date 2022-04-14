<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('driver_id')->nullable()
                ->constrained('drivers');
            $table->foreignId('vehicle_id')->nullable()
                ->constrained('vehicles');
            $table->date('dateTime');
            $table->integer('halfDay');
            $table->boolean('active');
            $table->foreignId('booking_status_id')
                ->constrained('booking_statuses');
            $table->foreignId('trip_type_id')
                ->constrained('trip_types');
            $table->foreignId('agency_id')
                ->constrained('agencies');
            $table->foreignId('agencyArrived_id')
                ->constrained('agencies');
            $table->foreignId('company_id')
                ->constrained('companies');
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
        Schema::dropIfExists('bookings');
    }
}
