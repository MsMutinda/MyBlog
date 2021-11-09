<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Subscription;


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
        $blogs = Blog::where('status', 'pending review')->take(5)->get();

        // fetch blog categories
        $categories = Category::all();

        return view('pages.home')->with(['blogs'=>$blogs, 'categories'=>$categories]);
    }

    public function show($id)
    {
        $blogs = Blog::where('id', $id)->get();
        $categories = Category::all();
        return view('pages.blogs.show')->with(['blogs'=>$blogs, 'categories'=>$categories]);
    }

    public function filterByCategory($id, $name) {
        // fetch blog categories
        $categories = Category::all();

        // show blogs for a specific category
        $filtered = Blog::where('category', $id)->get();
        $categoryname = Category::where('id', $id)->pluck('name');

        return view('pages.blogs.filtered')->with(['categories'=>$categories, 'filtered'=>$filtered, 'categoryname'=>$categoryname]);
    }

    public function saveSubscriber(Request $request) {
        Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:subscriptions'],
        ]);
    
        $subscriber = new Subscription();
        $subscriber->name = $request->name;
        $subscriber->email = $request->email;
        $subscriber->save();

        $id = $request->blog;
        $blog = Blog::where('id', $id)->get();

        // get estimated reading time for each blog
        $blog_content = Blog::where('id', $id)->get('content');
        $wpm = 200;
        $wordCount = str_word_count(strip_tags($blog_content));
        $minutes = (int) floor($wordCount / $wpm);

        $categories = Category::all();
        $blog_category = Blog::where('id', $id)->get('category');
        $relatedblogs = Blog::where('category', $blog_category)->where('id', '!=', $id)->get();

        // call the show() method
        // return redirect()->route('view-blog', [$id])->with(['blog'=>$blog, 'categories'=>$categories]);
        return view('pages.blogs.show')->with(['blog'=>$blog, 'minutes'=>$minutes, 'categories'=>$categories]);
    }

}
