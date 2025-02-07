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
        Schema::create('roasters', function (Blueprint $table) {
            $table->id();
            // $table->bigInteger('emp_id')->unsigned();
            $table->foreignId('emp_id')->references('id')->on('employes')->onDelete('Cascade')->onUpdate('Cascade');
            // $table->bigInteger('location_id')->unsigned();
            // $table->foreign('location_id')->references('id')->on('locations')->onDelete('Cascade')->onUpdate('Cascade');
            // $table->bigInteger('shift_id')->unsigned();
            // $table->foreign('shift_id')->references('id')->on('shifts')->onDelete('Cascade')->onUpdate('Cascade');
            $table->date('from_date');
            $table->date('to_date');
            $table->string('description');
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
        Schema::dropIfExists('roasters');
    }
};
