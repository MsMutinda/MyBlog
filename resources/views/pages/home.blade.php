@extends('layouts.main')

@section('content')

    <main role="main" class="main">
        
        <div class="row"> 
            <div class="about col-lg-9 col-sm-19"> 
                <h2> Some heading </h2>
                <!-- <img src="" alt="" class="float-right"> -->
                <!-- <span class="float-right rounded-circle bg-warning text-center text-white px-4 py-3">
                    <strong>
                        <?php
                        $str='Juliet';
                        echo strtoupper($str[0]);
                        ?>
                    </strong>
                </span> -->
                <!-- <p> Intern Laravel Developer | Technical Writer </p> -->
                <p> To be filled later </p>
                <hr />
            </div>

            <div class="col-lg-3 col-sm-3">
                <h5 class="write mb-3"> <i class="mr-2 fa fa-pencil"></i> Contribute</h5>
                <h5 class="tags"> Tags </h5>
            </div>
        </div>

        
        

        <div class="latest">
            <div class="row"> 
                <div class="latestheader col-lg-9 col-sm-9"> 
                    <h2>Published blogs </h2>
                    <hr />

                    <div class="row">
                        @if(\App\Models\Blog::count() > 0)
                            @foreach($blogs as $blog)
                                
                                @php $blog_id = $blog->id; @endphp

                                <div class="col-lg-7 col-sm-7">
                                    <div class='card'>
                                        <div class="card-body">
                                            <h3 class="card-title mb-2"><strong> {{ $blog->title }} </strong></h3>
                                                @php 
                                                    $category = \App\Models\Blog::where('id', $blog->id)->pluck('category');
                                                    $categoryname = \App\Models\Category::where('id', $category)->pluck('name');
                                                @endphp
                                            <small>
                                                <span> {{ $blog->created_at->format('M d, Y') }} &nbsp; {{ $blog->created_at->format('H:i A') }}  &nbsp; · &nbsp; 
                                                    @php
                                                        $blog_content = \App\Models\Blog::where('id', $blog->id)->get('content');
                                                        $wpm = 200;
                                                        $wordCount = str_word_count(strip_tags($blog_content));
                                                        $minute_count = (int) floor($wordCount / $wpm); 
                                                        $seconds_count = (int) floor($wordCount % $wpm / ($wpm / 60));                                            
                                                        $minutes = ($minute_count === 0) ? $seconds_count : $minutes;
                                                        if ($minute_count === 0) {
                                                            echo $seconds_count.'-sec';
                                                        }
                                                        else {
                                                            echo $minute_count.'-min';
                                                        }
                                                    @endphp
                                                    read &nbsp; · &nbsp;  <p class="btn btn-sm"> {{ substr($categoryname, 2, -2) }} </p> </span>
                                            </small>
                                        </div>

                                        <div class="card-body">
                                            <div class='card-text'>
                                                <p> {{ substr($blog->content, 0, 194).'...' }} </p>
                                            </div>
                                            <!-- Newsletter modal button trigger -->
                                            <p class="btn btn-sm" data-toggle="modal" data-target="#newsletterModal" style="color: #fff;"> <b> Read blog </b> </p>    
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-5 col-sm-5 float-right">
                                    <img
                                        src="{{ asset('storage/'.substr($blog->image_path, 7)) }}"
                                        title="{{ $blog->title }} image"
                                        alt="{{ $blog->title }} img"
                                    />
                                </div>
                            @endforeach
                        @else
                            @php echo "<h4 class='ml-4 mt-4' style='color: red; font-family: cursive;'>"."No blogs here yet."."</h4>" @endphp
                        @endif
                    </div>
                </div>

                <div class="col-lg-3 col-sm-3">
                    <h5> Read about: </h5>
                        <ul>
                            @foreach($categories as $category)
                                <li> <a href="{{ url('/blogs/'.$category->id.'/'.Str::slug($category->name)) }}" onclick="submitter({{ $category->id, $category->name }})" value="{{ $category->id }}"> {{$category->name}} </a> </li>
                            @endforeach
                        </ul>
                </div>
            </div>
        </div>


        <!-- Modal -->
        <div class="modal fade" id="newsletterModal" tabindex="-1" role="dialog" aria-labelledby="newsletterModalLabel" aria-hidden="true">
            <div class="modal-dialog">
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
                            <input type="text" name="blog" value="{{ $blog_id }}" style="display: none;">
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
            })
        }
    </script>

@endsection
