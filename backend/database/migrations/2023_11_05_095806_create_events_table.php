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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('organizer_id')->unsigned(); //Organizer
            $table->string('topic',100);
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->dateTime('announcement_date');
            $table->longText('description');
            $table->string('venue',100);
            $table->string('address_line_1',100)->nullable();
            $table->string('address_line_2',100)->nullable();
            $table->foreignId('brgy_address')->nullable()->constrained('ref_barangay');
            $table->longText('complete_address')->nullable();
            $table->string('status',50);
            $table->string('banner_url',100);
            $table->boolean('isGroup')->default(false);
            $table->tinyInteger('number_of_members')->default(1);
            $table->boolean('public_can_vote')->default(false);
            $table->boolean('member_can_vote')->default(false);
            $table->tinyInteger('public_numbers_of_vote')->default(1);
            $table->tinyInteger('member_numbers_of_vote')->default(1);
            $table->tinyInteger('judge_vote_percentage')->default(100);
            $table->tinyInteger('member_vote_percentage')->default(0);
            $table->tinyInteger('public_vote_percentage')->default(0);
            $table->timestamps();

            $table->foreign('organizer_id')->references('id')->on('members');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
