<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_name',
        'num_of_posts'
    ];

    public function posts() {
        return $this->hasMany('App\Models\Post');
    }
}
