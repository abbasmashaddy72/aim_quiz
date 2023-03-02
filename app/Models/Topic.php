<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'count',
        'start',
        'end',
        'type',
        'qr',
        'age_restriction',
        'declaration',
        'matter',
        'pdf',
    ];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
