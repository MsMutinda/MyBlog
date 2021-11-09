@extends('layouts.main')

@section('content')

    <main role="main" class="main show-blog">
            @if(Session::has('success'))
            <div class="alert alert-info">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p>{{ Session::get('success') }}</p>
            </div>
            @endif

            @foreach($blog as $b)
                
                <h1 class='text-center ml-1' style="color: #F57E20;"><strong> {{ $b->title }} </strong> </h1>
                <img
                    src="{{ asset('storage/'.substr($b->image_path, 7)) }}"
                    class="card-img mt-5"
                    title="{{ $b->title }} image"
                    alt="{{ $b->title }} img"
                    height="450px"
                />

                <div class='card-body'>
                    <div class='card-text'>
                        <p style="text-align: justify; font-size: 15px;"> {{ $b->content }} </p>
                        
                    </div>
                </div>

                <div class="card-body" style="margin-top: 30px;">
                    @if(count($b->comments)>0)
                        <h6 class="mt-5">Comments
                            <span class="comment-count btn btn-sm">
                                @php 
                                    $approvedcomments = \App\Models\Comment::where('commentable_id', $b->id)->where('approval_status', 'approved')->get();                                                 
                                @endphp
                    
                                {{ count($approvedcomments) }}
                                <!-- {{ count($b->comments) }} -->
                            </span>
                            @auth
                                <small class="float-right">
                                    <span id="saveLikeDislike" data-type="like" data-post="{{ $b->id}}" class="mr-2 d-inline font-weight-bold">
                                        <i title="Like" class="fa fa-thumbs-up text-info p-1" style="cursor: pointer; font-size: 2.3em;" id="thumbs-up"></i>
                                        <span class="like-count">{{ $b->likes() }}</span>
                                    </span>
                                    <span title="Dislike" id="saveLikeDislike" data-type="dislike" data-post="{{ $b->id}}" class="ml-2 d-inline font-weight-bold">
                                        <i class="fa fa-thumbs-down text-danger p-1" style="cursor: pointer; font-size: 2.3em; transform: scaleX(-1);" id="thumbs-down"></i>
                                        <span class="dislike-count">{{ $b->dislikes() }}</span>
                                    </span>
                                </small>
                            @endauth
                        </h6>
                        
                        @include('pages.blogs.partials.replies', ['comments' => $approvedcomments, 'blog_id' => $b->id])
                        
                    @else
                        <h5 class="mb-3 mt-5">Comments 
                            @auth
                                <small class="float-right">
                                    <span id="saveLikeDislike" data-type="like" data-post="{{ $b->id}}" class="mr-2 d-inline font-weight-bold">
                                        <i title="Like" class="fa fa-thumbs-up text-info p-1" style="cursor: pointer; font-size: 2.3em;" id="thumbs-up"></i>
                                        <span class="like-count">{{ $b->likes() }}</span>
                                    </span>
                                    <span title="Dislike" id="saveLikeDislike" data-type="dislike" data-post="{{ $b->id}}" class="ml-2 d-inline font-weight-bold">
                                        <i class="fa fa-thumbs-down text-danger p-1" style="cursor: pointer; font-size: 2.3em; transform: scaleX(-1);" id="thumbs-down"></i>
                                        <span class="dislike-count">{{ $b->dislikes() }}</span>
                                    </span>
                                </small>
                            @endauth
                        </h5>
                        @php echo '<p> No comments yet. </p>' @endphp

                    @endif
                    <hr style="width: 100%; position: relative; left: 2px;">
                </div>
                
                <div class="card-body mb-4 mt-3">
                    <h5 class="mt-3">Leave a comment </h5>
                    <form method="post" action="{{ route('add-comment') }}">
                        @csrf
                        <div class="form-group">
                            <input type="text" placeholder='Comment...' name="comment" class="form-control mt-3" />
                        </div>
                        <div class="form-group">
                            <input type="submit" id="comment-submit" class="btn btn-sm btn-outline-success py-1" style="font-size: 0.9em; color: #fff;" value="Add Comment" />
                        </div>
                    </form>
                </div>
        @endforeach


        @php 
            $relatedblogs = \App\Models\Blog::where('category', $b->category)->where('id', '!=', $b->id)->get();
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
                                <p> {{ $r->content }} </p>
                            </div>
                        </div>

                        <p class="readMore"> <b><a style="color: #f27a1f" href="{{ route('view-blog', $r->id) }}"  data-toggle="modal" data-target="#newsletterModal"> Read more </b> <i class="fa fa-arrow-right"></i> </a> </p>
                    </div>
                    
                    @endforeach
                @else
                    @php echo "<h5 class='ml-3 mt-3' style='color: #f57e20;'>"."No related blogs yet."."</h5>" @endphp
                @endif
            </div>

        </div>

        <!-- Modal -->
        <div class="modal fade" id="newsletterModal" tabindex="-1" role="dialog" aria-labelledby="newsletterModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newsletterModalLabel"> Newsletter form </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('save-subscriber') }}" method="post" id="newsletter-form">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" placeholder="Your name here..." required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" name="email" class="form-control" aria-describedby="emailHelp" placeholder="Enter your email address" required>
                        </div>
                        <small id="emailHelp" class="form-text text-muted">We promise to only send you the best.</small>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success" name="submit" form="newsletter-form">Save changes</button>
                </div>
                </div>
            </div>
        </div>
        <!-- End of modal -->
            
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


@endsection
