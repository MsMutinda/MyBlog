@extends('layouts.main')

@section('content')
    <div class="content-header" style="margin-left: 10px;">
        <div class="row mb-2">
            <ul class="breadcrumb float-sm-left ml-1">
                <li class="breadcrumb-item"><a href="{{url('/')}}" style="color: #000;"><i class="fa fa-home"></i></a></li>
                <li class="breadcrumb-item active"><a href="{{url('/')}}" style="color: #000;">Home</a></li>
                <li class="breadcrumb-item" style="color: #000;">Archives</li>
            </ul>
        </div>
    </div>

    <main role="main" style="margin: 0 auto;">

        <div class="archived-blogs">
            <div class="row"> 
                <div class="col-lg-12 col-sm-12"> 
                    <h2 style="font-weight: bolder;"> Archived blogs </h2>
                </div>
            </div>

            <div class="row">
                @if(count($archived) > 0)
                    @foreach($archived as $a)
                    <div class='card col-lg-5 col-sm-5'>
                        <img
                            src="{{ asset('storage/'.substr($a->image_path, 7)) }}"
                            class="card-img-top"
                            title="{{ $a->title }} image"
                            alt="{{ $a->title }} img"
                        />
                        <div class="card-body">
                            <p class="btn btn2 px-4">
                                <?php 
                                    $blogCategory = \App\Models\Category::where('id' , '=', $a->category)->pluck('name');
                                    echo substr($blogCategory, 2, -2);
                                ?> 
                            </p>
                            <h5 class="card-title"><strong> {{ $a->title }} </strong></h5>
                            <div class='card-text mt-2'>
                                <p> {{ substr($a->content, 0, 330).'...' }} </p>
                            </div>

                            <small>
                                <span class="float-left">
                                    <img src="" alt=""> By {{ $a->author }}
                                </span>
                            </small>
                            <small>
                                <span class="float-right"> {{ $a->created_at->format('d M, Y') }} </p>
                                </span>
                            </small>
                        </div>

                        <p class="readMore"> <b><a style="color: #f27a1f" href="{{ route('view-blog', $a->id) }}"> Read more </b></a> <i class="fa fa-arrow-right"></i> </p>

                    </div>
                    
                    @endforeach
                @else
                    <?php echo "<h4 class='ml-4 mt-4' style='color: red; font-family: cursive;'>"."No blogs here yet."."</h4>" ?>
                @endif
            </div>

        </div>
    
    </main>

@endsection