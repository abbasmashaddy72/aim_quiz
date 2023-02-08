<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'age',
        'location',
        'mobile',
    ];

    public function result()
    {
        return $this->hasMany(Result::class, 'quiz_user_id');
    }
}
