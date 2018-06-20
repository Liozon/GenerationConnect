<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDisponibilitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disponibilites', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('recurrence_id')->nullable();
            $table->foreign('recurrence_id')->references('id')->on('recurrences');
            $table->integer('junior_id')->nullable();
            $table->foreign('junior_id')->references('id')->on('juniors');
            $table->time('heureDebut');
            $table->time('heureFin');
            $table->date('date')->nullable();
            $table->string('jourDeLaSemaine')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('disponibilites');
    }
}
