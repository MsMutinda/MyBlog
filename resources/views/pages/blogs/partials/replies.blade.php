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
        <i id="like-reply" style="font-size: 1.2em; position: relative; bottom: 5px; " class="fa fa-heart-o p-2"></i>
        <!-- <i id="like-btn2" style="font-size: 1.2em; position: relative; bottom: 5px; display: none" class="fa fa-heart p-2"></i> -->
        
        <!-- @if(Auth::user()->can('approve-comment'))
            <span id="approve-comment" class="approvereject" data-type="approve" data-post="{{ $comment->id }}" style="color: #f57e20;"> 
                <i class="fa fa-check" style="cursor:pointer; font-size: 1em; position: relative; bottom: 6px; left: 3px;"> Approve </i> 
            </span>
    
            <span id="approve-comment" class="approvereject" data-type="reject" data-post="{{ $comment->id }}"> 
                <i class="fa fa-close text-danger" style="cursor: pointer; font-size: 1em; position: relative; bottom: 6px; left: 10px;"> Reject </i> 
            </span>

            @if(Session::has('message'))
                <div class="alert {{ Session::get('alert-class', 'alert-info') }}" role="alert">{{ Session::get('message') }}
                    <button class="close" data-dismiss="alert"></button>
                </div> -->
                <!-- <div class="alert alert-warning" style="display:none">
                    {{ Session::get('message') }}
                </div> -->
           <!-- @endif
        @endif -->
        
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

    <script type="text/javascript">
        $(document).on('click', '#approve-comment', function() {
            var _type = $(this).data('type');
            var _comment = $(this).data('post');
            var _user = "{{ Auth::user()->id }}";
            var elem = $(this);

            $.ajax({
                url:"{{ url('approve-comment') }}",
                type:"post",
                dataType:'json',
                data:{
                    type: _type,
                    comment: _comment,
                    user: _user,
                    _token:"{{ csrf_token() }}"
                },
                success:function(response){
                    if(response.success==true){
                        // $(".alert").css("display", "block");
                        // $(".alert").append("{{ \Session::get('message') }} ");  
                        // hide approve/reject button for approved/rejected comments
                        elem.addClass('disabled');
                        // elem.style['display'] = "none";
                        // var els = document.getElementsByClassName("approvereject");
                        // Array.prototype.forEach.call(els, function(el) {
                        //     el.style['display'] = "none";
                        // });
                    }
                }
            });
        });
            
    </script>

    <script type="text/javascript">
        // dismiss approve/reject alert after 5secs
        setTimeout(function(){
            $("div.alert").remove();
        }, 5000 ); // 5 secs

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