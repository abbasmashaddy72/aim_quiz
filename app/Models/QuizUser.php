<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'unique_id',
        'name',
        'father_name',
        'gender',
        'dob',
        'location',
        'mobile',
        'aic',
    ];

    protected $casts = [
        'dob' => 'date:Y-m-d',
    ];

    public function result()
    {
        return $this->hasMany(Result::class, 'quiz_user_id');
    }
}
