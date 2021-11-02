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

            // $comment->approved = $request->approved;

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
            
            // dd($request);
            // approve comment
            $approval = new ApproveReject();
            $approval->user_id = $request->user;
            $approval->comment_id = $request->comment;

            if($request->type=='approve') {
                // check if comment already approved
                $approved = \DB::select("SELECT * from approve_rejects where user_id=$approval->user_id AND comment_id=$approval->comment_id AND approved=1");
                $commentrejected = \DB::select("SELECT * from approve_rejects where user_id=$approval->user_id AND comment_id=$approval->comment_id AND rejected=1");

                if($approved) {
                    \DB::delete("DELETE from approve_rejects where user_id=$approval->user_id AND comment_id=$approval->comment_id AND approved=1");
                    $approval->approved=1;
                }
                elseif($commentrejected) {
                    // if comment had already been previously rejected
                    \DB::delete("DELETE from approve_rejects where user_id=$approval->user_id AND comment_id=$approval->comment_id AND rejected=1");
                    $approval->approved=1;
                }
                else {
                    $approval->approved = 1;
                }
            
                \Session::flash('message', 'Approved successfully!');
            }

            else {
                // if comment already rejected
                $rejected = \DB::select("SELECT * from approve_rejects where user_id=$approval->user_id AND comment_id=$approval->comment_id AND rejected=1");
                $commentapproved = \DB::select("SELECT * from approve_rejects where user_id=$approval->user_id AND comment_id=$approval->comment_id AND approved=1");

                if($rejected) {
                    // alert: comment already rejected
                    \DB::delete("DELETE from approve_rejects where user_id=$approval->user_id AND comment_id=$approval->comment_id AND rejected=1");
                    $approval->rejected=1;
                }
                elseif($commentapproved) {
                    // if comment had already been previously rejected
                    \DB::delete("DELETE from approve_rejects where user_id=$approval->user_id AND comment_id=$approval->comment_id AND approved=1");
                    $approval->rejected=1;
                }
                else {
                    $approval->rejected = 1;
                }

                \Session::flash('message', 'Comment rejected successfully');
            }

            $approval->save();

            return response()->json([
                'success'=>true
            ]);
        }
    }
}