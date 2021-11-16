<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Comment;
use App\Models\CommentLike;
use App\Models\ApproveReject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Redirect;
use DB;


class CommentController extends Controller
{
    public function store(Request $request) 
    {
        if ($request->user()->can('add-comment')) {

            $comment = new Comment;

            $comment->comment = $request->comment;

            $comment->user()->associate($request->user());

            $blog = Blog::find($request->blog_id);

            $blog->comments()->save($comment);   
            
            $id = $request->blog_id;
            $blog = Blog::where('id', $id)->first();

            // return view('pages.blogs.show', compact('blog'))->with('success', 'Comment saved, pending approval');
            return back()->with('success', 'Comment saved, pending approval');
        }
    }


    public function replyStore(Request $request)
    {
        if ($request->user()->can('add-reply')) {

            $reply = new Comment();

            $reply->comment = $request->get('comment');

            $reply->user()->associate($request->user());

            $reply->parent_id = $request->get('comment_id');

            $blog = Blog::find($request->get('blog_id'));

            $blog->comments()->save($reply);

            return back();

        }
    }

    public function approve_comment(Request $request) {
        if ($request->user()->can('approve-comment')) {

            // approve comment
            if($request->type=='approve') {
                $res1 = DB::statement("UPDATE comments SET approval_status='approved' WHERE id=$request->comment");
                $msg = 'Comment approved!';
                return response()->json([
                    'approve'=>true,
                    'approve_msg'=>$msg
                ]);
            }

            else {
                $res2 = DB::statement("UPDATE comments SET approval_status='rejected' WHERE id=$request->comment");
                $msg = 'Comment rejected!';
                return response()->json([
                    'reject'=>true,
                    'approve_msg'=>$msg
                ]);            
            }

            return response()->json([
                'success'=>false
            ]);

        }
    }

    // Save Like Or dislike
    public function like_comment(Request $request) {

        if($request->user()->can('like-comment')) {

            $comment_like = new \App\Models\CommentLike;
            $comment_like->user_id = $request->user()->id;
            $comment_like->blog_id = $request->blog;
            $comment_like->parent_comment_id = $request->parent;
            $comment_like->comment_id = $request->comment;

            // check for already liked blog
            $liked = DB::select("SELECT * from comment_likes where blog_id=$comment_like->blog_id AND
                                parent_comment_id = $comment_like->parent_comment_id AND
                                comment_id = $comment_like->comment_id AND
                                user_id = $comment_like->user_id AND
                                likes = 1 AND
                                dislikes = 0");

            if($liked) {
                DB::delete("DELETE from comment_likes where blog_id=$comment_like->blog_id AND
                                parent_comment_id = $comment_like->parent_comment_id AND
                                comment_id = $comment_like->comment_id AND
                                user_id = $comment_like->user_id AND
                                likes = 1 AND
                            dislikes = 0");
                $comment_like->dislikes = 1;
            }

            else { $comment_like->likes = 1; }

            $comment_like->save();

            return response()->json([
                'liked' => true
            ]);
        }

    }
}