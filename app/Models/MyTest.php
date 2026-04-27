<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MyTest extends Model
{
    use HasFactory;

    protected $table = 'my_tests';

    protected $fillable = [
        'name',
        'category',
        'questions',
        'time',
        'participants',
        'status',
        'description'
    ];
}