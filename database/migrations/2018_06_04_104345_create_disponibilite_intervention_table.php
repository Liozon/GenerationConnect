<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDisponibiliteInterventionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dispo_intervention', function (Blueprint $table) {
            $table->integer('disponibilite_id')->unsigned();
            $table->integer('intervention_id')->unsigned();
            $table->foreign('disponibilite_id')->references('id')->on('disponibilites')->onDelete('cascade');
            $table->foreign('intervention_id')->references('id')->on('interventions')->onDelete('cascade');
            $table->primary(['disponibilite_id', 'intervention_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dispo_intervention');
    }
}
