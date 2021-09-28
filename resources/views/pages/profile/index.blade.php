@extends('layouts.main')

@section('content')
    <section class='mt-5'>
        <div class='card shadow-md p-3'>
            <div class='row'>
                <div class='col-12 pl-3 ml-2 mb-4'>
                    <h3 class='profile mb-2 ml-2'>Profile</h3>
                </div>
            </div>

            <div class='row ml-1'>
                <div class='col-lg-5 col-sm-6'>
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSSRsfOcYt3SR9V9alSN7mg-z2Q_STmrA94q4YJ44JsT62ykMKgahBOIi-7--RiFrY-0N0&usqp=CAU" width='85px;' height='85px;' alt="profile-avatar">
                    <ul class='avatar-details'>
                        <li> <strong> Name: </strong> {{ Auth::user()->fname }} {{ Auth::user()->lname }} </li>
                        <li> <strong> Gender: </strong> {{ Auth::user()->gender }} </li>
                    </ul>
                </div>
                <div class='col-lg-6 col-sm-6 ml-3'>
                    <h4 class='posts'>My Posts</h4>
                    @foreach ($blogs as $blog)
                        <ul>
                            <li> {{ $blog->title }} </li>
                        </ul>
                    @endforeach
                </div>
            </div><br>

            <div class='row ml-2'>
                <div class='col-lg-5 col-sm-6'>
                    <h4 class='bio'>Bio Information</h4>
                    <ul>
                        <li> <strong> Email address: </strong> {{ Auth::user()->email }} </li>
                        <li> <strong> Phone Number: </strong> {{ Auth::user()->phone }} </li>
                        <li> <strong> Hobbies: </strong> {{  Auth::user()->hobbies }} </li>
                        <li> <strong> Number of blogs authored so far: </strong> {{ count($blogs) }} </li>
                        <li> <strong> Topics i'm interested in: </strong></li>
                    </ul>
                    <!-- loads a modal form when clicked -->
                    <button class='button p-1 mt-3'><a href="{{ route('profile-edit') }}"> Edit profile </a></button>
                </div>
            </div>
        </div>
    </section>

@endsection