<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Student extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'date_of_birth',
        'course',
        'course_id',
        'marks',
    ];

    // Each student belongs to one course
    public function courseDetails(): BelongsTo
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
}
