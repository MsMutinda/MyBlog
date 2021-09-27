<!DOCTYPE html>
<html lang="en">
<!-- header here-->
@include('includes.header')


<body style="padding-top: 2rem;">
    <div class="container">
    @yield('content')
    </div>
    <!--scripts here-->
    @include('includes.scripts')
</body>
<html>
