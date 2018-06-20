<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInterventioneffectivesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interventioneffectives', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('intervention_id');
            $table->date('date');
            $table->foreign('intervention_id')->references('id')->on('interventions');
            $table->time('heureDebut');
            $table->time('heureFin');
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
        Schema::dropIfExists('interventioneffectives');
    }
}
