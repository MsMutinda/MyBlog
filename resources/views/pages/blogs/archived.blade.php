@extends('layouts.main')

@section('content')

        <br><br>
        <main role="main" class="container-fluid" style="margin: 0 auto;">
        @if(count($archived) > 0)
            @foreach($archived as $archive)
            <h3 class='card-header'><strong> {{ $archive->title }} </strong>
                <div class="" style="float: right;">
                    <a href="{{ route('blog.restore', $archive->id) }}" class="text-success btn btn-default" onclick="return confirm('Continue to restore this blog?')"> <strong> Restore blog </strong> </a>
                </div>
            </h3>
            
            <div class='card-body'>
                <span class="header-sub">Written by <b> {{ $archive->author }} </b> on <b> {{ substr($archive->created_at, 0, 10) }}</b></span>
                <div class='card-text'>
                    <p class='py-2'> {{ $archive->content }} </p>
                </div>
            </div>
            @endforeach
        @else
            <?php echo '<h4 class="text-danger"> There are no archived blogs yet </h4>' ?>
        @endif
            
        </main>
    
        
    

    <footer class="navbar fixed-bottom text-dark text-center">
        <div class="container text-center" style="margin-left: 41%;">
            &copy; {{ date('Y')}}. All rights reserved.
        </div>
    </footer>

@endsection