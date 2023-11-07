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
        Schema::create('ref_citymun', function (Blueprint $table) {
            $table->id();
            $table->foreignId('provinceID')->constrained('ref_province');
            $table->string('psgcCode');
            $table->string('citymunDesc');
            $table->string('regCode');
            $table->string('provCode');
            $table->string('citymunCode');
            $table->boolean('isSystemDefault')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ref_citymun');
    }
};
