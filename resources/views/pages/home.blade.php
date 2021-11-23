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
        
        <div class="featured">
            <div class="row white-bg">
                <div class="col-lg-4 col-sm-4"> 
                    <img
                        src = "{{ asset('storage/'.substr($latestblog->image_path, 7)) }}"
                        title = "{{ $latestblog->title }}"
                        alt = "{{ $latestblog->title }} img"
                    />
                </div>

                <div class="col-lg-8 col-sm-8">
                    <div class='card'>
                        <div class="card-body">
                            <h2 class="card-title"> <a href="{{ route('view-blog', $latestblog->id) }}"> {{ $latestblog->title }} </a> </h2>
                            @php 
                                $category = \App\Models\Blog::where('id', $latestblog->id)->pluck('category');
                                $categoryname = \App\Models\Category::where('id', $category)->pluck('name');
                            @endphp
                            <small>
                                <span> {{ $latestblog->created_at->format('M d, Y') }} &nbsp; {{ $latestblog->created_at->format('H:i A') }}  &nbsp; · &nbsp; 
                                    @php
                                        $blog_content = \App\Models\Blog::where('id', $latestblog->id)->get('content');
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
                                    read &nbsp; · &nbsp; 
                                </span>
                                <span class="btn btn-sm"> {{ substr($categoryname, 2, -2) }}  </span>
                            </small>
                        </div>

                        <div class="card-body">
                            <div class='card-text'>
                                <p class="text-justify"> {{ substr(strip_tags($latestblog->content), 0, 630).'...' }} </p>
                            </div>
                            <p> <a href="{{ route('view-blog', $latestblog->id) }}"> <b> READ MORE <i class="fa fa-angle-double-right pl-1" style="font-size: 17px;"></i> </b> </a> </p>    
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="latest">
            <div class="row"> 
                <div class="latestheader col-lg-9 col-sm-9"> 
                    <!-- <hr /> -->
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
                                            <h4 class="card-title mb-1"> <a href="{{ route('view-blog', $blog->id) }}"> {{ $blog->title }} </a> </h4>
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
                                            <p class="btn btn-sm"> <a style="color: #fff;" href="{{ route('view-blog', $blog->id) }}"> Read blog </a> </p>    
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-5 col-sm-5 float-right">
                                    <img
                                        src="{{ asset('storage/'.substr($blog->image_path, 7)) }}"
                                        title="{{ $blog->title }}"
                                        alt="{{ $blog->title }} img"
                                    />
                                </div>
                            @endforeach
                        @else
                            @php echo "<h4 class='ml-4 mt-4' style='color: red; font-family: cursive;'>"."No blogs here yet."."</h4>" @endphp
                        @endif
                    </div>
                </div>

                <div class="col-lg-3 col-sm-3" hidden-xs>
                    <h5> Read about: </h5>
                    <ul>
                        @foreach($categories as $category)
                            <li> <a href="{{ url('/categories/'.$category->id.'/'.Str::slug($category->name)) }}" onclick="submitter({{ $category->id, $category->name }})" value="{{ $category->id }}"> {{$category->name}} </a> </li>
                        @endforeach
                    </ul>
                </div>

            </div>
        </div>

    </main>


    <script type='text/javascript'>
        function submitter(value, name) {
            $.get("{{ url('categories/') }}/"+value, function(response){
                return value;
            })
        }
    </script>

@endsection
