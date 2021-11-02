<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Comment;
use App\Models\ApproveReject;
use Illuminate\Http\Request;


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

            return back();
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
                
                \DB::statement("UPDATE comments SET approval_status='approved' WHERE id=$request->comment");
            
                \Session::flash('message', 'Comment approved successfully!');
            }

            else {
            
                \DB::statement("UPDATE comments SET approval_status='rejected' WHERE id=$request->comment");

                \Session::flash('message', 'Comment rejected successfully. This comment will no longer be visible to other users');
            }

            return response()->json([
                'success'=>true
            ]);
        }
    }
}