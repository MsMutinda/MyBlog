@extends('layouts.main')

@section('content')
<br><br>
    <main role="main" class="container-fluid mx-3">
        @foreach($blogs as $blog)
            <h3 class='card-header'><strong>   {{ $blog->title }} </strong></h3>
            <div class='card-body'>
                <span class="header-sub">Written by <b> {{ $blog->author }} </b> on <b> {{ substr($blog->created_at, 0, 10) }}</b></span>
                <div class='card-text'>
                    <p class='py-2'> {{ $blog->content }} </p>
                </div>
            </div>
        @endforeach
    </main>

    <footer class="navbar fixed-bottom text-dark text-center">
        <div class="container text-center" style="margin-left: 41%;">
            &copy; {{ date('Y')}}. All rights reserved.
        </div>
    </footer>

@endsection