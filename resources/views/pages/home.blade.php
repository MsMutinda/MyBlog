@extends('layouts.main')

@section('content')

    <div class=''>
        <form class="form-inline my-1 pt-5 mx-2">
            <input class="form-control mr-sm-2" type="text" placeholder="Find blog" aria-label="Search">
            <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
        </form>


        <main role="main" class="container-fluid mx-3">
            <div class='row'>
                <div class='col-lg-3 col-sm-3 mr-5' style="padding: 2rem 0rem;">
                    <h3><strong>   Blog 1 </strong></h3>
                    <span class="header-sub">Created by <b> **author 1 name here**</b></span>
                    <div class='content'>
                        <p class='py-2'>
                        Lorem ipsum dolor sit amet, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Scelerisque varius morbi enim nunc faucibus a. Et malesuada fames ac turpis egestas.
                        </p>
                        <button>Read more >></button>
                    </div>
                </div>

                <div class='col-lg-3 col-sm-3 mr-5' style="padding: 2rem 0rem;">
                    <h3><strong> Blog 2 </strong></h3>
                    <!-- <h1 class="header-title">Laravel Blog</h1> -->
                    <span class="header-sub">Created by <b> **author 2 name here**</b></span>
                    <div class='content'>
                        <p class='py-2'>
                        Viverra ipsum nunc aliquet bibendum enim facilisis gravida. Nisi quis eleifend quam adipiscing vitae proin sagittis nisl. Lectus magna fringilla urna porttitor rhoncus dolor purus non enim.
                        </p>
                        <button>Read more >></button>
                    </div>
                </div>

                <div class='col-lg-3 col-sm-3 mr-5' style="padding: 2rem 0rem;">
                    <h3><strong> Blog 3 </strong></h3>
                    <!-- <h1 class="header-title">Laravel Blog</h1> -->
                    <span class="header-sub">Created by <b> **author 3 name here**</b></span>
                    <div class='content'>
                        <p class='py-2'>
                        Pharetra vel turpis nunc eget. Vulputate enim nulla aliquet porttitor lacus. Tellus elementum sagittis vitae et leo duis ut diam quam. Faucibus nisl tincidunt eget nullam non nisi est sit. In massa tempor nec feugiat.
                        </p>
                        <button>Read more >></button>
                    </div>
                </div>

                <div class='col-lg-3 col-sm-3 mr-5' style="padding: 2rem 0rem;">
                    <h3><strong> Blog 4 </strong></h3>
                    <!-- <h1 class="header-title">Laravel Blog</h1> -->
                    <span class="header-sub">Created by <b> **author 4 name here**</b></span>
                    <div class='content'>
                        <p class='py-2'>
                        Urna molestie at elementum eu facilisis. Nibh praesent tristique magna sit amet purus gravida. Sit amet justo donec enim diam vulputate ut. Semper risus in hendrerit gravida rutrum quisque non tellus orci.
                        </p>
                        <button>Read more >></button>
                    </div>
                </div>

                <div class='col-lg-3 col-sm-3 mr-5' style="padding: 2rem 0rem;">
                    <h3><strong> Blog 5 </strong></h3>
                    <!-- <h1 class="header-title">Laravel Blog</h1> -->
                    <span class="header-sub">Created by <b> **author 5 name here**</b></span>
                    <div class='content'>
                        <p class='py-2'>
                        Imperdiet nulla malesuada pellentesque elit eget gravida cum sociis. Mauris sit amet massa vitae tortor. Morbi leo urna molestie at. Volutpat sed cras ornare arcu dui vivamus arcu. Massa tempor nec feugiat nisl pretium fusce.
                        </p>
                        <button>Read more >></button>
                    </div>
                </div>

            </div>
        </main>
    </div>
        
@endsection
