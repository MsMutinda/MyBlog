@extends('layouts.main')

@section('content')
    <section class='card shadow-sm py-3 px-3' style='margin-top: 45px;'>
        <h3>Add a new blog</h3> 
        <form method="POST" action="{{ route('blog.save') }}" enctype="multipart/form-data">
        @csrf
            
                <div class="card-body bg-light">
                    <div class="col-lg-8 col-sm-6">
                        <div class="form-group">
                            <label> Blog Title <span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control shadow" placeholder="Blog Title goes here" required>
                        </div>
                    </div>
                </div>

                <div class="card-body bg-light">
                    <div class="col-lg-8 col-sm-6">
                        <div class="form-group">
                            <label> Author<span class="text-danger">*</span></label>
                            <input type="text" name="author" class="form-control shadow" value="{{ Auth::user()->fname }}" readonly required>
                        </div>
                    </div>
                </div>

                <div class="card-body bg-light">
                    <div class="col-lg-8 col-sm-6">
                        <div class="form-group">
                            <label> Content <span class="text-danger">*</span></label>
                            <input type="text" name="content" class="form-control shadow" placeholder="Write your content here" required>
                        </div>
                    </div>
                </div>

                <button class="btn bnt-lg btn-success float-left" type="submit" onclick="return confirm('You are about to save this Blog, continue?');"> Save Blog</button>

        </form>
    </section>
@endsection