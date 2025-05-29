<?php

namespace App\Models;

use App\Models\Note;
use App\Models\User;
use App\Models\Interview;
use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    //
    public function user()
{
    return $this->belongsTo(User::class);
}

public function notes()
{
    return $this->hasMany(Note::class);
}

public function interviews()
{
    return $this->hasMany(Interview::class);
}
}
