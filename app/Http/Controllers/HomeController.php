<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Category;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request) 
    {    
        // fetch latest blogs
        $blogs = Blog::orderBy('created_at', 'DESC')->take(6)->get();

        // fetch blog categories
        $categories = Category::all();

        // get featured posts
        $featuredBlogs = Blog::all()->random(3);

        return view('pages.home')->with(['blogs'=>$blogs, 'categories'=>$categories, 'featuredBlogs'=>$featuredBlogs]);
    }

}
