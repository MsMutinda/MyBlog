@extends('layouts.main')

@section('content')

    <main role="main" style="margin: 0 auto;">
        <div class="nav">
            <div class="nav__menucontainer">
                <div class="nav__listcontainer" tabindex="0">
                    <ul class="nav__menu" id="navmenu">
                        <li class="nav__item" style="font-weight: 700;">Read about:</li>
                            @foreach($categories as $category)
                                <!-- TO DO:: link to the filtered content specific for each category -->
                                <li class="nav__item" id="category" value="{{ $category->id }}"> <a href="" class="nav__link"> {{ $category->name }} </a></li>
                            @endforeach
                    </ul>
                    <a id="hamburger" href="#navmenu" title="menu" class="nav__hamburger">
                        <i class="fa fa-bars ham ml-2"></i> <p class="ml-2 mb-1" style="position: relative; bottom: 3px; font-weight: 700; "> Blog categories </p>
                    </a>
                </div>
                <a href="#!" title="close menu" class="nav__hamburgerclose"><i class="fa fa-2x fa-times-circle"></i></a>
            </div>
        </div>

        <div class="featured-blogs row">
            <!-- Carousel section -->
            <div id="carouselControls" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    @foreach($featuredBlogs as $featured)
                    <!-- Single carousel item -->
                    <div class="carousel-item @if($loop->first) active @endif">
                        <h4><strong> {{ $featured->title }} </strong></h4>
                        <p> {{ substr($featured->content, 0, 350).'...' }} </p>
                        <p class="ml-2" style="font-size: 18px; color: #f27a1f"> <i class="fa fa-caret-right"></i> <u><b><a style="color: #f27a1f" href="{{ route('blog.show', $featured->id) }}"> Read more... </a></b></u></p>
                    </div>
                    @endforeach
                </div>
                <!-- <a class="carousel-control-prev" href="#carouselControls" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselControls" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a> -->
            </div>
            <!-- End Carousel -->
        </div>

        <div class="row"> <div class="col-lg-12 col-sm-12 ml-1"> <h2 style="font-weight: bolder;">Latest posts</h2></div></div>
        <div class="latest">
            <div class="row ml-1">
                @if(\App\Models\Blog::count() > 0)
                    @foreach($blogs as $blog)
                    <!-- <div class='card col-lg-3 col-sm-3'> -->
                    <div class='card'>
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
                                <p> {{ substr($blog->content, 0, 110).'...' }} </p>
                            </div>
                            <p class="btn"> <a href="{{ route('blog.show', $blog->id) }}" style="color: #fff;"> Read blog </a></p>
                        </div>
                    </div>
                    @endforeach

                @else
                <?php echo "<h4 class='ml-4 mt-4' style='color: red; font-family: cursive;'>"."No blogs here yet."."</h4>" ?>

                @endif
            </div>
        </div>

        <section class="row footer2 py-3 px-3">			
            <div class="col-lg-4 col-sm-4">
                <img src="https://zalegoacademy.ac.ke/asset/img/zalegocurrentlogo.png" class="logo size-lg" alt="zalegocurrentlogo">
                <div class="socials">
                    <a class="social" href=""><i class="fa fa-facebook"></i></a>
                    <a class="social" href=""><i class="fa fa-twitter"></i></a>
                    <a class="social" href=""><i class="fa fa-instagram"></i></a>
                    <a class="social" href=""><i class="fa fa-linkedin"></i></a>		
                </div>
                <div class="links">
                    <ul class="mt-4">
                        <li><a href="#">Zalego academy</a></li>
                        <li> <a href="#">Privacy</a></li>
                        <li><a href="#">Terms & Conditions </a></li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-8 col-sm-8">
                <div class="newsletter">
                    <h3>Get free notifications when a new blog is published</h3>
                    <p class="ml-2">We promise to send only the best to your inbox. </p>
                    <form method="post" action="">
                        @csrf
                        <input type="email" name="email" placeholder="Enter your email address">
                        <button type="submit">Notify Me</button>
                    </form>
                </div>
            </div>
        </section>

    <footer class="navbar fixed-bottom text-dark text-center">
        <div class="container text-center text-dark" style="margin-left: 41%;">
        <b> &copy; {{ date('Y')}} Zalego. All rights reserved. </b>
        </div>
    </footer>

    </main>

    <script type='text/javascript'>
        $(document).on('click','#category',function() {
            // Get selected category id
            var category=$(this).val();
            // alert(category);
            var vm=$(this);

            // Run Ajax
            $.ajax({
                url:"{{ url('/') }}",
                type:"post",
                dataType:'json',
                data:{
                    category: category,
                    token: "{{ csrf_token() }}"
                }
            });
        });
    </script>

@endsection
