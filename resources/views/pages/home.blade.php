@extends('layouts.main')

@section('content')

    <main role="main" style="margin: 0 auto;">
        <div class="row categories fixed-top">
            <div class="col-lg-12 col-sm-12">
                <ul>
                    <li style="font-weight: 700;">Read about:</li>
                    @foreach($categories as $category)
                        <!-- TO DO:: link to the filtered content specific for each category -->
                        <!-- <li value="{{ $category->id }}"> <a href="{{ route('blog.show', $category->id) }}" id="category">{{ $category->name }} </a></li> -->
                        <li value="{{ $category->id }}"> <a href="" id="category" data-post="{{ $category->id}}">{{ $category->name }} </a></li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="featured-blogs row">
            <!-- Carousel section -->
            <div class="carousel slide" data-ride="carousel">
                <!-- <div class="col-lg-12 col-sm-12"> -->
                    @foreach($featuredBlogs as $featured)
                    <!-- Single carousel item -->
                    <div class="carousel-item @if($loop->first) active @endif bg-light" style="padding: 20px; margin: 0;">
                        <h4><strong> {{ $featured->title }} </strong></h4>
                        <p> {{ substr($featured->content, 0, 350).'...' }} </p>
                        <p class="ml-2" style="font-size: 18px; color: #ffa500"> <i class="fa fa-caret-right"></i> <u><a style="color: #ffa500" href="{{ route('blog.show', $featured->id) }}"> Read more... </a></u></p>
                    </div>
                    @endforeach
                <!-- </div> -->
            </div>
            <!-- End Carousel -->
        </div>

        
        <div class="row latest"> <div class="col-lg-12 col-sm-12"> <h2 style="font-weight: bolder;">Latest posts</h2></div></div>
        <div class="row">
            @if(\App\Models\Blog::count() > 0)
                @foreach($blogs as $blog)
                <div class='card col-lg-3 col-sm-3' style="margin: 10px 0; padding: 0rem;">
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
                        <p class="btn btn-info"> <a href="{{ route('blog.show', $blog->id) }}" style="color: #000; font-weight: 700;"> Read blog </a></p>
                    </div>
                </div>
                @endforeach

            @else
            <?php echo "<h4 class='ml-4 mt-4' style='color: red; font-family: cursive;'>"."No blogs here yet."."</h4>" ?>

            @endif
        </div>


        <section class="row footer2 py-3 px-3">			
            <div class="col-lg-4 col-sm-4" style="margin-bottom: 60px;">
                <img src="https://zalegoacademy.ac.ke/asset/img/zalegocurrentlogo.png" class="logo size-lg" alt="zalegocurrentlogo">
                <div class="socials">
                    <a class="social" href=""><i class="fa fa-facebook"></i></a>
                    <a class="social" href=""><i class="fa fa-twitter"></i></a>
                    <a class="social" href=""><i class="fa fa-instagram"></i></a>
                    <a class="social" href=""><i class="fa fa-linkedin"></i></a>		
                </div>
                <div class="links">
                    <ul class="mt-5">
                        <li><a>Zalego academy</a></li>
                        <li> <a>Privacy</a></li>
                        <li><a>Terms & Conditions </a></li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-8 col-sm-8">
                <div class="newsletter">
                    <h3>Get free notifications when a new blog is published</h3>
                    <p class="ml-2">We will send only the best to your inbox</p>
                    <form>
                        <input type="email" name="email" placeholder="Enter your email address">
                        <button type="submit">Notify Me</button>
                    </form>
                </div>
            </div>
        </section>

        <footer class="navbar fixed-bottom text-dark text-center">
            <div class="container text-center" style="margin-left: 41%; color: #ee8a08;">
            <b> &copy; {{ date('Y')}} Zalego. All rights reserved. </b>
            </div>
        </footer>

    </main>

@endsection
