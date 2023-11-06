<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('judges_scoreboards', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('event_judge')->unsigned();
            $table->bigInteger('event_criteria')->unsigned();
            $table->bigInteger('squad_id')->unsigned();
            $table->decimal('score',5,2);
            $table->timestamps();

            $table->foreign('event_judge')->references('id')->on('event_judges');
            $table->foreign('event_criteria')->references('id')->on('event_criterias');
            $table->foreign('squad_id')->references('id')->on('squads');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('judges_scoreboards');
    }
};
