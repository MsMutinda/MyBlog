<!DOCTYPE html>
<html lang="en">
<!-- header here-->
@include('includes.header')


<body>
    <nav class='navbar navbar-light fixed-top'>    
        <a href="/" class='navbar-brand'>
            My Blog
        </a>

        <ul class='nav-right'>
            <li><a href="/">Home</a></li>
            <li><a href="{{ route('profile') }}">Profile</a></li>
            <li> 
                <select class="nav-select" onchange="location = this.value;">
                    <option value="">Blogs</option>
                    <option value="{{ route('blog.create') }}"> Add New </option>
                    <option value="{{ route('blog.showArchives') }}"> Archived </option>
                </select>
            </li>
            <li><a href="{{ route('logout') }}" onclick="return confirm('You are about to log out, continue?');"> Sign out <i class='ml-2 fa fa-sign-out'></i> </a></li>
        </ul>
    </nav><br><br>

    <div class="container-fluid">
        <!-- Maybe add featured posts later -->
    @yield('content')
    </div>
    <!--scripts here-->
    @include('includes.scripts')
</body>
<html>
