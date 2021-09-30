@extends('layouts.main')

@section('content')

    

    <br><br>
    <main role="main" class="container-fluid" style="margin: 0 auto;">
        @foreach($blogs as $blog)
            <h3 class='card-header'><strong>   {{ $blog->title }} </strong></h3>
            <div class='card-body'>
                <span class="header-sub">Written by <b> {{ $blog->author }} </b> 
                <!-- on <b> {{ substr($blog->created_at, 0, 10) }}</b> -->
            </span>
                <div class='card-text'>
                    <p class='py-2'> {{ $blog->content }} </p>
                </div>
            </div>
        @include('pages.blogs.edit')
        @endforeach
    </main>

    <div class='mt-5'>
        <a href="{{ route('blog.edit', $blog->id) }}" data-toggle="modal" data-target="#myModal-{{$blog->id}}" class="btn btn-default shadow-lg">
        <i class="fa fa-pencil text-primary"></i> Edit </a>
        
        <a href="{{ route('blog.archive', $blog->id) }}" class="btn btn-default shadow-lg" onclick="return confirm('You are about to archive this survey. Continue?');">
        <i class="fa fa-minus-circle text-danger"></i> Archive</a>
    </div>

    <footer class="navbar fixed-bottom text-dark text-center">
        <div class="container text-center" style="margin-left: 41%;">
            &copy; {{ date('Y')}}. All rights reserved.
        </div>
    </footer>

@endsection