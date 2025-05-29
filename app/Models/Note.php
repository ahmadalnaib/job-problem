<?php

namespace App\Models;

use App\Models\JobApplication;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $guarded = [];
    //
    public function jobApplication()
{
    return $this->belongsTo(JobApplication::class);
}
}
