@foreach($comments as $comment)
    <style type="text/css">
        .display-comment .display-comment {
            margin-left: 30px;
            font-size: 13px;
        }
        #like-btn:hover {
            cursor: pointer;
        }
    </style>


    <div class="display-comment">
        <strong>{{ $comment->user->fname }}</strong>
        <p>{{ $comment->comment }}</p>
        <a href="" id="reply"></a>
        <p class="btn btn-sm" style="font-size: 0.8em; color: #fff;" id="reply-btn">Reply</p>
        @auth
            <small>
                <span id="likeReply" data-type="commentLike" data-post="{{ $comment->parent_id}}" data-id="{{ $comment->id }}" data-blog="{{ $blog_id }}" class="mr-2 d-inline font-weight-bold">
                    <i style="font-size: 1.5em; position: relative; bottom: 5px;" class="fa fa-heart-o pl-3" id="like"></i>
                    <span class="like-count">
                        {{ $comment->likes() }}
                    </span>
                </span>
            </small>
        @endauth        
        
        <form method="post" action="{{ route('add-reply') }}">
            @csrf
            <div class="form-group">
                <input type="text" placeholder="Your reply here..." name="comment" class="form-control" id='reply-input' hidden />
                <input type="hidden" name="blog_id" value="{{ $blog_id }}" />
                <input type="hidden" name="comment_id" value="{{ $comment->id }}" />
            </div>

            <div class="form-group">
                <input type="submit" class="btn btn-sm py-0 text-white" id="submit-btn" style="display: none; font-size: 0.8em;" value="Submit" />
            </div>
        </form>

        @include('pages.blogs.partials.replies', ['comments' => $comment->replies])
    </div>

@endforeach

<script type='text/javascript'>
        // Save Like Or Dislike
    $(document).on('click','#likeReply',function() {
        var _blog=$(this).data('blog');
        var _comment=$(this).data('post');
        var _reply=$(this).data('id');
        var _type=$(this).data('type');
        var _user="{{ Auth::user()->id }}";                     

        // Run Ajax
        $.ajax({
            url:"{{ url('like-comment') }}",
            type:"post",
            dataType:'json',
            data:{
                blog:_blog,
                comment:_comment,
                reply:_reply,
                type:_type,
                user:_user,
                _token:"{{ csrf_token() }}"
            },
        });
    });
    </script>

    <script type="text/javascript">
        $("#reply-btn").on("click", function() 
        { 
            $('#reply-input').prop("hidden", false);
            $("#submit-btn").show();
            $("#reply-btn").hide();
        });

        //  like a reply/comment
        $("#like-btn1").on("click", function() 
        { 
            // $(this).css("background", "red");
            $("#like-btn1").hide();
            $("#like-btn2").show();
        });
    </script>