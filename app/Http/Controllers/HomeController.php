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

    public function filterByCategory($id, $name) {
        // fetch blog categories
        $categories = Category::all();

        // show blogs for a specific category
        $filtered = Blog::where('category', $id)->get();
        $categoryname = Category::where('id', $id)->pluck('name');

        return view('pages.blogs.filtered')->with(['categories'=>$categories, 'filtered'=>$filtered, 'categoryname'=>$categoryname]);
    }

}
