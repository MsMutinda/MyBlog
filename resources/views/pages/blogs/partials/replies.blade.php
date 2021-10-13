@foreach($comments as $comment)
<div class="display-comment">
    <strong>{{ $comment->user->fname }}</strong>
    <p>{{ $comment->comment }}</p>
    <a href="" id="reply"></a>
    <p class="btn btn-sm btn-outline-info" style="font-size: 0.8em;" id="reply-btn">Reply</p>
    <p class="btn btn-sm btn-outline-warning" style="font-size: 0.8em;" id="reply-show">Show replies</p>
    
    <form method="post" action="{{ route('reply.add') }}">
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
</div>

@endforeach
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
            integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
            crossorigin="anonymous"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $("#reply-btn").on("click", function() 
        { 
            $("#reply-input").show();
            $("#submit-btn").show();
            $("#reply-btn").hide();
        });

        //show replies when show replies button is clicked
        // $("#reply-show").on("click", function() 
        // { 
        //    let $replies = \DB::('Select * from comments where parent_id=blog_id')
        //    alert(replies);
        // });
    });
</script>