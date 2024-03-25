<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    public function tutorial() 
    {
        return $this->belongsTo(Tutorial::class, 'tutorial_id');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
