@extends('layouts.main')

@section('content')
    <main class="main p-2">
        <div class='ml-2'>
            <div class='row'> <h3 class='profile mx-2'> Profile</h3> </div>
            <div class='row py-2'>
                <div class='col-lg-6 col-sm-6'>
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSSRsfOcYt3SR9V9alSN7mg-z2Q_STmrA94q4YJ44JsT62ykMKgahBOIi-7--RiFrY-0N0&usqp=CAU" class="p-1" width='185px;' height='180px;' alt="profile-avatar">
                    <ul class='avatar-details'>
                        <li> <strong> Name: </strong> {{ Auth::user()->fname }} {{ Auth::user()->lname }} </li>
                        <li> <strong> Role: </strong> 
                            <?php
                                $userrole = \App\Models\Role::where('id', '=', Auth::user()->role_id)->pluck('name');
                                echo substr($userrole, 2, -2);                            
                            ?>
                        </li>
                        <li> <strong> Gender: </strong> {{ Auth::user()->gender }} </li>
                    </ul>
                </div>

                <?php 
                    $myblogs = \App\Models\Blog::where('author' , '=', Auth::user()->fname)->get();
                    $total = count($myblogs);
                ?> 
                <div class='col-lg-6 col-sm-6'>
                    <h4 class='posts'>My Posts</h4>
                    @if(count($myblogs)>0)
                        @foreach ($myblogs as $myblog)
                            <ul>
                                <li> {{ $myblog->title }} </li>
                            </ul>
                        @endforeach
                    @else
                    <h6 style="color: #568203;" class="pt-2">You have no existing blogs at this time.</h6>
                    @endif
                </div>
            </div>
            <hr />

            <div class='row'>
                <div class='mt-3 col-lg-6 col-sm-6'>
                    <h4 class='bio'>Bio Information</h4>
                    <ul>
                        <li> <strong> Email address: </strong> {{ Auth::user()->email }} </li>
                        <li> <strong> Phone Number: </strong> {{ Auth::user()->phone }} </li>
                        <li> <strong> Hobbies: </strong> {{  Auth::user()->hobbies }} </li>
                        <li> <strong> Number of blogs authored so far: </strong> 
                            {{$total}}
                        </li>
                        <li> <strong> Topics i'm interested in: </strong> Reading, Travelling, and Anything involving fun and games </li>
                    </ul>
                    <!-- loads a modal form when clicked -->
                    <button class='button p-1 my-3'><a class="text-white" href="{{ route('edit-profile') }}" data-toggle="modal" data-target="#profileEdit"> Edit profile </a></button>
                </div>
            </div>
        </div>
    </section>

@endsection