<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paste extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'access_id',
        'lang_id',
        'user_id',
        'expiration_time',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function access()
    {
        return $this->belongsTo(Access::class);
    }

    public function lang()
    {
        return $this->belongsTo(Lang::class);
    }

    public function scopeExpired($q)
    {
        return $q->whereNull('expiration_time')
            ->orWhere('expiration_time', '>', now());
    }

    public function scopeNew($q)
    {
        return $q->orderBy('created_at', 'desc')
            ->orderBy('id', 'desc');
    }


}
