<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = ['topic_id', 'question_text', 'answer_explanation', 'more_info_link'];

    public function topic()
    {
        return $this->belongsTo(Topic::class, 'topic_id');
    }

    public function options()
    {
        return $this->hasMany(QuestionsOption::class, 'question_id');
    }
}
