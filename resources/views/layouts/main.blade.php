<!DOCTYPE html>
<html lang="en">
<!-- header here-->
@include('includes.header')

<body>
    <?php 
        $categories = \App\Models\Category::all()
    ?>
    <nav class='navbar fixed-top'>    
        <a href="/" class='float-left'>
            <img src="https://zalegoacademy.ac.ke/asset/img/zalegocurrentlogo.png" class="logo size-lg pl-3" title="Zaleg Logo" alt="zalegocurrentlogo">
            <p>Invest In Thyself!</p>
        </a>

        <ul>
            <!-- Authenticated user -->
            @auth
                <li><a href="/">Home</a></li>
                <!-- <li><a href="{{ route('view-profile') }}">Profile</a></li> -->
                <li>
                    <select class="nav-select" onchange="location = this.value;">
                        <option value="">Blog</option>
                        <option value="{{ route('create-blog') }}" > Create blog </option>
                        <option value="{{ route('viewBlogArchives') }}"> Archived </option>
                    </select>
                </li>
                <li><a href="{{ route('logout') }}" onclick="return confirm('You are about to log out, continue?');"> Sign out <i class='ml-2 fa fa-sign-out'></i> </a></li>
            @endauth
            <!-- Guest users -->
            @guest
                <li><a href="/">Home</a></li>
                <li>
                    <select class="nav-select" onchange="location = this.value;"> 
                        <option value="Blog Categories"> Blog Categories </option>
                            @foreach($categories as $category)
                                <option class="nav__item" id="category" value="{{ $category->id }}"> <a href="{{ url('/blogs/'.Str::slug($category->name)) }}" class="nav__link" onclick="submitter({{ $category->id }})" value="{{ $category->id }}"> {{ $category->name }} </a></li>
                            @endforeach
                    </select>
                </li>
                <!-- <li> <a href=""> <i class="fa fa-bell"></i> </a> </li> -->
                <li> <a href="{{ route('register') }}"> Register </a> </li>
                <li><a href="{{ route('login') }}"> Sign in </a></li>
            @endguest
        </ul>

        <div class="float-right">
            <ul>
                <li>Sign in</li>
                <li class="btn px-4 py-2">Try for free</li>
            </ul>
        </div>
    </nav>

    <!-- <div class="nav">
            <div class="nav__menucontainer">
                <div class="nav__listcontainer" tabindex="0">
                    <ul class="nav__menu" id="navmenu">
                        <li class="nav__item" style="font-weight: 700;">Read about:</li>
                        <?php 
                            $categories = \App\Models\Category::all()
                        ?>
                            @foreach($categories as $category)
                                <li class="nav__item" id="category" value="{{ $category->id }}"> <a href="{{ url('/blogs/'.Str::slug($category->name)) }}" class="nav__link" onclick="submitter({{ $category->id }})" value="{{ $category->id }}"> {{ $category->name }} </a></li>
                            @endforeach
                    </ul>
                    <a id="hamburger" href="#navmenu" title="menu" class="nav__hamburger">
                        <i class="fa fa-bars ham ml-2"></i> <p class="ml-2 mb-1" style="position: relative; bottom: 3px; font-weight: 700; "> Blog categories </p>
                    </a>
                </div>
                <a href="#!" title="close menu" class="nav__hamburgerclose"><i class="fa fa-2x fa-times-circle"></i></a>
            </div>
        </div> -->
    
    <div class="container-fluid">
    @yield('content')
    </div>

    <!--scripts here-->
    @include('includes.scripts')
    
</body>
<html>
