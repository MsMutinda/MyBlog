<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Subscription;
use App\Traits\showBlogTrait;


class HomeController extends Controller
{
    
    use showBlogTrait;

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request) 
    {    
        // fetch latest blogs
        $blogs = Blog::where('status', 'pending review')->orderBy('created_at', 'DESC')->take(5)->get();

        // fetch blog categories
        $categories = Category::all();

        return view('pages.home')->with(['blogs'=>$blogs, 'categories'=>$categories]);
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


        // call the show() method
        return $this->show(1);
        // return \App::call('App\Http\Controllers\HomeController@show');
    }

}
