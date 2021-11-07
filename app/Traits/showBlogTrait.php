<?php

namespace App\Traits;
use App\Models\Blog;
use App\Models\Category;

trait showBlogTrait {
    
    function show($id)
    {
        // if ($request->user()->can('like-blog')) {
            $blogs = Blog::where('id', $id)->get();
            $categories = Category::all();
            return redirect()->route('view-blog', [$id])->with(['blogs'=>$blogs, 'categories'=>$categories]);
        // }
    }

}