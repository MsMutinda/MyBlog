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
        <div class="row topheader">
            <div class="col-lg-12 col-sm-12 mt-4">
                <h3> {{ substr($categoryname, 2, -2) }} articles </h3>
                <p>Get more insights about your technology journey</p>
            </div>
        </div>
    </main>

@endsection