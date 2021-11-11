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

            return view('pages.blogs.show', compact('blog'))->with('success', 'Comment saved, pending approval');
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
        if ($request->user()->can('like-comment')) {

            $comment_like = new CommentLike;
        
            $comment_like->user_id = $request->user;
            $comment_like->blog_id = $request->blog;
            $comment_like->parent_comment_id = $request->comment;
            $comment_like->reply_id = $request->reply;

            if($request->type=='commentLike') {
                // check for already liked blog
                $liked = CommentLike::where('user_id', $request->user)
                                    ->where('blog_id', $request->blog)
                                    ->where('parent_comment_id', $request->comment)
                                    ->where('reply_id', $request->reply)
                                    ->where('likes', 1)
                                    ->where('dislikes', 0)
                                    ->get();
                if($liked){
                    DB::statement("UPDATE comment_likes SET likes=0, dislikes=1 where user_id=$request->user AND blog_id=$request->blog AND parent_comment_id=$request->comment AND reply_id=$request->reply AND likes=1 AND dislikes=0"); 
                }
                // dd('record doesn\'t exist');
                DB::statement("INSERT INTO comment_likes (user_id,blog_id,parent_comment_id, reply_id, likes, dislikes) VALUES ($request->user,$request->blog,$request->comment,$request->reply,1,0)");
                // $comment_like->likes=1;
                // $comment_like->dislikes=0;
            }
            // $comment_like->save();
            return back();

        }
    }
}