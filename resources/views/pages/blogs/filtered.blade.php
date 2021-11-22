@extends('layouts.main')

@section('content')

    <main role="main" class="main" style="margin: 0 auto;">
        <div class="row topheader">
            <div class="col-lg-12 col-sm-12 mt-4">
                <h3> {{ substr($categoryname, 2, -2) }} articles </h3>
                <p>Get more insights about your technology journey</p>
            </div>
        </div>
    </main>

@endsection