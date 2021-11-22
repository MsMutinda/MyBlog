@extends('layouts.main')

@section('content')

    <main role="main" class="home">
        
        @if(Session::has('success'))
            <div class="alert alert-info">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p>{{ Session::get('success') }}</p>
            </div>
        @endif

        @if(Session::has('error'))
            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p>{{ Session::get('error') }}</p>
            </div>
        @endif
        
        <div class="row">
            <div class="about col-lg-9 col-sm-9"> 
                <h2> TRENDING BLOGS </h2>
                <div class="row">
                    <ul class="repeating-counter-rule">
                        @foreach($latestblogs as $latestblog)
                            <li> <a href=""> {{ $latestblog->title }} </a> </li>
                        @endforeach
                    </ul>
                </div>
                
            </div>

            <div class="tags col-lg-3 col-sm-3">
                <!-- <h5 class="write" data-toggle="modal" data-target="#createBlogModal"> <i class="mr-1 fa fa-pencil"></i> Contribute</h5> -->
                <h5 class="tags"> Tags </h5>
                <ul>
                    <li class="btn btn-sm">Design</li>
                    <li class="btn btn-sm">Tech</li>
                    <li class="btn btn-sm">Frontend</li>
                    <li class="btn btn-sm">Backend</li>
                    <li class="btn btn-sm">DBMS</li>
                    <li class="btn btn-sm">Professionalism</li>
                    <li class="btn btn-sm">Frameworks</li>
                </ul>
            </div>
            
        <hr />
        </div>


        <div class="latest">
            <div class="row"> 
                <div class="latestheader col-lg-9 col-sm-9"> 
                    <h2>Latest blogs </h2>
                    <hr />
                    @if(Session::has('Error'))
                        <div class="alert alert-warning">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <p>{{ Session::get('Error') }}</p>
                        </div>
                    @endif
                    <div class="row">
                        @if(\App\Models\Blog::count() > 0)
                            @foreach($blogs as $blog)
                                
                                <!-- @php $blog_id = $blog->id; @endphp -->

                                <div class="col-lg-7 col-sm-7">
                                    <div class='card'>
                                        <div class="card-body">
                                            <h4 class="card-title mb-2"> <a href="{{ route('view-blog', $blog->id) }}"> {{ $blog->title }} </a> </h4>
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
                                                        $minutes = ($minute_count === 0) ? $seconds_count : $minute_count;
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
                                                <p> {{ substr(strip_tags($blog->content), 0, 190).'...' }} </p>
                                            </div>
                                            <p class="btn btn-sm" style="color: #fff;"> <a style="color: #fff;" href="{{ route('view-blog', $blog->id) }}"> <b> Read blog </b> </a> </p>    
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
                            <li> <a href="{{ url('/categories/'.$category->id.'/'.Str::slug($category->name)) }}" onclick="submitter({{ $category->id, $category->name }})" value="{{ $category->id }}"> {{$category->name}} </a> </li>
                        @endforeach
                    </ul>
                </div>

            </div>
        </div>



        <!-- Newsletter Modal here -->


    </main>


    <script type='text/javascript'>
        function submitter(value, name) {
            $.get("{{ url('categories/') }}/"+value, function(response){
                return value;
            })
        }
    </script>

@endsection
