<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Subscription;
use DB;


class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request) 
    {    
        if(count(Blog::all()) == 0) {
            return 'No blogs have been published yet'.'<br>'.'Click here to contribute';
        }

        // fetch only published blogs
        $blogs = Blog::where('status', 'published')->take(5)->get();

        // 4 random blogs as trending
        $latestblogs = Blog::inRandomOrder()->limit(4)->get();

        // fetch blog categories
        $categories = Category::all();

        return view('pages.home')->with(['blogs' => $blogs, 'latestblogs' => $latestblogs, 'categories' => $categories]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $blog = Blog::where('id', $id)->first();
        $categories = Category::all();
        return view('pages.blogs.show')->with(['blog'=>$blog, 'categories'=>$categories]);
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
        $checkuser = DB::table('subscriptions')
            ->where('email', $request->email)
            ->get();
        if (count($checkuser)<=0){
            $subscriber = new Subscription();
            $subscriber->name = $request->name;
            $subscriber->email = $request->email;
            $subscriber->save();
        }

        return back()->with('error', 'The email you added already exists!');

    }

}
