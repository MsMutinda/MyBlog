@foreach($comments as $comment)
    <style>
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
                <span id="likeReply" data-type="like" data-post="{{ $comment->parent_id}}" class="mr-2 d-inline font-weight-bold">
                    <i style="font-size: 1.2em; position: relative; bottom: 5px; " class="fa fa-heart-o p-2"></i>
                </span>
                <span id="likeReply" data-type="dislike" data-post="{{ $comment->parent_id}}" class="mr-2 d-inline font-weight-bold">
                    <i id="like-btn2" style="font-size: 1.2em; position: relative; bottom: 5px; display: none" class="fa fa-heart p-2"></i>
                </span>
            </small>
        @endauth        
        
        <form method="post" action="{{ route('add-reply') }}">
            @csrf
            <div class="form-group">
                <input type="text" placeholder="Your reply here..." name="comment" class="form-control" id='reply-input' style="display: none;"/>
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
            var _comment=$(this).data('post');
            var _type=$(this).data('type');
            var _user="{{ Auth::user()->id }}";                     
            var vm=$(this);
            // Run Ajax
            $.ajax({
                url:"{{ url('like-comment') }}",
                type:"post",
                dataType:'json',
                data:{
                    comment:_comment,
                    type:_type,
                    user:_user,
                    _token:"{{ csrf_token() }}"
                },
                beforeSend:function(){
                    vm.addClass('disabled');
                },
                success:function(res){
                    if(res.bool==true){
                        vm.removeClass('disabled').addClass('active');
                        vm.removeAttr('id');
                        var _prevCount=$("."+_type+"-count").text();
                        _prevCount++;
                        $("."+_type+"-count").text(_prevCount);
                    }
                }   
            });
        });
    </script>

    <script type="text/javascript">
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
    </script>