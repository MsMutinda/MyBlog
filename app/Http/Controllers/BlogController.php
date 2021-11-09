<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Auth;
use App\Models\Blog;
use App\Models\User;
use App\Models\Category;
use App\Models\Comment;
use RealRashid\SweetAlert\Facades\Alert;


class BlogController extends Controller
{
    public function index() {
        // fetch all blogs
        $all = Blog::all();
        // blog categories
        $categories = Category::all();
        return view('pages.blogs.all')->with(['all'=>$all, 'categories'=>$categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->user()->can('store-blog')) {

            $request->validate([
                'image' => 'mimes:jpeg,jpg,png|dimensions:width=400,height=267' // Only allow .jpg, .bmp and .png file types, and with specified dimensions.
            ]);

            // Save the file locally in the storage/public/ folder under a new folder named /blog_images
            $uploaded_file = $request->file;
            $uploaded_file_ex = $uploaded_file->getClientOriginalExtension();
            $filename = time().'.'.$uploaded_file_ex;
            $path = $request->file->storeAs('public', $filename);

            // Store the record, using the new file hashname which will be it's new filename identity.
            $save_blog = new Blog();

            $save_blog->user_id = session()->getId();
            
            $save_blog->category = $request->category;
            $save_blog->image_path = $path;
            $save_blog->title = $request->title;
            $save_blog->author = Auth::user()->fname.' '.Auth::user()->lname;
            $save_blog->content = $request->content;

            $save_blog->save();
            return redirect()->back()->with('success', 'Blog saved successfully');
            
        }
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
        $categories = Category::all();
        return view('pages.blogs.show')->with(['blogs'=>$blogs, 'categories'=>$categories]);
    }

    // View blog comments
    public function showComments(Request $request, $id) 
    {
        if ($request->user()->can('view-blogComments')) 
        {
            $blog = Blog::where('id', $id)->get();
            $comments = Comment::where('commentable_id', $id)->get();
            return view('pages.blogs.comments')->with(['blog'=>$blog, 'comments'=>$comments]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        if ($request->user()->can('edit-blog')) {
            return view('pages.blogs.edit');
        }
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
        if ($request->user()->can('update-blog')) {

            $request->validate([
                'image' => 'mimes:jpeg,jpg,png' // Only allow .jpg, .bmp and .png file types.
            ]);
            $uploaded_file = $request->file;
            $uploaded_file_ex = $uploaded_file->getClientOriginalExtension();
            $filename = time().'.'.$uploaded_file_ex;
            $path = $request->file->storeAs('public', $filename);

            $validator = Validator::make($request->all(), [
                'title'  => 'required|string|max:255',
                'category' => 'required|string|max:255',
                'content' => 'required|string|max:255',
            ]);

        Blog::whereId($id)->update([
                'title'    => $request->title,
                'category'   => $request->category,
                'content'  => $request->content,
                'image_path'   => $path
            ]);

            return redirect()->back();
        }
    }
        
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        // if ($request->user()->can('archive-blog')) 
        
        if($request->user()->hasRole('manager'))
        {
            $blog = Blog::whereId($id)->delete();
            return redirect()->route('home')->with('success', 'Blog deleted successfully!');
        }
    }

    //show archived blogs
    public function showArchived(Request $request) 
    {
        if ($request->user()->can('view-archivedBlogs')) 
        {
            $archived = Blog::onlyTrashed()->get();
            $numArchived = $archived->count();
            return view('pages.blogs.archived')->with(['archived' => $archived, 'numArchived' => $numArchived]);
        }
    }


    /**
     * Restore the deleted resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore(Request $request, $id)
    {
        if ($request->user()->can('restore-archivedBlogs')) 
        {
            $archive = Blog::onlyTrashed()->find($id)->restore();
            return redirect()->back();
        }
    }


    // Save Like Or dislike
    public function save_likedislike(Request $request) {
        if ($request->user()->can('like-blog')) {

            $data=new \App\Models\LikeDislike;
            $data->user_id=$request->user()->id;
            $data->blog_id=$request->post;
        
            if($request->type=='like') {
                $likeexists = \DB::select("SELECT * from like_dislikes where user_id=$data->user_id AND blog_id=$data->blog_id AND likes=1");
                $userdislike = \DB::select("SELECT * from like_dislikes where user_id=$data->user_id AND blog_id=$data->blog_id AND dislikes=1");

                if($likeexists) { 
                    // if same user has liked same blog before, reset the user's likes record for that blog
                    \DB::delete("DELETE from like_dislikes where user_id=$data->user_id AND blog_id=$data->blog_id AND likes=1");
                    $data->likes=1;
                }
                
                elseif($userdislike) {
                    // prevent user from liking and disliking same blog
                    \DB::delete("DELETE from like_dislikes where user_id=$data->user_id AND blog_id=$data->blog_id AND dislikes=1");
                    $data->likes=1;
                }

                // add like if no like/dislike exists for same user
                else { $data->likes=1; }
            }

            else {
                $dislikeexists = \DB::select("SELECT * from like_dislikes where user_id=$data->user_id AND blog_id=$data->blog_id AND dislikes=1");
                $userlike = \DB::select("SELECT * from like_dislikes where user_id=$data->user_id AND blog_id=$data->blog_id AND likes=1");

                if($dislikeexists) {
                    \DB::delete("DELETE from like_dislikes where user_id=$data->user_id AND blog_id=$data->blog_id AND dislikes=1");
                    $data->dislikes=1;
                }
                
                elseif($userlike) {
                    // prevent user from liking and disliking same blog
                    \DB::delete("DELETE from like_dislikes where user_id=$data->user_id AND blog_id=$data->blog_id AND likes=1");
                    $data->dislikes=1;
                }

                else{ $data->dislikes=1; }
            }

            $data->save();

            return response()->json([
                'bool'=>true
            ]);

        }
    }
    
}
