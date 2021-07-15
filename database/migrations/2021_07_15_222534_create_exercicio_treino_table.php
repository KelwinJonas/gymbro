<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExercicioTreinoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exercicio_treino', function (Blueprint $table) {
            $table->id();
            $table->string('serie');
            $table->string('repeticoes');
            $table->string('descricao');
            $table->foreignId('exercicio_id')->references('id')->on('exercicios')->cascadeOnDelete();
            $table->foreignId('treino_id')->references('id')->on('treinos')->cascadeOnDelete();
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
        Schema::dropIfExists('exercicio_treino');
    }
}
