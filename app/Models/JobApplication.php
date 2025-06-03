<?php

namespace App\Models;

use App\Models\Note;
use App\Models\User;
use App\Models\Interview;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    //
    protected $guarded = [];
    public function user()
{
    return $this->belongsTo(User::class);
}


public function interviews()
{
    return $this->hasMany(Interview::class);
}

    protected static function booted()
    {
        static::creating(function ($jobApplication) {
            $jobApplication->slug = Str::slug(
                $jobApplication->company . '-' . $jobApplication->position . '-' . uniqid()
            );
        });
    }

}
