<?php
    $themeClass = '';
    if (empty($_COOKIE['theme'])) {
        $themeClass = 'light-theme';
    }
    else if ($_COOKIE['theme'] == 'dark') {
        $themeClass = 'dark-theme';
    }
    else {
        $themeClass = 'light-theme';
    }
?>

<!DOCTYPE html>
<html lang="en">

<!-- header here-->
@include('includes.header')

<!-- Sweet alert -->
@include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])

<!-- Newsletter form -->
@include('pages.blogs.newsletterform')

<!-- <body class="light-theme || dark-theme"> -->
<body class="<?php echo $themeClass; ?>">
    <nav class='navbar fixed-top'>    
        <a href="/" class='float-left'>
            Blogger.com
            <!-- <img src="{{ asset('storage/logo.png') }}" alt="logo" width="120px" height="120px"> -->
        </a>

        <div class="nav__menucontainer">
            <div class="nav__listcontainer" tabindex="0">
                @guest
                <ul class="nav__menu" id="navmenu">
                    <li class="nav__item"><a href="/">Home</a></li>
                    <li class="nav__item">
                        <select class="nav-select guest" onchange="location = this.value;"> 
                            <option value="Blog Categories"> Explore </option>
                                @foreach($categories as $category)
                                    <option id="category" value="{{ url('/categories/'.$category->id.'/'.Str::slug($category->name)) }}"> <a href="{{ url('/categories/'.$category->id.'/'.Str::slug($category->name)) }}" class="nav__link" onclick="submitter({{ $category->id, $category->name }})" value="{{ $category->id }}"> {{ $category->name }} </a></option>
                                @endforeach
                        </select>
                    </li>
                    <li class="nav__item"><a href="{{ route('register')}}">Register/ </a>
                                            <a href="{{ route('login') }}"> Login </a>
                    </li>
                    @include('pages.blogs.newsletterform')
                    <li class="nav__item"> 
                        <ul class="float-right">
                            <li data-toggle="modal" data-target="#newsletterModal" style="cursor: pointer;"> Subscribe to my newsletter </li>
                            <li class="btn-toggle" onclick="toggleTheme()" style="cursor: pointer;" title="Toggle dark/light mode"> Change theme <i id="toggle-icon" class="fa fa-toggle-off || fa fa-toggle-on"></i> </li>
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
                            @if(Auth::user()->can('store-blog')) <option value="{{ route('save-blog') }}" > Create blog </option> @endif  
                            <option value="{{ route('viewAllBlogs') }}"> View All Blogs </option>
                            @if(Auth::user()->can('view-archivedBlogs')) <option value="{{ route('viewBlogArchives') }}"> View Archived Blogs </option> @endif
                        </select>
                    </li>
                    <li class="nav__item"><a href="{{ route('logout') }}">Sign out </a></li>
                    <li class="nav__item"> 
                        <ul class="float-right">
                            <li class="mb-1" data-toggle="modal" data-target="#newsletterModal" style="cursor: pointer;"> Subscribe to my newsletter </li>
                            <li class="btn-toggle" onclick="toggleTheme()" style="cursor: pointer;" title="Toggle light/dark mode"> Switch theme <i class="fa fa-toggle-on || fa fa-toggle-off"> </i> </li>
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
        <div class="row">
            <!-- Create blog modal -->
            @include('pages.blogs.create')
            <div class="notification-top-bar"> <p data-toggle="modal" data-target="#createBlogModal"> Want to contribute an article to our blog? Click <small> <span> here </span></small> </p></div>

            <div class="blue-bg">
                <div class="featured">
                    <div class="row white-bg">
                        <div class="col-lg-4 col-sm-4"> 
                            <img
                                src = "{{ asset('storage/'.substr($featuredblog->image_path, 7)) }}"
                                title = "{{ $featuredblog->title }}"
                                alt = "{{ $featuredblog->title }} img"
                            />
                        </div>

                        <div class="col-lg-8 col-sm-8">
                            <div class='card'>
                                <div class="card-body">
                                    <h2 class="card-title"> <a href="{{ route('view-blog', $featuredblog->id) }}"> {{ $featuredblog->title }} </a> </h2>
                                    @php 
                                        $category = \App\Models\Blog::where('id', $featuredblog->id)->pluck('category');
                                        $categoryname = \App\Models\Category::where('id', $category)->pluck('name');
                                    @endphp
                                    <small>
                                        <span> {{ $featuredblog->created_at->format('M d, Y') }} &nbsp; {{ $featuredblog->created_at->format('H:i A') }}  &nbsp; · &nbsp; 
                                            @php
                                                $blog_content = \App\Models\Blog::where('id', $featuredblog->id)->get('content');
                                                $wpm = 200;
                                                $wordCount = str_word_count(strip_tags($blog_content));
                                                $minute_count = (int) floor($wordCount / $wpm); 
                                                $seconds_count = (int) floor($wordCount % $wpm / ($wpm / 60));                                            
                                                $minutes = ($minute_count === 0) ? $seconds_count : $minute_count;
                                                if ($minute_count === 0) {
                                                    echo $seconds_count.'-sec';
                                                }
                                                else {
                                                    echo $minute_count.'-min';
                                                }
                                            @endphp
                                            read &nbsp; · &nbsp; 
                                        </span>
                                        <span class="btn btn-sm"> {{ substr($categoryname, 2, -2) }}  </span>
                                    </small>
                                </div>

                                <div class="card-body">
                                    <div class='card-text'>
                                        <p class="text-justify"> {{ substr(strip_tags($featuredblog->content), 0, 600).'...' }} </p>
                                    </div>
                                    <p> <a href="{{ route('view-blog', $featuredblog->id) }}"> <b> READ MORE <i class="fa fa-angle-double-right pl-1" style="font-size: 17px;"></i> </b> </a> </p>    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        @yield('content')
    </div>


    <section class="row footer1">
        <div class="col-lg-4 col-sm-3">
            <a href="/">
                Blogger.com
            </a>
            <p>A blogging platform where tech professionals share on their tech experiences, how-to's, and everything else tech.</p>
            <p> <a href=""> &copy; {{ date('Y')}}. &nbsp; All rights reserved.  </a> </p>
        </div>
        <div class="links col-lg-2 col-sm-3">
            <ul> <p> Explore </p>
                <li><a href=""> Trending blogs</a></li>
                <li> <a href="#"> Faqs</a></li>
                <li><a href="#"> About </a></li>
            </ul>
        </div>
        
        <div class="links col-lg-2 col-sm-3"> 
            <ul> <p> Social Media  </p>
                <li><a href="">Github</a></li>
                <li> <a href="">Linkedin</a></li>
                <li><a href="">Twitter </a></li>
            </ul>
        </div>
        <div class="links col-lg-2 col-sm-3">
            <ul> <p> Legal </p>
                <li> <a href="#">Privacy Policy</a></li>
                <li><a href="#">Terms & Conditions </a></li>
                <li><a href="#">SLAs</a></li>
            </ul>
        </div>
        <div class="links col-lg-2 col-sm-3">
            <ul><p>Contact</p>
                <li><a href="#">Nairobi, Kenya</a></li>
                <li> <a href="#">info@myblog.com</a></li>
                <li><a href="#">(+254) 020 123 4567 </a></li>
            </ul>
        </div>
    </section>


    <!--scripts here-->
    @include('includes.scripts')
    
</body>
<html>
