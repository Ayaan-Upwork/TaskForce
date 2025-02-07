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
        Schema::create('leaves', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('employe_id')->unsigned();
            $table->foreign('employe_id')->references('id')->on('employes')->onDelete('Cascade')->onUpdate('Cascade');
            $table->date('start_date');
            $table->string('description');
            $table->date('end_date');
            $table->integer('total_leave_days');
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
        Schema::dropIfExists('leaves');
    }
};
