<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $guarded = [];
    
    public function user() 
    {
        return $this->belongsTo(User::class);
    }

    //a comment can have multiple replies
    public function replies() 
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }

    // a comment can have many likes
    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }
}
