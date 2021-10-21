@extends('layouts.main')

@section('content')

    <main role="main" class="container-fluid mr-2" style="margin: 0 auto;">
        <div class="row categories ml-2">
            <div style="font-weight: bolder; width: 10%;"> Read about:</div>
            <div class="col-lg-10 col-sm-10">
                <ul>
                    @foreach($categories as $category)
                        <!-- TO DO:: link to the filtered content specific for each category -->
                        <!-- <li value="{{ $category->id }}"> <a href="{{ route('blog.show', $category->id) }}" id="category">{{ $category->name }} </a></li> -->
                        <li value="{{ $category->id }}"> <a href="" id="category" data-post="{{ $category->id}}">{{ $category->name }} </a></li>
                    @endforeach
                </ul>
            </div>
        </div>

        <script type="text/javascript">
            $(document).on('click', '#category', function() {
                var selected_category = $(this).data('post');
                $.ajax({
                    url:"{{ route('home') }}",
                    type:"post",
                    dataType:'json',
                    data: {
                        selected_category: selected_category,
                        _token:"{{ csrf_token() }}"
                    },
                    success: function(data) {
                        alert(data.text);
                    },
                });
            });
        </script>

        <div class="featured-blogs row">
            <!-- <div class="col-lg-3 col-sm-3">
                <h3> <strong> Featured blogs </strong> </h3>
            </div> -->
            <!-- Carousel section -->
            <div class="carousel slide" data-ride="carousel">
                <div class="col-lg-12 col-sm-12">
                    @foreach($featuredBlogs as $featured)
                    <!-- Single carousel item -->
                    <div class="carousel-item @if($loop->first) active @endif bg-light" style="padding: 20px;">
                        <h4><strong> {{ $featured->title }} </strong></h4>
                        <p> {{ substr($featured->content, 0, 350).'...' }} </p>
                        <p class="ml-2" style="font-size: 18px; color: #ffa500"> <i class="fa fa-caret-right"></i> <u><a style="color: #ffa500" href="{{ route('blog.show', $featured->id) }}"> Read more... </a></u></p>
                    </div>
                    @endforeach
                </div>
            </div>
            <!-- End Carousel -->
        </div>

        
        <div class="row"> <div class="col-lg-12 col-sm-12"> <h2 style="font-weight: bolder;">Latest posts</h2></div></div>
        <div class="row">
            @if(\App\Models\Blog::count() > 0)
                @foreach($blogs as $blog)
                <div class='card col-lg-3 col-sm-3' style="margin: 15px 0; padding: 0rem;">
                    <img
                        src="{{ asset('storage/'.substr($blog->image_path, 7)) }}"
                        class="card-img-top"
                        title="{{ $blog->title }} image"
                        alt="{{ $blog->title }} img"
                    />
                    <div class="card-body">
                        <h3 class="card-title"><strong> {{ $blog->title }} </strong></h3>
                        <span class="header-sub">Written by <b> {{ $blog->author }} </b> on <b> {{ $blog->created_at->format('M d, Y') }} </b> </span>
                        <div class='card-text mt-2'>
                            <p> {{ substr($blog->content, 0, 120).'...' }} </p>
                        </div>
                        <p class="btn btn-info"> <a href="{{ route('blog.show', $blog->id) }}"> Read blog </a></p>
                    </div>
                </div>
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
