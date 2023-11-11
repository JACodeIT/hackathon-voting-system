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
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('first_name', 100);
            $table->string('middle_name', 50)->nullable();
            $table->string('last_name', 50);
            $table->string('name_extension', 10)->nullable();
            $table->string('github_account', 100);
            $table->string('discord_username', 100);
            $table->bigInteger('user_id')->unsigned();
            $table->integer('be_rating');
            $table->integer('fe_rating');
            $table->integer('ui_ux_rating');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
