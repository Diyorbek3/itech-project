<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseRegistration extends Model
{
    use HasFactory;

    protected $table = 'course_registrations';

    protected $fillable = [
        'course_id',
        'user_id',
        'name',
        'phone',
        'email',
        'message',
        'status',
        'telegram_sent'
    ];

    protected $casts = [
        'telegram_sent' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    // Relationship: CourseRegistration -> Course
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    // Relationship: CourseRegistration -> User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
