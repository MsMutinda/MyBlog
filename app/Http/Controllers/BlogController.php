<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Blog;
use App\Models\User;
use App\Models\LikeDisLike;


class BlogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() 
    {
        return view('pages.blogs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateddata = $this->validate($request, [
            'title' => ['required'],
            'author' => ['required'],
            'content' => ['required'],
            'slug' => \Str::slug($request->title)
        ]);

        Blog::create($validateddata); //storing the data
        return redirect()->back()->with('success', 'Blog saved successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $blogs = Blog::where('id', $id)->get();
        return view('pages.blogs.show')->with('blogs', $blogs);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('pages.blogs.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title'  => 'required|string|max:255',
            'author'  => 'required|string|max:255',
            'content' => 'required|string|max:255'
        ]);

       Blog::whereId($id)->update([
            'title'          => $request->title,
            'author'   => $request->author,
            'content'      => $request->content
        ]);

        return redirect()->back();
    }
        
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blog = Blog::whereId($id)->delete();
        return redirect()->route('home')->with('success', 'Blog deleted successfully!');
    }

    //show archived blogs
    public function showArchived() 
    {
        $archived = Blog::onlyTrashed()->get();
        $numArchived = $archived->count();
        return view('pages.blogs.archived')->with(['archived' => $archived, 'numArchived' => $numArchived]);
    }


    /**
     * Restore the deleted resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $archive = Blog::onlyTrashed()->find($id)->restore();
        return redirect()->back();
    }

    // Save Like Or dislike
    public function save_likedislike(Request $request){
        $data=new \App\Models\LikeDislike;
        $data->blog_id=$request->post;
        if($request->type=='like'){
            $data->like=1;
        }else{
            $data->dislike=1;
        }
        $data->save();
        return response()->json([
            'bool'=>true
        ]);
    }
}
