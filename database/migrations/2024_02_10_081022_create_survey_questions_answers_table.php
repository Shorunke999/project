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
        Schema::create('survey_questions_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Survey_questions::class,'survey_question_id');
            $table->foreignIdFor(\App\Models\Survey_answers::class,'survey_answer_id');
            $table->text('answer');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('survey_questions_answers');
    }
};
