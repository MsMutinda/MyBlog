@foreach($comments as $comment)
    <style type="text/css">
        .display-comment .display-comment {
            margin-left: 30px;
            font-size: 13px;
        }
    </style>


    <div class="display-comment">
        <strong>{{ $comment->user->fname }}</strong>
        <p>{{ $comment->comment }}</p>
        <a href="" id="reply"></a>
        <p class="btn btn-sm" style="font-size: 0.8em; color: #fff;" id="reply-btn">Reply</p>
        @auth
            <small>
                <span class="mr-2 d-inline font-weight-bold">
                    <i data-parent="{{ $comment->parent_id}}" data-comment="{{ $comment->id }}" data-blog="{{ $blog_id }}" 
                    style="font-size: 1.5em; position: relative; bottom: 5px; padding-left: 20px; cursor: pointer;" 
                    class="fa fa-heart-o" id="like" onclick="saveCommentLike()"></i>
                    <span class="comment-likes"> {{ $comment->likes() }} </span>
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

<script type="text/javascript">
    // Save comment/reply Like Or Dislike
    function saveCommentLike() 
    {
        var _blog = document.getElementById('like').getAttribute('data-blog');
        var _parent = document.getElementById('like').getAttribute('data-parent');
        var _comment = document.getElementById('like').getAttribute('data-comment');
        // Run Ajax
        $.ajax({
            url: "{{ url('like-comment') }}",
            type: "post",
            dataType: 'json',
            data: {
                blog: _blog,
                parent: _parent,
                comment: _comment,
                _token:"{{ csrf_token() }}"
            },
            success:function(response){
                    if(response.liked == true){
                        var _prevCount = parseInt($(".comment-likes").text());
                        _prevCount++;
                        parseInt($(".comment-likes").text(_prevCount));
                    }
                }
        });
    }   
    </script>

    <script type="text/javascript">
        $("#reply-btn").on("click", function() 
        { 
            $('#reply-input').prop("hidden", false);
            $("#submit-btn").show();
            $("#reply-btn").hide();
        });
    </script>