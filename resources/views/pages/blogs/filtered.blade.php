@extends('layouts.main')

@section('content')

    <main role="main" class="categories">
        <div class="row">
            <div class="topheader">
                <h3 style="color: #2b6797;"> Get more insights on {{ substr($categoryname, 2, -2) }} </h3>
                <hr />
            </div>
        </div>
        <div class="row">
            @if(count($filtered) > 0)
                @foreach($filtered as $f)
                    <div class="col-lg-4 col-sm-4">
                        <img
                            src="{{ asset('storage/'.substr($f->image_path, 7)) }}"
                            title="{{ $f->title }}"
                            alt="{{ $f->title }} img"
                        />
                    </div>
                    <div class="col-lg-8 col-sm-8">
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
                                    <p> {{ substr(strip_tags($f->content), 0, 288).'...' }} </p>
                                </div>
                                <p class="btn btn-sm"> <a style="color: #fff;" href="{{ route('view-blog', $f->id) }}"> Read blog </a> </p>    
                            </div>
                        </div>
                    </div>

                    
                @endforeach
            @else
                @php echo "<h5 class='ml-1' style='color: #8a8a8a;'>"."No blogs here yet."."</h5>" @endphp
            @endif
        </div>
    </main>

@endsection