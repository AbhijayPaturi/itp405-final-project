<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tutorial extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function reviews() 
    {
        return $this->hasMany(Review::class, 'tutorial_id', 'id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}
