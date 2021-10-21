<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Category;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        // fetch all blogs
        $blogs = Blog::all();

        // fetch blog categories
        $categories = Category::all();

        // show blogs for a specific category
        $filtered = Blog::where('category', $request->selected_category)->get();
        // dd($selected_category);

        // featured posts
        $featuredBlogs = Blog::all()->random(3);
        return view('pages.home')->with(['blogs'=>$blogs, 'categories'=>$categories, 'featuredBlogs'=>$featuredBlogs]);
    }
}
