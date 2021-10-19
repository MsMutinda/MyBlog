@extends('layouts.main')

@section('content')

    <div style='margin-top: 40px' class="select-category">
        <select class='text-center'>
            <option value="--Select Category" selected disabled>Filter by category</option>
            @foreach($categories as $category)
                <option value="{{ $category->name }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>

        <main role="main" class="container-fluid mt-3" style="margin: 0 auto; width: 96vw;">
            <div class='row'>

                @if(\App\Models\Blog::count() > 0)
                    @foreach($blogs as $blog)
                    <div class='col-lg-3 col-sm-3 shadow-sm mb-2' style="padding: 1rem 0.8rem; background: url('../storage/<?php echo substr($blog->image_path, 7) ?>'); background-repeat: no-repeat; background-size: cover;"> 
                        <h3><strong> {{ $blog->title }} </strong></h3>
                        <span class="header-sub">Written by <b> {{ $blog->author }} </b> on <b> {{ $blog->created_at->format('M d') }} </b> </span>
                        <div class='content'>
                            <p class=''> {{ substr($blog->content, 0, 150).'...' }} </p>
                        </div>
                        <p class="btn btn-info"> <a href="{{ route('blog.show', $blog->id) }}"> Read blog </a></p>
                    </div>
                    <!-- <div class="col-lg-1 col"></div> -->
                    @endforeach

                @else
                <?php echo "<h4 class='ml-4 mt-4' style='color: red; font-family: cursive;'>"."No blogs here yet."."</h4>" ?>

                @endif


            </div>
        </main>

        <!-- <footer class="navbar fixed-bottom text-dark text-center" style="background-color: inherit;">
        <div class="container text-center" style="margin-left: 41%;">
            &copy; {{ date('Y')}}. All rights reserved.
        </div>
    </footer> -->

@endsection
