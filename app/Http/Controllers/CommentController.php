<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Comment;
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
            global $res1, $res2;
            // approve comment
            if($request->type=='approve') {
                $res1 = DB::statement("UPDATE comments SET approval_status='approved' WHERE id=$request->comment");
                $approve_msg1 = 'Comment approved!';

            }
            else {
                $res2 = DB::statement("UPDATE comments SET approval_status='rejected' WHERE id=$request->comment");
                $approve_msg2 = 'Comment rejected!';
            }

            // Message to send for approval/rejection
            if($res1){
                return response()->json([
                    'approve'=>true,
                    'approve_msg'=>$approve_msg1
                ]);
            }
            else if($res2){
                return response()->json([
                    'reject'=>true,
                    'approve_msg'=>$approve_msg2
                ]);
            }
            return response()->json([
                'success'=>false
            ]);

        }
    }
}