<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quiz_user_id')->constrained('quiz_users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('topic_id')->constrained('topics')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('question_id')->constrained('questions')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('option_id')->constrained('questions_options')->onUpdate('cascade')->onDelete('cascade');
            $table->string('correct');
            $table->datetime('date');
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
        Schema::dropIfExists('results');
    }
};
