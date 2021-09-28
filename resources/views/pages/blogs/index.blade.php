@extends('layouts.main')

@section('content')

    <div style='margin-top: 50px'>
        <button> <a href="{{ route('create-blog') }}"> Add a new blog </a></button>
        <p class='mt-2'> Individual blog view more will display here from home page </p>

    </div>

    <footer class="navbar fixed-bottom text-dark text-center">
        <div class="container text-center" style="margin-left: 41%;">
            &copy; {{ date('Y')}}. All rights reserved.
        </div>
    </footer>

@endsection