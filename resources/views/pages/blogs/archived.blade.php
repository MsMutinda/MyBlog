@extends('layouts.main')

@section('content')

        <br><br>
        <main role="main" class="container-fluid" style="margin: 0 auto;">
            @foreach($archived as $archive)
            <h3 class='card-header'><strong>   {{ $archive->title }} </strong></h3>
            <div class='card-body'>
                <span class="header-sub">Written by <b> {{ $archive->author }} </b> on <b> {{ substr($archive->created_at, 0, 10) }}</b></span>
                <div class='card-text'>
                    <p class='py-2'> {{ $archive->content }} </p>
                </div>
            </div>
            @endforeach
        </main>
    
        
    <div class='mt-5'>
        <a href="{{ route('blog.restore', $archive->id) }}" class="btn btn-default shadow-lg" onclick="return confirm('Continue to restore this blog?')">
        <i class="fa fa-pencil text-primary"></i> Restore </a>
    </div>

    <footer class="navbar fixed-bottom text-dark text-center">
        <div class="container text-center" style="margin-left: 41%;">
            &copy; {{ date('Y')}}. All rights reserved.
        </div>
    </footer>

@endsection