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
        Schema::create('criterias', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('criterion_id')->unsigned();
            $table->decimal('min_rating', 5, 2);
            $table->decimal('max_rating', 5, 2);
            $table->tinyInteger('percentage_value')->default(100);
            $table->timestamps();

            $table->foreign('criterion_id')->references('id')->on('criterions');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('criterias');
    }
};
