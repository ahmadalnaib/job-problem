<?php

namespace App\Models;

use App\Models\JobApplication;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    //
    public function jobApplication()
{
    return $this->belongsTo(JobApplication::class);
}
}
