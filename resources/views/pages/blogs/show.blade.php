@extends('layouts.main')
<style>
    .display-comment .display-comment {
        margin-left: 40px
    }
</style>
@section('content')

    

    <br><br>
    <main role="main" class="container-fluid" style="margin: 0 auto;">
    @if(count($blogs)==0)
    <?php echo '<h4>No blogs here at this time</h4>' ?>
    @else
        @foreach($blogs as $blog)
            <h3 class='card-header'><strong>   {{ $blog->title }} </strong></h3>

            <div class='float-right'>
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
                <h4>Comments</h4>
                @include('pages.blogs.partials.replies', ['comments' => $blog->comments, 'blog_id' => $blog->id])
                <hr />
            </div>

            <div class="card-body mb-4">
                <h6>Leave a comment</h6>
                <form method="post" action="{{ route('comment.add') }}">
                    @csrf
                    <div class="form-group">
                        <input type="text" name="comment" class="form-control" />
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

@endsection