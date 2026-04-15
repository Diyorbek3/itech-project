<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'short_description',
        'full_description',
        'duration',
        'student_count',
        'has_certificate',
        'word_link',
        'excel_link',
        'powerpoint_link',
        'archive_link',
        'document_link',
        'curriculum',
        'target_audience',
        'teachers',
        'price',
        'start_in',
        'schedule',
        'language',
        'has_mentor_support',
        'image'
    ];
}