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

    // Save Like Or dislike
    public function like_comment(Request $request) {
        if ($request->user()->can('like-comment')) {

            $data=new \App\Models\LikeDislike;
            $data->user_id=$request->user;
            $data->blog_id=$request->comment;
        
            if($request->type=='like') {
                $likeexists = \DB::select("SELECT * from comment_likes where user_id=$data->user_id AND blog_id=$data->blog_id AND likes=1");
                $userdislike = \DB::select("SELECT * from comment_likes where user_id=$data->user_id AND blog_id=$data->blog_id AND dislikes=1");

                if($likeexists) { 
                    // if same user has liked same blog before, reset the user's likes record for that blog
                    \DB::delete("DELETE from comment_likes where user_id=$data->user_id AND blog_id=$data->blog_id AND likes=1");
                    $data->likes=1;
                }
                
                elseif($userdislike) {
                    // prevent user from liking and disliking same blog
                    \DB::delete("DELETE from comment_likes where user_id=$data->user_id AND blog_id=$data->blog_id AND dislikes=1");
                    $data->likes=1;
                }

                // add like if no like/dislike exists for same user
                else { $data->likes=1; }
            }

            else {
                $dislikeexists = \DB::select("SELECT * from comment_likes where user_id=$data->user_id AND blog_id=$data->blog_id AND dislikes=1");
                $userlike = \DB::select("SELECT * from comment_likes where user_id=$data->user_id AND blog_id=$data->blog_id AND likes=1");

                if($dislikeexists) {
                    \DB::delete("DELETE from comment_likes where user_id=$data->user_id AND blog_id=$data->blog_id AND dislikes=1");
                    $data->dislikes=1;
                }
                
                elseif($userlike) {
                    // prevent user from liking and disliking same blog
                    \DB::delete("DELETE from comment_likes where user_id=$data->user_id AND blog_id=$data->blog_id AND likes=1");
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