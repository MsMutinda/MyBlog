@extends('layouts.main')

@section('content')

    <main role="main" class="main">
        <div class="row">
            <div class="topheader col-lg-12 col-sm-12">
                <h3>Blog</h3>
                <p>Get more insights about your technology journey</p>
            </div>
        </div>

        <div class="row first">
            <div class="col-lg-8 col-sm-8">
                @php 
                    $firstblog = \App\Models\Blog::orderBy('created_at', 'DESC')->first(); 
                @endphp
                <div class='firstblog row'>
                    <div class="col-lg-7 col-sm-7">
                        <img
                            src="{{ asset('storage/'.substr($firstblog->image_path, 7)) }}"
                            class="card-img"
                            title="{{ $firstblog->title }} image"
                            alt="{{ $firstblog->title }} img"
                        />
                    </div>
                    <div class="col-lg-5 col-sm-5 text-white">
                        <h5>{{ $firstblog->created_at->format('M d, Y') }}</h5>
                        <h1><b> {{ $firstblog->title }} </b></h1>
                        <p> {{ substr($firstblog->content, 0, 300).'...' }} </p>
                        <p class="btn btn-lg"> <b><a href="{{ route('view-blog', $firstblog->id) }}" data-toggle="modal" data-target="#newsletterModal"> Read blog </a></b> </p>
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

        <div class="row"> 
            <div class="categories col-lg-12 col-sm-12"> 
                <h2>Categories </h2>
                <ul>
                    @foreach($categories as $category)
                    <li class="btn"> <a href="{{ url('/blogs/'.$category->id.'/'.Str::slug($category->name)) }}" onclick="submitter({{ $category->id, $category->name }})" value="{{ $category->id }}"> {{$category->name}} </a> </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="row"> 
            <div class="latestheader col-lg-12 col-sm-12"> 
                <h2>Latest posts <br>
                    <hr />
                </h2>
            </div>
        </div>
        

        <div class="latest">
            <div class="row">
                @if(\App\Models\Blog::count() > 0)
                    <div class="blogs">
                        @foreach($blogs as $blog)
                        @php $blog_id = $blog->id; @endphp 
                        <div class='card'>
                            <img
                                src="{{ asset('storage/'.substr($blog->image_path, 7)) }}"
                                class="card-img-top"
                                title="{{ $blog->title }} image"
                                alt="{{ $blog->title }} img"
                            />
                            <div class="card-body">
                                <p class="btn btn2 mt-1">
                                    @php 
                                        $blogCategory = \App\Models\Category::where('id' , '=', $blog->category)->pluck('name');
                                        echo substr($blogCategory, 2, -2);
                                    @endphp 
                                </p>
                                
                                <h5 class="card-title"><strong> {{ $blog->title }} </strong></h5>

                                <small class="mt-1">
                                    <span class="float-left">
                                        <img src="" alt=""> By {{ $blog->author }}
                                    </span>
                                </small>
                                <small class="mt-1">
                                    <span class="float-right"> {{ $blog->created_at->format('d M, Y') }} {{ $blog->created_at->format('h:i A') }} </p>
                                    </span>
                                </small>
                            </div>

                            <div class="card-body">
                                <div class='card-text'>
                                    <p> {{ substr($blog->content, 0, 105).'...' }} </p>
                                </div>
                                
                                <p class="btn btn-lg"> <b><a href="{{ route('view-blog', $blog->id) }}" data-toggle="modal" data-target="#newsletterModal"> Read blog </a></b> </p>    

                            </div>
                        </div>
                        
                        @endforeach
                    </div>
                @else
            </div>

            <!-- Button trigger modal -->
                

                
                @php echo "<h4 class='ml-4 mt-4' style='color: red; font-family: cursive;'>"."No blogs here yet."."</h4>" @endphp

                @endif
            </div>
        </div>


        <!-- Modal -->
        <div class="modal fade" id="newsletterModal" tabindex="-1" role="dialog" aria-labelledby="newsletterModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newsletterModalLabel"> Newsletter form </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('save-subscriber') }}" method="post" id="newsletter-form">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" placeholder="Please enter your name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" name="email" class="form-control" aria-describedby="emailHelp" placeholder="Enter your email address" required>
                        </div>
                        <small id="emailHelp" class="form-text text-muted">We promise to only send you the best.</small>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success" name="submit" form="newsletter-form">Save changes</button>
                </div>
                </div>
            </div>
        </div>
        <!-- End of modal -->

    </main>


    <script type='text/javascript'>

        function submitter(value, name) {
            console.log(value)
            $.get("{{ url('blogs/') }}/"+value, function(response){
                return value;
                console.log(response)
            })
        }

    </script>

@endsection
