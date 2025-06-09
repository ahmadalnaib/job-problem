<?php

namespace App\Models;

use Illuminate\Support\Str;
use App\Models\JobApplication;
use Illuminate\Database\Eloquent\Model;

class Interview extends Model
{
    
protected $casts = [
    'scheduled_at' => 'datetime:Y-m-d H:i:s',
    'remind_me' => 'datetime:Y-m-d H:i:s',
    'reminder_sent' => 'boolean',
];

protected $guarded = [];
    public function jobApplication()
{
    return $this->belongsTo(JobApplication::class);
}

 protected static function booted()
    {
        static::creating(function ($interview) {
            $interview->slug = Str::slug(
                $interview->scheduled_at  . '-' . uniqid()
            );
        });
    }

    
}
