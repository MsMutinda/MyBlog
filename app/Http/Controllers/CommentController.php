<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Comment;
use Illuminate\Http\Request;


class CommentController extends Controller
{
    public function store(Request $request)
    {
        
        $comment = new Comment;

        $comment->comment = $request->comment;

        $comment->user()->associate($request->user());

        $blog = Blog::find($request->blog_id);

        $blog->comments()->save($comment);

        return back();
    }

    public function replyStore(Request $request)
    {
        $reply = new Comment();

        $reply->comment = $request->get('comment');

        $reply->user()->associate($request->user());

        $reply->parent_id = $request->get('comment_id');

        $blog = Blog::find($request->get('blog_id'));

        $blog->comments()->save($reply);

        return back();

    }
}
