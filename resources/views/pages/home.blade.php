@extends('layouts.main')

@section('content')

    <div style='margin-top: 40px' class="select-category">
        <select class='text-center'>
            <option value="--Select Category" selected disabled>Select category</option>
            @foreach($categories as $category)
                <option value="{{ $category->name }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>

        <main role="main" class="container-fluid mt-3" style="margin: 0 auto; width: 95vw;">
            <div class='row'>

                @if(\App\Models\Blog::count() > 0)
                    @foreach($blogs as $blog)

                    <div class='col-lg-4 col-sm-4 shadow-sm' style="padding: 1rem 0.8rem; ">
                        <!-- show author image here -->
                        <img src="{{ $blog->image }}">
                        <h3><strong>   {{ $blog->title }} </strong></h3>
                        <span class="header-sub">Written by <b> {{ $blog->author }} </b> on <b> {{ substr($blog->created_at, 0, 10) }} {{ date('h:i a', strtotime($blog->created_at)) }} </b> </span>
                        <div class='content'>
                            <p class=''> {{ substr($blog->content, 0, 150).'...' }} </p>
                        </div>
                        <p class="btn btn-info"> <a href="{{ route('blog.show', $blog->id) }}"> Read blog </a></p>
                    </div>
                    @endforeach

                @else
                <?php echo "<h3 style='color: red; font-family: cursive; margin-top: 30px;'>"."You have no blogs yet"."</h3>" ?>

                @endif


            </div>
        </main>

        <!-- <footer class="navbar fixed-bottom text-dark text-center" style="background-color: inherit;">
        <div class="container text-center" style="margin-left: 41%;">
            &copy; {{ date('Y')}}. All rights reserved.
        </div>
    </footer> -->

@endsection
