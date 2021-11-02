@extends('layouts.main')

@section('content')

    <main role="main" class="main show-blog">
        @if(count($blogs)==0)
            <?php echo "<h4 class='ml-4 mt-4' style='color: red; font-family: cursive;'>"."No blogs here yet."."</h4>" ?>
        @else
            @foreach($blogs as $blog)
                <h1 class='text-center ml-1' style="color: #F57E20;"><strong>   {{ $blog->title }} </strong> </h1>

                <img
                    src="{{ asset('storage/'.substr($blog->image_path, 7)) }}"
                    class="card-img mt-5"
                    title="{{ $blog->title }} image"
                    alt="{{ $blog->title }} img"
                    height="450px"
                />

                <div class='card-body'>
                    <div class='card-text'>
                        <p style="text-align: justify; font-size: 15px;"> {{ $blog->content }} </p>
                        
                    </div>
                </div>

                <small class="float-left mt-2"> <span><img src="" alt=""> By {{ $blog->author }} </span>
                </small>
                <small> <span class="float-right"> {{ $blog->created_at->format('d M, Y') }} </span> </small>

                <div class="card-body" style="margin-top: 30px;">
                    @if(count($blog->comments)>0)
                        <h6 class="mt-5">Comments
                            <span class="comment-count btn btn-sm">
                                <?php 
                                    $approvedcomments = \App\Models\Comment::where('commentable_id', $blog->id)
                                                                            ->where(function($query) {
                                                                                $query->where('approval_status', 'approved')
                                                                                    ->orWhere('approval_status', 'pending');
                                                                            })->get();
                                        
                                ?>
                                {{ count($approvedcomments) }}
                                <!-- {{ count($blog->comments) }} -->
                            </span>
                            @auth
                                <small class="float-right">
                                    <span id="saveLikeDislike" data-type="like" data-post="{{ $blog->id}}" class="mr-2 d-inline font-weight-bold">
                                        <i title="Like" class="fa fa-thumbs-up text-info p-1" style="cursor: pointer; font-size: 2.3em;" id="thumbs-up"></i>
                                        <span class="like-count">{{ $blog->likes() }}</span>
                                    </span>
                                    <span title="Dislike" id="saveLikeDislike" data-type="dislike" data-post="{{ $blog->id}}" class="ml-2 d-inline font-weight-bold">
                                        <i class="fa fa-thumbs-down text-danger p-1" style="cursor: pointer; font-size: 2.3em; transform: scaleX(-1);" id="thumbs-down"></i>
                                        <span class="dislike-count">{{ $blog->dislikes() }}</span>
                                    </span>
                                </small>
                            @endauth
                        </h6>
                        
                        @include('pages.blogs.partials.replies', ['comments' => $approvedcomments, 'blog_id' => $blog->id])
                        
                    @else
                        <h5 class="mb-3 mt-5">Comments </h5>
                        <?php echo '<p> No comments yet. </p>' ?>
                    @endif
                    <hr style="width: 100%; position: relative; left: 2px;">
                </div>

                <div class="card-body mb-4 mt-3">
                    <h5 class="mt-3">Leave a comment </h5>
                    <form method="post" action="{{ route('add-comment') }}">
                        @csrf
                        <div class="form-group">
                            <input type="text" placeholder='Comment...' name="comment" class="form-control mt-3" />
                            <input type="hidden" name="blog_id" value="{{ $blog->id }}" />
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-sm btn-outline-success py-1" style="font-size: 0.9em; color: #fff;" value="Add Comment" />
                        </div>
                    </form>
                </div>

        @endforeach
        @endif


        <?php 
            $relatedblogs = \App\Models\Blog::where('category', $blog->category)->where('id', '!=', $blog->id)->get();
        ?>

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
                                <?php 
                                    $blogCategory = \App\Models\Category::where('id' , '=', $r->category)->pluck('name');
                                    echo substr($blogCategory, 2, -2);
                                ?> 
                            </p>
                            <h5 class="card-title"><strong> {{ $r->title }} </strong></h5>
                            <div class='card-text mt-2'>
                                <p> {{ substr($r->content, 0, 330).'...' }} </p>
                            </div>

                            <small>
                                <span class="float-left">
                                    <img src="" alt=""> By {{ $r->author }}
                                </span>
                            </small>
                            <small>
                                <span class="float-right"> {{ $r->created_at->format('d M, Y') }} </p>
                                </span>
                            </small>
                        </div>

                        <p class="readMore"> <b><a style="color: #f27a1f" href="{{ route('view-blog', $r->id) }}"> Read more </b></a> <i class="fa fa-arrow-right"></i> </p>

                    </div>
                    
                    @endforeach
                @else
                    <?php echo "<h5 class='ml-3 mt-3' style='color: #f57e20;'>"."No related blogs yet."."</h5>" ?>
                @endif
            </div>

        </div>
            
    </main>

    <script type='text/javascript'>
        // Save Like Or Dislike
        $(document).on('click','#saveLikeDislike',function() {
            var _post=$(this).data('post');
            var _type=$(this).data('type');
            var _user="{{ Auth::user()->id }}";                     
            var vm=$(this);
            // Run Ajax
            $.ajax({
                url:"{{ url('save-likedislike') }}",
                type:"post",
                dataType:'json',
                data:{
                    post:_post,
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

@endsection
