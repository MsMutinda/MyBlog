@extends('layouts.main')

@section('content')

    <main role="main" class="main">
        @if(count($blogs)==0)
    <?php echo "<h4 class='ml-4 mt-4' style='color: red; font-family: cursive;'>"."No blogs here yet."."</h4>" ?>
    @else
        @foreach($blogs as $blog)
            <h3 class='ml-1'><strong>   {{ $blog->title }} </strong>
                <div class='float-right mt-2'>
                    <a href="{{ route('edit-blog', $blog->id) }}" data-toggle="modal" data-target="#myModal-{{$blog->id}}" class="btn btn-default text-white" style="font-weight: 700;">
                    <!-- <i class="fa fa-pencil text-primary"></i>  -->
                    Edit post </a>
                    
                    <a href="{{ route('archive-blog', $blog->id) }}" class="btn btn-default text-white" style="font-weight: 700;" onclick="return confirm('You are about to archive this blog. Continue?');">
                    <!-- <i class="fa fa-minus-circle text-danger"></i>  -->
                    Archive post</a>
                </div>
            </h3>

            <div class='card-body'>
                <!-- <span class="header-sub"> -->
                    <!-- <img src="{{ url('storage/'.substr($blog->image_path, 7)) }}" alt="{{ $blog->title }} img" style="float: left; padding: 10px;" width="300px">   -->
                <!-- </span> -->
                <div class='card-text'>
                    <p style="text-align: justify;"> {{ $blog->content }} </p>
                    <small class="float-right">
                        <span id="saveLikeDislike" data-type="like" data-post="{{ $blog->id}}" class="mr-2 d-inline font-weight-bold">
                            <i title="Like" class="fa fa-thumbs-up text-info p-1" style="cursor: pointer; font-size: 2.4em;" id="thumbs-up"></i>
                            <span class="like-count">{{ $blog->likes() }}</span>
                        </span>
                        <span title="Dislike" id="saveLikeDislike" data-type="dislike" data-post="{{ $blog->id}}" class="ml-2 d-inline font-weight-bold">
                            <i class="fa fa-thumbs-down text-danger p-1" style="cursor: pointer; font-size: 2.4em; transform: scaleX(-1);" id="thumbs-down"></i>
                            <span class="dislike-count">{{ $blog->dislikes() }}</span>
                        </span>
                    </small>
                </div>
            </div>

            <div class="card-body" style="margin-top: 30px;">
                @if(count($blog->comments)>0)
                    <h5>Comments
                        <span class="comment-count btn btn-sm btn-outline-info">{{ count($blog->comments) }}</span>
                    </h5>
                    <!-- <div class="float-right">
                        <a href="" class="btn btn-default">
                        <i class="fa check text-success"></i> Approve comment </a>
                    </div> -->
                    @include('pages.blogs.partials.replies', ['comments' => $blog->comments, 'blog_id' => $blog->id])
                    
                @else
                    <h5 class="mb-3">Comments </h5>
                    <?php echo '<p> No comments yet. </p>' ?>
                @endif
                <hr />
            </div>

            <div class="card-body mb-4">
                <h4>Leave a comment
                    
                </h4>
                <form method="post" action="{{ route('add-comment') }}">
                    @csrf
                    <div class="form-group">
                        <input type="text" placeholder='Comment...' name="comment" class="form-control mt-3" />
                        <input type="hidden" name="blog_id" value="{{ $blog->id }}" />
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-sm btn-outline-success py-0" style="font-size: 0.9em; color: #fff;" value="Add Comment" />
                    </div>
                </form>
            </div>

        @include('pages.blogs.edit')
        @endforeach
    @endif
    </main>

    <script type='text/javascript'>
        // Save Like Or Dislike
        $(document).on('click','#saveLikeDislike',function() {
            // ('#saveLikeDislike').style='color: green';
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
