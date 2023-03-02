<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpOption\Option;

class Result extends Model
{
    use HasFactory;

    protected $fillable = ['quiz_user_id', 'topic_id', 'question_id', 'option_id', 'correct', 'date'];

    public function quiz_user()
    {
        return $this->belongsTo(QuizUser::class, 'quiz_user_id');
    }

    public function topic()
    {
        return $this->belongsTo(Topic::class, 'topic_id');
    }

    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id');
    }

    public function option()
    {
        return $this->belongsTo(QuestionsOption::class, 'option_id');
    }
}
