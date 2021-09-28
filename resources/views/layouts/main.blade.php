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
            <li><a href="profile">Profile</a></li>
            <!-- Maybe add featured posts later -->
            <li><a href="blog">Blogs</a></li>
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
    </nav><br><br>

    <div class="container-fluid">
    @yield('content')
    </div>
    <!--scripts here-->
    @include('includes.scripts')
</body>
<html>
