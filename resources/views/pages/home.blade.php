@extends('layouts.main')

@section('content')

    <main role="main" style="margin: 0 auto;">
        

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
            <div class="row">
                @if(\App\Models\Blog::count() > 0)
                    @foreach($blogs as $blog)
                    <!-- <div class='card col-lg-4 col-sm-4'> -->
                    <div class='card'>
                        <img
                            src="{{ asset('storage/'.substr($blog->image_path, 7)) }}"
                            class="card-img-top"
                            title="{{ $blog->title }} image"
                            alt="{{ $blog->title }} img"
                        />
                        <div class="card-body">
                            <h3 class="card-title"><strong> {{ $blog->title }} </strong></h3>
                            <span class="header-sub">Written by <b> {{ $blog->author }} </b> on <b> {{ $blog->created_at->format('M d, Y') }} {{ $blog->created_at->format('h:i A') }} </b> </span>
                            <div class='card-text mt-2'>
                                <p> {{ substr($blog->content, 0, 110).'...' }} </p>
                            </div>
                            <p class="btn"> <a href="{{ route('blog.show', $blog->id) }}" style="color: #fff;"> Read blog </a></p>
                        </div>
                    </div>
                    @endforeach

                @else
                </div>
                <?php echo "<h4 class='ml-4 mt-4' style='color: red; font-family: cursive;'>"."No blogs here yet."."</h4>" ?>

                @endif
            </div>

            <p class="ml-2 mt-4" style="font-size: 18px;"> <u><b><a style="color: #f27a1f" href="{{ route('blog.all') }}"> View all blogs <i class="fa fa-angle-double-right"></i></a></b></u></p>
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

           
            
        function submitter(value) {
            console.log(value)
            $.get("{{ url('categories/') }}/"+value,function(response){
                return value;
                // console.log(response)
            })
        }
    });

    </script>

@endsection
