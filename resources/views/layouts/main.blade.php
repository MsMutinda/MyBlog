<!DOCTYPE html>
<html lang="en">
<!-- header here-->
@include('includes.header')

<body>
    <?php 
        $categories = \App\Models\Category::all()
    ?>
    <nav class='navbar fixed-top'>    
        <a href="/" class='nav__logo float-left'>
            <img src="https://zalegoacademy.ac.ke/asset/img/zalegocurrentlogo.png" class="logo size-lg pl-3" title="Zalego Academy Logo" alt="zalegocurrentlogo">
            <p>Invest In Thyself!</p>
        </a>

        <!-- Authenticated user -->
        @auth
        <div class="nav__menucontainer">
            <div class="nav__listcontainer" tabindex="0">
                <ul class="nav__menu auth" id="navmenu">
                    <li class="nav__item"><a href="/">Home</a></li>
                    <li class="nav__item"><a href="{{ route('view-profile') }}">Profile</a></li>
                    <!-- @role('Manager') -->
                    <li class="nav__item">
                        <select class="nav-select" onchange="location = this.value;">
                            <option value="">Blogs </option>
                            <option value="{{ route('create-blog') }}" > Create blog </option>
                            <option value="{{ route('viewBlogArchives') }}"> Archived </option>
                        </select>
                    </li>
                    <!-- @endrole -->
                    <li class="nav__item"> <a href=""> Courses </a> </li>
                    <li class="nav__item"><a href=""> Programs </a></li>
                    <li class="nav__item float-right ml-5 pl-5"> 
                        <ul style="padding: 0;">
                            <li><a href="{{ route('logout') }}" onclick="return confirm('You are about to log out, continue?');"> Sign out <i class='ml-2 fa fa-sign-out'></i> </a></li>
                        </ul>
                    </li>  
                <ul> 
                <a id="hamburger" href="#navmenu" title="menu" class="nav__hamburger">
                    <i class="fa fa-bars ham ml-2"></i> <p class="ml-2 mb-1" style="position: relative; bottom: 3px; font-weight: 700; "> Blog categories </p>
                </a>
            </div>
            <a href="#!" title="close menu" class="nav__hamburgerclose"><i class="fa fa-2x fa-times-circle"></i></a>
        </div>
        @endauth
        
        <!-- Guest users -->
        @guest
        <div class="nav__menucontainer">
            <div class="nav__listcontainer" tabindex="0">
                <ul class="nav__menu guest" id="navmenu">
                    <li class="nav__item"><a href="/">Home</a></li>
                    <li class="nav__item">
                        <select class="nav-select" onchange="location = this.value;"> 
                            <option value=""> Blog Categories </option>
                                @foreach($categories as $category)
                                    <option class="" id="category" value="{{ $category->id }}"> <a href="{{ url('/blogs/'.Str::slug($category->name)) }}" class="nav__link" onclick="submitter({{ $category->id }})" value="{{ $category->id }}"> {{ $category->name }} </a></li>
                                @endforeach
                        </select>
                    </li>
                    <li class="nav__item"> <a href=""> Courses </a> </li>
                    <li class="nav__item"><a href=""> Programs </a></li>
                    <li class="nav__item float-right ml-5 pl-5"> 
                        <ul style="padding: 0;">
                            <li style="position: relative; bottom: 10px;"><a href="{{ route('login') }}">Sign in </a></li>
                            <li class="btn px-4 py-2" style="position: relative; bottom: 10px;"> <a href="{{ route('register') }}" class="text-white"> Try for free </a> </li>
                        </ul>
                    </li>
                </ul>
                <a id="hamburger" href="#navmenu" title="menu" class="nav__hamburger">
                    <i class="fa fa-bars ham ml-2"></i> <p class="ml-2 mb-1" style="position: relative; bottom: 3px; font-weight: 700; "> Blog categories </p>
                </a>
            </div>
            <a href="#!" title="close menu" class="nav__hamburgerclose"><i class="fa fa-2x fa-times-circle"></i></a>
        </div>
        @endguest
    </nav>
    
    <div class="container-fluid">
    @yield('content')
    </div>

    <!--scripts here-->
    @include('includes.scripts')
    
    <!-- Footer -->
    <!-- @include('includes.footer') -->
</body>
<html>
