<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Category;

class MainController extends Controller
{
    public function filterByCategory($id, $name) {
        // fetch blog categories
        $categories = Category::all();

        // show blogs for a specific category
        $filtered = Blog::where('category', $id)->get();
        $categoryname = Category::where('id', $id)->pluck('name');

        return view('pages.blogs.filtered')->with(['categories'=>$categories, 'filtered'=>$filtered, 'categoryname'=>$categoryname]);
    }
}
