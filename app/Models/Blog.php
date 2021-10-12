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
        'category_id',
        'user_id',
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

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable')->whereNull('parent_id');
    }
    
}
