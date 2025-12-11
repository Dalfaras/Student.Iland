<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'study_level',
        'situation',
        'study_field',
        'year',
        'city',
        'campus',
        'bio',
        'visibility_students_only',
        'hide_from_public_groups',
        'hide_from_recommendations',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
