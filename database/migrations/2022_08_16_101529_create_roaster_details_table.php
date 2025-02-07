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
        Schema::create('roaster_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('roaster_id')->references('id')->on('roasters')->onDelete('Cascade')->onUpdate('Cascade');
            $table->foreignId('location_id')->references('id')->on('locations')->onDelete('Cascade')->onUpdate('Cascade');
            $table->date("daily_date");
            $table->time("start_time");
            $table->time("end_time");
            $table->enum("status", ["0", "1"])->default("0")->comment("0 for holiday, 1 for work day");
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
        Schema::dropIfExists('roaster_details');
    }
};
