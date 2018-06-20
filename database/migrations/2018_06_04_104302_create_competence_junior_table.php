<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompetenceJuniorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('competence_junior', function (Blueprint $table) {
            $table->integer('competence_id')->unsigned();
            $table->integer('junior_id')->unsigned();
            $table->integer('niveau');
            $table->foreign('competence_id')->references('id')->on('competences')->onDelete('cascade');
            $table->foreign('junior_id')->references('id')->on('juniors')->onDelete('cascade');
            $table->primary(['competence_id', 'junior_id']);
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
        Schema::dropIfExists('competence_junior');
    }
}
