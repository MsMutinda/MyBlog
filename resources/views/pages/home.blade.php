@extends('layouts.main')

@section('content')

    <nav class='navbar navbar-light fixed-top'>    
        <a href="#" class='navbar-brand'>
            <!-- <img src="" style="max-height: 50px"> -->
            {{ $website }}
        </a>

        <ul class='nav-right'>
            <li><a href="/">Home</a></li>
            <li><a href="profile">Profile</a></li>
            <li><a href="#">Featured Posts</a></li>
            <li>
                <div class='dropdown-menu'>
                    <button class='dot'></button>
                    <div class='dropdown-content'>
                        <a href='#'><---></a>
                        <a href='#'>View profile</a>
                        <a href='#'>Account settings</a>
                        <a href='#'>Logout</a>
                    </div>
                </div>
            </li>
        </ul>
    </nav>
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
