<!DOCTYPE html>
<html lang="en">
<!-- header here-->
@include('includes.header')


<body>
    <nav class='navbar navbar-light fixed-top'>    
        <a href="/" class='navbar-brand'>
            <!-- <img src="" style="max-height: 50px"> -->
            My Blog
        </a>

        <ul class='nav-right'>
            <li><a href="/">Home</a></li>
            <li><a href="{{ route('profile') }}">Profile</a></li>
            <!-- Maybe add featured posts later -->
            <li> <a href="{{ route('blog.showArchives') }}"> Archives </a> </li>
            <li><a href="{{ route('logout') }}" onclick="return confirm('You are about to log out, continue?');"> Sign out <i class='ml-2 fa fa-sign-out'></i> </a></li>
        </ul>
    </nav><br><br>

    <div class="container-fluid">
    @yield('content')
    </div>
    <!--scripts here-->
    @include('includes.scripts')
</body>
<html>
