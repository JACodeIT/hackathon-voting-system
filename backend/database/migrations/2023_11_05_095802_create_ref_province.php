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
        Schema::create('ref_province', function (Blueprint $table) {
            $table->id();
            $table->foreignId('regionID')->constrained('ref_region');
            $table->string('psgcCode');
            $table->string('provDesc');
            $table->string('regCode');
            $table->string('provCode');
            $table->boolean('isSystemDefault')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ref_province');
    }
};
