<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDemandeDisponibiliteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('demande_disponibilite', function (Blueprint $table) {
            $table->integer('demande_id')->unsigned();
            $table->integer('disponibilite_id')->unsigned();
            $table->foreign('demande_id')->references('id')->on('demandes')->onDelete('cascade');
            $table->foreign('disponibilite_id')->references('id')->on('interventions')->onDelete('cascade');
            $table->primary(['demande_id', 'disponibilite_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('demande_disponibilite');
    }
}
