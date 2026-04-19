<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterclassRegistration extends Model
{
    use HasFactory;

    protected $table = 'masterclass_registrations';

    protected $fillable = [
        'masterclass_id',
        'user_id',
        'name',
        'phone',
        'email',
        'telegram_sent',
        'status'
    ];

    protected $casts = [
        'telegram_sent' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    // Masterclass bilan bog'lanish
    public function masterclass()
    {
        return $this->belongsTo(MasterClass::class, 'masterclass_id');
    }

    // User bilan bog'lanish
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}