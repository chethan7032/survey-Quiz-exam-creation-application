<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    use HasFactory;



    public function form()
{
    return $this->belongsTo(\App\Models\Form::class);
}

public function user()
{
    return $this->belongsTo(\App\Models\User::class);
}

}
