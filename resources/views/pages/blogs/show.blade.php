@extends('layouts.main')

@section('content')

    <br><br>
    <main role="main" class="container-fluid" style="margin: 0 auto;">
    @if(count($blogs)==0)
    <?php echo '<h4>No blogs here at this time</h4>' ?>
    @else
        @foreach($blogs as $blog)
            <h3 class='card-header'><strong>   {{ $blog->title }} </strong></h3>

            <div class='float-right mt-2'>
                <a href="{{ route('blog.edit', $blog->id) }}" data-toggle="modal" data-target="#myModal-{{$blog->id}}" class="btn btn-default">
                <i class="fa fa-pencil text-primary"></i> Edit </a>
                
                <a href="{{ route('blog.archive', $blog->id) }}" class="btn btn-default" onclick="return confirm('You are about to archive this blog. Continue?');">
                <i class="fa fa-minus-circle text-danger"></i> Archive</a>
            </div>

            <div class='card-body'>
                <span class="header-sub">By <b> {{ $blog->author }} </b> <br></span>
                <div class='card-text'>
                    <p class='py-2'> {{ $blog->content }} </p>
                </div>
            </div>

            <div class="card-body">
                @if(count($blog->comments)>0)
                    <h5 class="mb-3">Comments
                        <span class="comment-count btn btn-sm btn-outline-info">{{ count($blog->comments) }}</span>
                        <small class="float-right">
                            <span title="Likes" id="saveLikeDislike" data-type="like" data-post="{{ $blog->id}}" class="mr-2 btn btn-sm btn-outline-primary d-inline font-weight-bold">
                                Likes
                                <span class="like-count">{{ $blog->likes() }}</span>
                            </span>
                            <span title="Dislikes" id="saveLikeDislike" data-type="dislike" data-post="{{ $blog->id}}" class="mr-2 btn btn-sm btn-outline-danger d-inline font-weight-bold">
                                Dislikes
                                <span class="dislike-count">{{ $blog->dislikes() }}</span>
                            </span>
                        </small>
                    </h5>
                    @include('pages.blogs.partials.replies', ['comments' => $blog->comments, 'blog_id' => $blog->id])

                @else
                    <h5 class="mb-3">Comments</h5>
                    <?php echo '<p> No comments yet. </p>' ?>
                @endif
                <hr />
            </div>

            <div class="card-body mb-4">
                <h4>Leave a comment</h4>
                <form method="post" action="{{ route('comment.add') }}">
                    @csrf
                    <div class="form-group">
                        <input type="text" placeholder='Comment...' name="comment" class="form-control" />
                        <input type="hidden" name="blog_id" value="{{ $blog->id }}" />
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-sm btn-outline-success py-0" style="font-size: 0.8em;" value="Add Comment" />
                    </div>
                </form>
            </div>

        @include('pages.blogs.edit')
        @endforeach
    @endif
    </main>

    <footer class="navbar fixed-bottom text-dark text-center">
        <div class="container text-center" style="margin-left: 41%;">
            &copy; {{ date('Y')}}. All rights reserved.
        </div>
    </footer>

    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script type='text/javascript'>
        // Save Like Or Dislike
        $(document).on('click','#saveLikeDislike',function() {
            // if(jQuery) alert('jQuery is loaded');
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
