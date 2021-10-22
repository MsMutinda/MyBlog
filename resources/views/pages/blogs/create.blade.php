@extends('layouts.main')

@section('content')
    <section class='card shadow-sm py-3 px-3 my-5 modal fade" id="myModal-2' role="dialog" style='margin: 0 auto; width: 45vw;'>
        <h3>Add a new blog</h3> 
        <form method="POST" action="{{ route('blog.save') }}" enctype="multipart/form-data">
        @csrf                 

            <div class="card-body">
                <div class="form-group">
                    <label> Blog Title <span class="text-danger">*</span></label>
                    <input type="text" name="title" class="form-control shadow" placeholder="Blog name goes here" required>
                </div>
            </div>

            <div class="card-body">
                <div class="form-group">
                    <label> Category <span class="text-danger">*</span></label>
                    <select class='form-control' name="category">
                        <option value="--Select Category" selected disabled>Select category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>                    
                </div>
            </div>

            <div class="card-body">
                <div class="form-group">
                    <label> Content <span class="text-danger">*</span></label>
                    <input type="text" name="content" class="form-control shadow" placeholder="Write your content here" required>
                </div>
            </div>

            <div class="card-body">
                <div class="form-group">
                    <label> Upload blog image <span class="text-danger">*</span></label> <br>
                    <input type="file" name="file" required>
                </div>
            </div>

            <button class="btn bnt-lg btn-success float-left" type="submit" onclick="return confirm('You are about to save this Blog, continue?');"> Save Blog</button>

        </form>
    </section>
@endsection