@extends('layouts.main')

@section('content')

    <main role="main" class="show-blog">
        @if(Session::has('success'))
        <div class="alert alert-info">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <p>{{ Session::get('success') }}</p>
        </div>
        @endif

        <div class="row">
            <div class="col-lg-10 col-sm-10">
                <h1 class='text-center' ><strong> {{ $blog->title }} </strong> </h1>
                <hr>
                <div class="card-body">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSSRsfOcYt3SR9V9alSN7mg-z2Q_STmrA94q4YJ44JsT62ykMKgahBOIi-7--RiFrY-0N0&usqp=CAU" alt="" align="left" width="90px" height="90px">
                    <p> By <strong> {{ $blog->author }} </strong> </p>
                    <p> Published on {{ $blog->created_at->format('M d, Y') }} </p>
                </div>
                <hr>

                <div class='card-body'>
                    <div class='card-text'>
                        <p style="text-align: justify; font-size: 15px;"> {!! $blog->content !!} </p>
                    </div>
                </div>

                <div class="card-body" style="margin-top: 30px;">
                    @if(count($blog->comments)>0)
                        <h6 class="mt-5" id="comments">Comments
                            <span class="comment-count btn btn-sm">
                                @php
                                    $approvedcomments = \App\Models\Comment::where('commentable_id', $blog->id)->where('approval_status', 'approved')->get();                                                 
                                @endphp
                    
                                {{ count($approvedcomments) }}
                                <!-- {{ count($blog->comments) }} -->
                            </span>
                        </h6>
                        
                        @include('pages.blogs.partials.replies', ['comments' => $approvedcomments, 'blog_id' => $blog->id])
                        
                    @else
                        <h5 class="mb-3 mt-5" id="comments">Comments </h5>
                        @php echo '<p> No comments yet. </p>' @endphp

                    @endif
                </div>
                
                <div id="comment-section"></div>

                <div class="card-body comment mb-4 mt-3" hidden>
                    <h5 style="margin-top: 50px;">Leave a comment </h5>
                    <form method="post" action="{{ route('add-comment') }}">
                        @csrf
                        <div class="form-group">
                            <input type="text" placeholder='Comment...' name="comment" class="form-control mt-3" />
                            <input type="hidden" name="blog_id" value="{{ $blog->id }}" />
                        </div>
                        <div class="form-group">
                            <input type="submit" id="comment-submit" class="btn btn-sm btn-outline-success py-1" style="font-size: 0.9em; color: #fff;" value="Add Comment" />
                        </div>
                    </form>
                </div>

            </div>

            <div class="col-lg-2 col-sm-2">
                @auth
                    <ul>
                        <li title="Like blog" id="saveLikeDislike" data-type="like" data-post="{{ $blog->id}}" class="d-inline font-weight-bold">
                            <i class="fa fa-thumbs-up text-info p-1" style="cursor: pointer; font-size: 2.3em;" id="thumbs-up"></i>
                            <span class="like-count">{{ $blog->likes() }}</span>
                        </li>
                        <li title="Dislike blog" id="saveLikeDislike" data-type="dislike" data-post="{{ $blog->id}}" class="d-inline font-weight-bold">
                            <i class="fa fa-thumbs-down text-danger p-1" style="cursor: pointer; font-size: 2.3em; transform: scaleX(-1);" id="thumbs-down"></i>
                            <span class="dislike-count">{{ $blog->dislikes() }}</span>
                        </li>
                        <li title="Add comment" id="comment-icon" class="d-inline font-weight-bold">
                            <a href="#comments"><i class="fa fa-comments text-secondary p-1" style="cursor: pointer; font-size: 2.3em;"></i></a>
                        </li>
                        <li title="Bookmark blog" class="d-inline font-weight-bold">
                            <i class="fa fa-bookmark text-dark p-1 ml-1" style="cursor: pointer; font-size: 2.3em;"></i>
                        </li>
                    </ul>
                @endauth
            </div>

        </div>


        @php 
            $relatedblogs = \App\Models\Blog::where('category', $blog->category)->where('id', '!=', $blog->id)->get();
        @endphp

        <div class="related-blogs">
            <div class="row"> 
                <div class="col-lg-12 col-sm-12"> 
                    <h2 style="font-weight: bolder;"> Related blogs </h2>
                </div>
            </div>

            <div class="row">
                @if(count($relatedblogs) > 0)
                    @foreach($relatedblogs as $r)
                    <div class='card col-lg-5 col-sm-5'>
                        <img
                            src="{{ asset('storage/'.substr($r->image_path, 7)) }}"
                            class="card-img-top"
                            title="{{ $r->title }} image"
                            alt="{{ $r->title }} img"
                        />
                        <div class="card-body">
                            <p class="btn btn2 px-4">
                                @php 
                                    $blogCategory = \App\Models\Category::where('id' , '=', $r->category)->pluck('name');
                                    echo substr($blogCategory, 2, -2);
                                @endphp
                            </p>
                            <h5 class="card-title"><strong> {{ $r->title }} </strong></h5>
                            <div class='card-text mt-2'>
                                <p> {{ substr(strip_tags($r->content), 0, 190).'...' }} </p>
                            </div>
                        </div>

                        <p class="readMore"> <b><a style="color: #f27a1f;" href="{{ route('view-blog', $r->id) }}"  data-toggle="modal" data-target="#newsletterModal"> Read more </b> <i class="fa fa-arrow-right"></i> </a> </p>
                    </div>
                    
                    @endforeach
                @else
                    @php echo "<h5 class='mt-3' style='color: #8a8a8a;'>"."No related blogs yet."."</h5>" @endphp
                @endif
            </div>

        </div>
            
    </main>

    <script type='text/javascript'>
        // Save Like Or Dislike
        $(document).on('click','#saveLikeDislike',function() {
            var _post=$(this).data('post');
            var _type=$(this).data('type');
            var vm=$(this);
            // Run Ajax
            $.ajax({
                url:"{{ url('save-likedislike') }}",
                type:"post",
                dataType:'json',
                data:{
                    post:_post,
                    type:_type,
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
        $("#comment-icon").on("click", function() 
        { 
            $('.comment').prop("hidden",false);
            $('.comment').appendTo('#comment-section');
        });
    </script>


@endsection
