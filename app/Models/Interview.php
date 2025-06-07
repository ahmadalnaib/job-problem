<?php

namespace App\Models;

use Illuminate\Support\Str;
use App\Models\JobApplication;
use Illuminate\Database\Eloquent\Model;

class Interview extends Model
{
    
//     protected $casts = [
//     'scheduled_at' => 'datetime',
//     'remind_me' => 'datetime',
// ];
protected $guarded = [];
    public function jobApplication()
{
    return $this->belongsTo(JobApplication::class);
}

 protected static function booted()
    {
        static::creating(function ($interview) {
            $interview->slug = Str::slug(
                $interview->location  . '-' . uniqid()
            );
        });
    }

    
}
