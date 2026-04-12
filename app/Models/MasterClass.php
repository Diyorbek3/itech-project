<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterClass extends Model
{
    // Mass assignment xatoligini oldini olish uchun ruxsat berilgan ustunlar
    protected $fillable = [
        'title',
        'description',
        'event_date',
        'image',
        'telegram_link',
    ];
}