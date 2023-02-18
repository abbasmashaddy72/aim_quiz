<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'type',
        'qr',
        'age_restriction',
        'pdf'
    ];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}