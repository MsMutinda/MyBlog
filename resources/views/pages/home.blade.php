@extends('layouts.main')

@section('content')

    
        <form class="form-inline mt-4 pt-5">
            <input class="form-control mr-sm-2" type="text" placeholder="Find post" aria-label="Search">
            <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
        </form>


    <main role="main" class="container">

        <div style="padding: 3rem 0.2rem;">
            <h3><strong> Post 1 </strong></h3>
            <p>Content here</p>
        </div>

    </main>
        
@endsection
