<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paste extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'access',
        'language',
        'expiration_time',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
