@extends('layouts.main')

@section('content')
    <style>
        .button {
            background-color: #4B6F44;
            border-radius: 5px;

        }
        .button:hover {
            background-color: #ACE1AF;

        }
        .posts, .profile, .bio {
            font-weight: 800;
        }
        .avatar-details {
            list-style-type: none;
            position: relative;
            right: 23px;
        }
        img {
            position: relative;
            left: 35px;
        }
        a:hover {
            color: #000;
            text-decoration: none;
        }
    </style>

    <section>
        <div class='container card shadow-md p-3'>
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
                    <ul>
                        <li> Blog #1 </li>
                        <li> Blog #2 </li>
                        <li> Blog #3 </li>
                        <li> etc etc.. </li>
                    </ul>
                </div>
            </div><br>

            <div class='row ml-2'>
                <div class='col-lg-5 col-sm-6'>
                    <h4 class='bio'>Bio Information</h4>
                    <ul>
                        <li> <strong> Email address: </strong> {{ Auth::user()->email }} </li>
                        <li> <strong> Phone Number: </strong> {{ Auth::user()->phone }} </li>
                        <li> <strong> Hobbies: </strong> </li>
                        <li> <strong> Number of blogs authored so far: </strong> </li>
                        <li> <strong> Topics i'm interested in: </strong></li>
                    </ul>
                    <!-- loads a modal form when clicked -->
                    <button class='button p-1 mt-3'><a href="{{ route('profile-edit') }}"> Edit profile </a></button>
                </div>
            </div>
        </div>
    </section>

@endsection