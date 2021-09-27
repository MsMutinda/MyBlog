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
        .posts, .profile {
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
    </style>

    <section>
        <div class='row'>
            <div class='col-12 card p-1 ml-2 mb-4'>
                <h3 class='profile mb-2 ml-2'>Profile</h3>
            </div>
        </div>

        <div class='row m-2 '>
            <div class='col-lg-4 col-sm-6'>
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSSRsfOcYt3SR9V9alSN7mg-z2Q_STmrA94q4YJ44JsT62ykMKgahBOIi-7--RiFrY-0N0&usqp=CAU" width='85px;' height='85px;' alt="profile-avatar">
                <ul class='avatar-details'>
                    <li> **username here** </li>
                    <li> **email address here** </li>
                    <li> **phone number here** </li>
                </ul>
            </div>
            <div class='col-lg-8 col-sm-6 '>
                <h4>Bio Information</h4>
                <div>
                    <ul>
                        <li> Short summary: </li>
                        <li> Hobbies: </li>
                        <li> Number of blogs authored so far: </li>
                        <li> Topics i'm interested in: </li>
                        <li> **other** </li>
                        <li> **other** </li>
                    </ul>
                    <!-- loads a modal form when clicked -->
                    <button class='button p-1 mt-3'>Edit profile</button>
                </div>
            </div>
        </div><br>

        <div class='row m-2 p-2'>
            <div class='col-lg-5 col-sm-6 ml-3'>
                <h4 class='posts'>My Posts</h4>
                <ul>
                    <li> Blog #1 </li>
                    <li> Blog #2 </li>
                    <li> Blog #3 </li>
                    <li> etc etc.. </li>
                </ul>
            </div>
        </div>

    </section>

@endsection