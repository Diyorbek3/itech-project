<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $table = 'feedback';  // ← QO'SHING (jadval nomi aniq)
    
    protected $fillable = ['name', 'email', 'message'];
}