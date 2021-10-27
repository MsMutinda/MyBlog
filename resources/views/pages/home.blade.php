@extends('layouts.main')

@section('content')

    <main role="main" class="main">
        <div class="row topheader">
            <div class="col-lg-12 col-sm-12">
                <h3>Blog</h3>
                <p>Get more insights about your technology journey</p>
            </div>
        </div>

        <div class="row first">
            <div class="col-lg-8 col-sm-8">
                <?php $firstblog = \App\Models\Blog::orderBy('created_at', 'DESC')->first();?>
                <div class='firstblog row'>
                    <div class="col-lg-7 col-sm-7">
                        <img
                            src="{{ asset('storage/'.substr($firstblog->image_path, 7)) }}"
                            class="card-img"
                            title="{{ $firstblog->title }} image"
                            alt="{{ $firstblog->title }} img"
                            height="495px"
                        />
                    </div>
                    <div class="col-lg-5 col-sm-5 text-white">
                        <h5>{{ $firstblog->created_at->format('M d, Y') }}</h5>
                        <h1><b> {{ $firstblog->title }} </b></h1>
                        <p class="mt-3"> {{ substr($firstblog->content, 0, 300).'...' }} </p>
                        <p class="btn btn-lg mt-4" style="background: #fff; width: 35%; bor"> <b><a href="{{ route('view-blog', $firstblog->id) }}" style="color: #f27a1f;"> Read blog </a></b> </p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-sm-4">
                <h2>How to do: </h2>
                <div>
                    <h5>LARAVEL</h5>
                    <h6><b>How to create a Laravel project</b></h6>
                    <p>In this blog, you will learn how to ...</p>
                </div>
                <div>
                    <h5>REACT</h5>
                    <h6><b>How to create a React project</b></h6>
                    <p>In this blog, you will learn how to ...</p>
                </div>
                <div>
                    <h5>UI/UX</h5>
                    <h6><b>How to create a UI/UX project</b></h6>
                    <p>In this blog, you will learn how to ...</p>
                </div>
                <div>
                    <h5>QUALITY ASSURANCE</h5>
                    <h6><b>Tips and best practices</b></h6>
                    <p>In this blog, you will learn how to ...</p>
                </div>
            </div>
        </div>

        <div class="row"> <div class="col-lg-12 col-sm-12 ml-1"> <h2 style="font-weight: bolder; padding-left: 100px;">Latest posts</h2></div></div>
        <hr style="width: 88%;" />
        <div class="latest">
            <div class="row">
                @if(\App\Models\Blog::count() > 0)
                    <div class="blogs">
                        @foreach($blogs as $blog)
                        <div class='card'>
                            <img
                                src="{{ asset('storage/'.substr($blog->image_path, 7)) }}"
                                class="card-img-top"
                                title="{{ $blog->title }} image"
                                alt="{{ $blog->title }} img"
                            />
                            <div class="card-body">
                                <p class="btn btn2 px-4">
                                    <?php 
                                        $blogCategory = \App\Models\Category::where('id' , '=', $blog->category)->pluck('name');
                                        echo substr($blogCategory, 2, -2);
                                    ?> 
                                </p>
                                <h5 class="card-title"><strong> {{ $blog->title }} </strong></h5>
                                <span class="header-sub">Written by <b> {{ $blog->author }} </b> on {{ $blog->created_at->format('M d, Y') }} {{ $blog->created_at->format('h:i A') }} </b> </span>
                                <div class='card-text mt-2'>
                                    <p> {{ substr($blog->content, 0, 110).'...' }} </p>
                                </div>
                                
                                <p class="readMore"> <b><a style="color: #f27a1f" href="{{ route('view-blog', $blog->id) }}"> Read more </b></a> <i class="fa fa-arrow-right"></i> </p>

                            </div>
                        </div>
                        
                        @endforeach
                    </div>
                @else
            </div>
                <?php echo "<h4 class='ml-4 mt-4' style='color: red; font-family: cursive;'>"."No blogs here yet."."</h4>" ?>

                @endif
            </div>

            <!-- <p class="mt-4" style="font-size: 20px;"> <a style="color: #f27a1f; text-decoration: underline; font-weight: 800" href="{{ route('viewAllBlogs') }}"> View all blogs </a> </p> -->
        </div>

        <div class="row topheader">
            <div class="col-lg-12 col-sm-12">
                <h3 style="text-transform: capitalize; padding: 10px 30px; width: 80%;"> Building the talent pipeline to power africa's technology industry</h3>
            </div>
        </div>

        <section class="row footer2">			
            <div class="col-lg-4 col-sm-4">
                <img src="https://zalegoacademy.ac.ke/asset/img/zalegocurrentlogo.png" class="logo size-lg" alt="zalegocurrentlogo">
                <p>Unlock infinite possibilities</p>
            </div>
            <div class="links col-lg-2 col-sm-2" style="font-size: 20px;"><b>Quick Links</b>
                <ul class="mt-2">
                    <li><a href="#">Zalego academy</a></li>
                    <li> <a href="#">Faqs</a></li>
                    <li><a href="#">Terms & Conditions </a></li>
                </ul>
            </div>
            <div class="links col-lg-2 col-sm-2" style="font-size: 20px;"> <b>Social Media</b>
                <ul class="mt-2">
                    <li><a href="#">Twitter</a></li>
                    <li> <a href="#">Linkedin</a></li>
                    <li><a href="#">Instagram </a></li>
                </ul>
            </div>
            <div class="links col-lg-2 col-sm-2" style="font-size: 20px;"><b>Legal</b>
                <ul class="mt-2">
                    <li> <a href="#">Privacy Policy</a></li>
                    <li><a href="#">Terms & Conditions </a></li>
                    <li><a href="#">SLAs</a></li>
                </ul>
            </div>
            <div class="links col-lg-2 col-sm-2" style="font-size: 20px;"><b>Contact</b>
                <ul class="mt-2">
                    <li><a href="#">Nairobi, Kenya</a></li>
                    <li> <a href="#">info@zalego.com</a></li>
                    <li><a href="#">+2547 23 274 774 </a></li>
                </ul>
            </div>
        </section>
    </main>

    <script type='text/javascript'>
        // $(document).on('click','#category', function() {
            // Get selected category id
            var category=$(this).val();
            // alert(category);


        function submitter(value) {
            console.log(value)
            $.get("{{ url('blogs/') }}/"+value, function(response){
                return value;
                // console.log(response)
            })
        }
    // });

    </script>

@endsection
