<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Blog extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];
    protected $fillable = [
    'category',
    'image_path',
    'title',
    'author',
    'content'
    ];

   //get user who owns the post
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category() {
        return $this->belongsTo('App\Models\Category');
    }

   // Comments
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable')->where('parent_id', 0)->where('approval_status', 'approved');
    }

   // Likes
    public function likes(){
        return $this->hasMany('App\Models\LikeDislike', 'blog_id')->sum('likes');
    }
   // Dislikes
    public function dislikes(){
        return $this->hasMany('App\Models\LikeDislike', 'blog_id')->sum('dislikes');
    }

}