@foreach($comments as $comment)
<style>
    .display-comment .display-comment {
        margin-left: 30px;
    }
    #like-btn:hover {
        cursor: pointer;
    }
</style>
<div class="display-comment">
    <strong>{{ $comment->user->fname }}</strong>
    <p>{{ $comment->comment }}</p>
    <a href="" id="reply"></a>
    <p class="btn btn-sm btn-outline-info" style="font-size: 0.8em;" id="reply-btn">Reply</p>
    <i id="like-btn1" style="font-size: 1.2em; position: relative; bottom: 5px; " class="fa fa-heart-o p-2"></i>
    <i id="like-btn2" style="font-size: 1.2em; position: relative; bottom: 5px; display: none" class="fa fa-heart p-2"></i>
    
    <form method="post" action="{{ route('add-reply') }}">
        @csrf
        <div class="form-group">
            <input type="text" placeholder="Your reply here..." name="comment" class="form-control" id='reply-input' style="display: none;"/>
            <input type="hidden" name="blog_id" value="{{ $blog_id }}" />
            <input type="hidden" name="comment_id" value="{{ $comment->id }}" />
        </div>

        <div class="form-group">
            <input type="submit" class="btn btn-sm btn-outline-info py-0" id="submit-btn" style="display: none; font-size: 0.8em;" value="Submit" />
        </div>
    </form>
    @include('pages.blogs.partials.replies', ['comments' => $comment->replies])
</div>

@endforeach

<script type="text/javascript">
    $(document).ready(function() {
        $("#reply-btn").on("click", function() 
        { 
            $("#reply-input").show();
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
    });
</script>