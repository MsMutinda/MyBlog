@extends('layouts.main')

@section('content')

    <main role="main" class="categories">
        <div class="row">
            <div class="topheader col-lg-12 col-sm-12">
                <h3> Articles on {{ substr($categoryname, 2, -2) }} </h3>
                <p>Get more insights on your technology journey</p>
                <hr />
            </div>
        </div>
        <div class="row">
            @if(count($filtered) > 0)
                @foreach($filtered as $f)
                    <!-- @php $blog_id = $f->id; @endphp -->
                    <div class="col-lg-7 col-sm-7">
                        <div class='card'>
                            <div class="card-body">
                                <h4 class="card-title mb-1"> <a href="{{ route('view-blog', $f->id) }}"> {{ $f->title }} </a> </h4>
                                <small>
                                    <span> {{ $f->created_at->format('M d, Y') }} &nbsp; {{ $f->created_at->format('H:i A') }}  &nbsp; · &nbsp; 
                                        @php
                                            $blog_content = \App\Models\Blog::where('id', $f->id)->get('content');
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
                                        read &nbsp; 
                                    </span>
                                </small>
                            </div>

                            <div class="card-body">
                                <div class='card-text'>
                                    <p> {{ substr(strip_tags($f->content), 0, 390).'...' }} </p>
                                </div>
                                <p class="btn btn-sm"> <a style="color: #fff;" href="{{ route('view-blog', $f->id) }}"> Read blog </a> </p>    
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-5 col-sm-5">
                        <img
                            src="{{ asset('storage/'.substr($f->image_path, 7)) }}"
                            title="{{ $f->title }}"
                            alt="{{ $f->title }} img"
                        />
                    </div>
                @endforeach
            @else
                @php echo "<h4 class='ml-4 mt-4' style='color: red; font-family: cursive;'>"."No blogs here yet."."</h4>" @endphp
            @endif
        </div>
    </main>

@endsection