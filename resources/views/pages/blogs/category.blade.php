@extends('layouts.main')

@section('content')
    <div class="content-header" style="margin-left: 8px;">
        <div class="row mb-2">
            <ul class="breadcrumb float-sm-left ml-1">
                <li class="breadcrumb-item"><a href="{{url('/')}}" style="color: #000;"><i class="fa fa-home"></i></a></li>
                <li class="breadcrumb-item" style="color: #000;">Categories</li>
            </ul>
        </div>
    </div>

    <main role="main" class="main" style="margin: 0 auto;">

    </main>

    
    <footer class="navbar fixed-bottom text-dark text-center">
        <div class="container text-center" style="margin-left: 41%;">
            &copy; {{ date('Y')}} Zalego. All rights reserved.
        </div>
    </footer>

@endsection