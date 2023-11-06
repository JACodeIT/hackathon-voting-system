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
        Schema::create('ref_region', function (Blueprint $table) {
            $table->id();
            $table->string('psgcCode');
            $table->string('regDesc');
            $table->string('regCode');
            $table->boolean('isSystemDefault')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ref_region');
    }
};
