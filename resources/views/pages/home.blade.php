@extends('layouts.main')

@section('content')

    <main role="main" class="row container-fluid mr-2" style="margin: 0 auto;">
        <div class="featured-blogs card ml-3 col-lg-11 col-sm-11">
            <p> <strong> Featured blogs </strong> </p>
        </div>

        <div class="col-lg-2 categories shadow-sm">
            <h4 style="font-weight: bolder;">Categories</h4>
            <ul>
                @foreach($categories as $category)
                    <li value="{{ $category->name }}">{{ $category->name }}</li>
                @endforeach
            </ul>
        </div>

        <div class='col-lg-10'>
            <div class="row" style="margin-left: 25px;">
                @if(\App\Models\Blog::count() > 0)
                    @foreach($blogs as $blog)
                    <div class='col-lg-5 col-sm-5 shadow-sm' style="margin: 35px 35px; padding: 1.5rem 1.8rem; background: url('../storage/<?php echo substr($blog->image_path, 7) ?>'); background-repeat: no-repeat; background-size: cover;"> 
                        <h3><strong> {{ $blog->title }} </strong></h3>
                        <span class="header-sub">Written by <b> {{ $blog->author }} </b> on <b> {{ $blog->created_at->format('M d') }} </b> </span>
                        <div class='content'>
                            <p> {{ substr($blog->content, 0, 150).'...' }} </p>
                        </div>
                        <p class="btn btn-info"> <a href="{{ route('blog.show', $blog->id) }}"> Read blog </a></p>
                    </div>
                    @endforeach

                @else
                <?php echo "<h4 class='ml-4 mt-4' style='color: red; font-family: cursive;'>"."No blogs here yet."."</h4>" ?>

                @endif
            </div>
        </div>
    </main>

        <!-- <footer class="navbar fixed-bottom text-dark text-center" style="background-color: inherit;">
        <div class="container text-center" style="margin-left: 41%;">
            &copy; {{ date('Y')}}. All rights reserved.
        </div>
    </footer> -->

@endsection
