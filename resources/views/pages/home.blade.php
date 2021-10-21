@extends('layouts.main')

@section('content')

    <main role="main" class="container-fluid mr-2" style="margin: 0 auto;">
        <div class="row categories">
            <div class="col-lg-12 col-sm-12" style="font-weight: bolder;"> Read about:
                <ul>
                    @foreach($categories as $category)
                        <!-- TO DO:: link to the filtered content specific for each category -->
                        <li value="{{ $category->name }}"> <a href="">{{ $category->name }} </a></li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="featured-blogs row">
            <!-- <div class="col-lg-3 col-sm-3">
                <h3> <strong> Featured blogs </strong> </h3>
            </div> -->
            <div class="col-lg-12 col-sm-12 card">
                <div class="carousel slide" data-ride="carousel">
                    @foreach($featuredBlogs as $featured)
                        <div class="carousel-item @if($loop->first) active @endif mt-4">
                            <h4 style="color: #ffa500;"><strong> {{ $featured->title }} </strong></h4>
                            <span class="header-sub">Written by <b> {{ $featured->author }} </b> on <b> {{ $featured->created_at->format('M d') }} </b> </span>
                            <div class='content'>
                                <p> {{ substr($featured->content, 0, 250).'...' }} </p>
                            </div>
                            <p class="btn btn-info"> <a href="{{ route('blog.show', $featured->id) }}"> Read blog </a></p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>


        <div class="row">
            <h2 style="font-weight: bolder; margin-left: 42px; margin-top: 20px;">Latest posts</h2>

            <div class='col-lg-12 col-sm-12'>
                <div class="row">
                    @if(\App\Models\Blog::count() > 0)
                        @foreach($blogs as $blog)
                        <div class='col-lg-3 col-sm-3 shadow-sm' style="margin: 35px 45px; padding: 1.5rem 1.8rem; background: url('../storage/<?php echo substr($blog->image_path, 7) ?>'); background-repeat: no-repeat; background-size: cover;">
                        <!-- background: url('../storage/<?php echo substr($blog->image_path, 7) ?>'); background-repeat: no-repeat; background-size: cover; -->
                            <!-- <img src="{{ asset('storage/'.substr($blog->image_path, 7)) }}" alt="{{ $blog->image}} img" width="450px;"> -->
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
        </div>
    </main>

        <!-- <footer class="navbar fixed-bottom text-dark text-center" style="background-color: inherit;">
        <div class="container text-center" style="margin-left: 41%;">
            &copy; {{ date('Y')}}. All rights reserved.
        </div>
    </footer> -->

@endsection
