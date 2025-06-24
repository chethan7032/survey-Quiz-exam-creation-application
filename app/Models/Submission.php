<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    use HasFactory;
       protected $fillable = [
        'form_id',
        'user_id',
        'form_data',
        'submitted_at',
    ];

  
    protected $casts = [
        'form_data' => 'array',
    ];

    public function form()
    {
        return $this->belongsTo(\App\Models\Form::class);
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}
