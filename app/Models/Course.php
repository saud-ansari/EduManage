<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
    protected $fillable = [
        'teacher_id',
        'name',
        'description',
        'duration',
        'fees',
        'is_active',
    ];

    // Each course belongs to one teacher
    public function teacher(): BelongsTo
    {
        return $this->belongsTo(Teacher::class);
    }

    // One course can have many students
    public function students(): HasMany
    {
        return $this->hasMany(Student::class);
    }
}
