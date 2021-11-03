<!DOCTYPE html>
<html lang="en">
<!-- header here-->
@include('includes.header')

<body>

    <?php 
        $categories = \App\Models\Category::all();
        // $filtered = Blog::where('category', $id)->get();
    ?>
    <nav class='navbar fixed-top'>    
        <a href="/" class='nav__logo float-left'>
            <img src="https://zalegoacademy.ac.ke/asset/img/zalegocurrentlogo.png" class="logo size-lg" title="Zalego Academy Logo" alt="zalegocurrentlogo">
            <p>Invest In Thyself!</p>
        </a>

        <!-- Authenticated user menu -->
        @auth
        <div class="nav__menucontainer">
            <div class="nav__listcontainer" tabindex="0">
                <ul class="nav__menu auth" id="navmenu">
                    <li class="nav__item"><a href="/">Home</a></li>
                    <!-- @role('Manager') -->
                        <li class="nav__item">
                            <select class="nav-select" style="width: 100px;" onchange="location = this.value;">
                                <option value="">Blogs </option>
                                @if(Auth::user()->can('create-blog')) <option value="{{ route('create-blog') }}" > Create blog </option> @endif  
                                <option value="{{ route('viewAllBlogs') }}"> View All Blogs </option>
                                @if(Auth::user()->can('view-archivedBlogs')) <option value="{{ route('viewBlogArchives') }}"> View Archived </option> @endif
                            </select>
                        </li>
                    <!-- @endrole -->
                    <li class="nav__item"> <a href="https://zalegoacademy.ac.ke/courses"> Courses </a> </li>
                    <li class="nav__item"><a href="https://zalegoacademy.ac.ke/programs"> Programs </a></li>
                    <li class="nav__item float-right"> 
                        <ul>
                            <li class="nav__item profile_link"><a href="{{ route('view-profile') }}">Profile</a></li>
                            <li class="nav__item logout_link"><a href="{{ route('logout') }}" onclick="return confirm('You are about to log out, continue?');"> Sign out <i class='ml-2 fa fa-sign-out'></i> </a></li>
                        </ul>
                    </li>  
                <ul> 
                <a id="hamburger" href="#navmenu" title="menu" class="nav__hamburger">
                    <i class="fa fa-bars ham ml-2"></i> <p class="ml-2 mb-1" style="position: relative; bottom: 3px; font-weight: 700; "> Menu </p>
                </a>
            </div>
            <a href="#!" title="close menu" class="nav__hamburgerclose"><i class="fa fa-2x fa-times-circle text-danger"></i></a>
        </div>
        @endauth
        
        <!-- Guest user menu -->
        @guest
        <div class="nav__menucontainer">
            <div class="nav__listcontainer" tabindex="0">
                <ul class="nav__menu guest" id="navmenu">
                    <li class="nav__item"><a href="/">Home</a></li>
                    <!-- <li class="nav__item"><a href="https://zalegoacademy.ac.ke/">Home</a></li> -->
                    <li class="nav__item"><a href=""> Tutors </a> </li>
                    <!-- <li class="nav__item">
                        <select class="nav-select" onchange="location = this.value;"> 
                            <option value="Blog Categories"> Blog Categories </option>
                                @foreach($categories as $category)
                                    <option id="category" value="{{ url('/blogs/'.$category->id.'/'.Str::slug($category->name)) }}"> <a href="{{ url('/blogs/'.$category->id.'/'.Str::slug($category->name)) }}" class="nav__link" onclick="submitter({{ $category->id, $category->name }})" value="{{ $category->id }}"> {{ $category->name }} </a></option>
                                @endforeach
                        </select>
                    </li> -->
                    <li class="nav__item"> <a href="https://zalegoacademy.ac.ke/courses"> Courses </a> </li>
                    <li class="nav__item"><a href="https://zalegoacademy.ac.ke/programs"> Programs </a></li>
                    <li class="nav__item float-right"> 
                        <ul>
                            <li class="nav__item"><a href="{{ route('login') }}">Sign in </a></li>
                            <li class="nav__item btn free"> <a href="{{ route('register') }}" class="text-white"> Try for free </a> </li>
                        </ul>
                    </li>
                </ul>
                <a id="hamburger" href="#navmenu" title="menu" class="nav__hamburger">
                    <i class="fa fa-bars ham ml-2 mr-3"></i> 
                    <p class="ml-2 mb-1" style="position: relative; bottom: 3px; right: 10px; font-weight: 700; "> Menu </p>
                </a>
            </div>
            <a href="#!" title="close menu" class="nav__hamburgerclose"><i class="fa fa-2x fa-times-circle text-danger"></i></a>
        </div>
        @endguest
    </nav>

    
    <div class="container-fluid">
    @yield('content')
    </div>

    <!--scripts here-->
    @include('includes.scripts')
    
    <!-- Footer -->
    @include('includes.footer')
</body>
<html>
