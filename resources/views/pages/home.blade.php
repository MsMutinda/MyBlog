@extends('layouts.main')

@section('content')

    <main role="main" class="main">
        
        <div class="row"> 
            <div class="about col-lg-12 col-sm-12"> 
                <h2> Juliet Mutinda </h2>
                <!-- <img src="" alt="" class="float-right"> -->
                <!-- <span class="float-right rounded-circle bg-warning text-center text-white px-4 py-3">
                    <strong>
                        <?php
                        $str='Juliet';
                        echo strtoupper($str[0]);
                        ?>
                    </strong>
                </span> -->
                <p> Intern Laravel Developer | Technical Writer </p>
                <hr />
            </div>
        </div>

        <div class="row"> 
            <div class="latestheader col-lg-12 col-sm-12"> 
                <h2>Published blogs </h2>
                <hr />
            </div>
        </div>
        

        <div class="latest">
            <div class="row">
                @if(\App\Models\Blog::count() > 0)
                    @foreach($blogs as $blog)
                        <div class="col-lg-7 col-sm-7">
                            <div class='card'>
                                <div class="card-body">
                                    <h4 class="card-title"><strong> {{ $blog->title }} </strong></h4>
                                    <small class="mt-1"> <img src="" alt=""> By {{ $blog->author }} </small>
                                    <small class="mt-1">
                                        <span class="float-right"> {{ $blog->created_at->format('d M, Y') }} {{ $blog->created_at->format('h:i A') }} </p>
                                        </span>
                                    </small>
                                </div>

                                <div class="card-body">
                                    <div class='card-text'>
                                        <p> {{ substr($blog->content, 0, 200).'...' }} </p>
                                    </div>
                                    <!-- Newsletter modal button trigger -->
                                    <p class="btn btn-sm"> <b><a href="{{ route('view-blog', $blog->id) }}" data-toggle="modal" data-target="#newsletterModal" style="color: #fff;"> Read blog </a></b> </p>    
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-5 col-sm-5 float-right">
                            <img
                                src="{{ asset('storage/'.substr($blog->image_path, 7)) }}"
                                class="card-img-top"
                                title="{{ $blog->title }} image"
                                alt="{{ $blog->title }} img"
                            />
                        </div>

                    @endforeach
                @else
                    @php echo "<h4 class='ml-4 mt-4' style='color: red; font-family: cursive;'>"."No blogs here yet."."</h4>" @endphp
                @endif
            </div>
        </div>


        <!-- Modal -->
        <div class="modal fade" id="newsletterModal" tabindex="-1" role="dialog" aria-labelledby="newsletterModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newsletterModalLabel"> Newsletter form </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('save-subscriber') }}" method="post" id="newsletter-form">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" placeholder="Please enter your name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" name="email" class="form-control" aria-describedby="emailHelp" placeholder="Enter your email address" required>
                        </div>
                        <small id="emailHelp" class="form-text text-muted">We promise to only send you the best.</small>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success" name="submit" form="newsletter-form">Save changes</button>
                </div>
                </div>
            </div>
        </div>
        <!-- End of modal -->

    </main>


    <script type='text/javascript'>

        function submitter(value, name) {
            console.log(value)
            $.get("{{ url('blogs/') }}/"+value, function(response){
                return value;
                console.log(response)
            })
        }

    </script>

@endsection
