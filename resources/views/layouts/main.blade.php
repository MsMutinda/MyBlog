<!DOCTYPE html>
<html lang="en">
<!-- header here-->
@include('includes.header')


<body>
    <nav class='navbar fixed-top'>    
        <a href="/" class='navbar-brand' style="font-size: 24px; font-family: cursive;">
            Blogger
        </a>

        <ul class='nav-right'>
            <li><a href="/">Home</a></li>
            <li><a href="{{ route('profile') }}">Profile</a></li>
            <li>
                <select class="nav-select" onchange="location = this.value;">
                    <option value="">Blogs</option>
                    <option value="{{ route('blog.create') }}" > Add New </option>
                    <option value="{{ route('blog.showArchives') }}"> Archived </option>
                </select>
            </li>
            <li><a href="{{ route('logout') }}" onclick="return confirm('You are about to log out, continue?');"> Sign out <i class='ml-2 fa fa-sign-out'></i> </a></li>
        </ul>
    </nav>

    <div class="nav">
            <div class="nav__menucontainer">
                <div class="nav__listcontainer" tabindex="0">
                    <ul class="nav__menu" id="navmenu">
                        <li class="nav__item" style="font-weight: 700;">Read about:</li>
                        <?php 
                            $categories = \App\Models\Category::all()
                        ?>
                            @foreach($categories as $category)
                                <li class="nav__item" id="category" value="{{ $category->id }}"> <a href="{{ url('/categories/'.Str::slug($category->name)) }}" class="nav__link" onclick="submitter({{ $category->id }})" value="{{ $category->id }}"> {{ $category->name }} </a></li>
                            @endforeach
                    </ul>
                    <a id="hamburger" href="#navmenu" title="menu" class="nav__hamburger">
                        <i class="fa fa-bars ham ml-2"></i> <p class="ml-2 mb-1" style="position: relative; bottom: 3px; font-weight: 700; "> Blog categories </p>
                    </a>
                </div>
                <a href="#!" title="close menu" class="nav__hamburgerclose"><i class="fa fa-2x fa-times-circle"></i></a>
            </div>
        </div>
    
    <div class="container-fluid">
    @yield('content')
    </div>

    <!--scripts here-->
    @include('includes.scripts')
    
</body>
<html>
