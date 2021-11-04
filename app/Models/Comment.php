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

    // Likes
    public function likes(){
        return $this->hasMany('App\Models\CommentLike', 'parent_comment_id')->sum('likes');
    }

    // Dislikes
    public function dislikes(){
        return $this->hasMany('App\Models\CommentLike','parent_comment_id')->sum('dislikes');
    }
}

