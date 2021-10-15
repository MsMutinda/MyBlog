@extends('layouts.main')

@section('content')

    <div style='margin-top: 50px'>
        <div class='btn shadow-lg ml-5' style="background-color: #d4af37;"> <a href="{{ route('blog.create') }}" style='color: #000;'> Add a new blog </a></button>
        <!-- <p class='mt-2'> Individual blog view more will display here from home page </p> -->
    </div>
        <!-- <form class="form-inline my-1 pt-5 mx-2">
            <input class="form-control mr-sm-2" type="text" placeholder="Find blog" aria-label="Search">
            <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
        </form> -->

        <main role="main" class="container-fluid mx-3" style=" margin: 0 auto;">
            <div class='row'>

                @if(\App\Models\Blog::count() > 0)
                    @foreach($blogs as $blog)

                    <div class='col-lg-3 col-sm-3' style="padding: 2rem 1.8rem;">
                        <h3><strong>   {{ $blog->title }} </strong></h3>
                        <span class="header-sub">Written by <b> {{ $blog->author }} </b> on <b> {{ substr($blog->created_at, 0, 10) }} {{ date('h:i a', strtotime($blog->created_at)) }} </b> </span>
                        <div class='content'>
                            <p class='py-2'> {{ substr($blog->content, 0, 150).'...' }} </p>
                        </div>
                        <button> <a href="{{ route('blog.show', $blog->id) }}"> Read more >> </a></button>
                    </div>
                    @endforeach

                @else
                <?php echo "<h3 style='color: red; font-family: cursive; margin-top: 30px;'>"."You have no blogs yet"."</h3>" ?>

                @endif


            </div>
        </main>

@endsection
