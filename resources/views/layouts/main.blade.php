<!DOCTYPE html>
<html lang="en">

<!-- header here-->
@include('includes.header')

<!-- Sweet alert -->
@include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])

<body>
    <nav class='navbar fixed-top'>    
        <a href="/" class='nav__logo float-left'>
            Julie's blog
        </a>

        <div class="nav__menucontainer">
            <div class="nav__listcontainer" tabindex="0">
                @guest
                <ul class="nav__menu" id="navmenu">
                    <li class="nav__item"><a href="/">Home</a></li>
                    <li class="nav__item">
                        <select class="nav-select" onchange="location = this.value;"> 
                            <option value="Blog Categories"> Blog Categories </option>
                                @foreach($categories as $category)
                                    <option id="category" value="{{ url('/blogs/'.$category->id.'/'.Str::slug($category->name)) }}"> <a href="{{ url('/blogs/'.$category->id.'/'.Str::slug($category->name)) }}" class="nav__link" onclick="submitter({{ $category->id, $category->name }})" value="{{ $category->id }}"> {{ $category->name }} </a></option>
                                @endforeach
                        </select>
                    </li>
                    <li class="nav__item"><a href="{{ route('register')}}">Register </a> <b style="color: #000; font-weight: 700;"> / </b>
                    <a href="{{ route('login') }}"> Login </a></li>
                    <li class="nav__item"> 
                        <ul class="float-right"> 
                            <li> <a href=""> Subscribe to my newsletter </a> </li>
                            <li title="Toggle dark mode"> Dark mode <i class="fa fa-toggle-off"></i> </li>
                            <li title="Toggle dark mode" style="display: none;"> Light mode <i class="fa fa-toggle-on"></i> </li>
                        </ul>
                    </li>
                </ul>
                @endguest

                @auth
                <ul class="nav__menu" id="navmenu">
                    <li class="nav__item"><a href="/">Home</a></li>
                    <li class="nav__item">
                        <select class="nav-select" onchange="location = this.value;"> 
                            <option value="">Blogs </option>
                            @if(Auth::user()->can('create-blog')) <option value="{{ route('create-blog') }}" > Create blog </option> @endif  
                            <option value="{{ route('viewAllBlogs') }}"> View All Blogs </option>
                            @if(Auth::user()->can('view-archivedBlogs')) <option value="{{ route('viewBlogArchives') }}"> View Archived </option> @endif
                        </select>
                    </li>
                    <li class="nav__item"><a href="">Sign out </a></li>
                    <li class="nav__item"> 
                        <ul class="float-right"> 
                            <li> <a href=""> Subscribe to my newsletter </a> </li>
                            <li> Dark mode <i class="fa fa-toggle-off"></i> </li>
                            <li style="display: none;"> Light mode <i class="fa fa-toggle-on"></i> </li>
                        </ul>
                    </li>
                </ul>
                @endauth

                <a id="hamburger" href="#navmenu" title="menu" class="nav__hamburger">
                    <i class="fa fa-bars ham ml-2 mr-3"></i> 
                    <p class="ml-2 mb-1" style="position: relative; bottom: 3px; right: 10px; font-weight: 700; "> Menu </p>
                </a>
            </div>
            <a href="#!" title="close menu" class="nav__hamburgerclose"><i class="fa fa-2x fa-times-circle text-danger"></i></a>
        </div>

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
