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
                    <h2 style="font-weight: bolder; margin-bottom: 20px;"> Archived blogs </h2>
                </div>
            </div>

            <div class="row">
                @if(count($archived) > 0)
                <table class="table" id="archives">
                    <thead>
                        <th>#</td>
                        <th>Blog title</th>
                        <th>Category</th>
                        <th>Author</th>
                        <th>Deleted At</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @foreach($archived as $a)    
                        <tr>
                            <td>{{ $a->id }}</td>
                            <td>{{ $a->title }}</td>
                            <td>
                                <?php 
                                    $blogCategory = \App\Models\Category::where('id' , '=', $a->category)->pluck('name');
                                    echo substr($blogCategory, 2, -2);
                                ?>
                            </td>
                            <td>{{ $a->author }}</td>
                            <td>{{ $a->deleted_at }} </td>
                            <td>
                                <center>
                                    <div class="dropdown dropright"><i class="fa fa-ellipsis-v" id="dropdownMenu" data-toggle="dropdown" style="cursor: pointer; position: relative; right: 30px;"></i>
                                        <ul class="dropdown-menu">
                                            <li class="dropdown-item">
                                                <a class="btn" href="{{ url('/blog/$a->id/restore') }}">
                                                    <i class="fa fa-undo"></i>
                                                    Restore
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </center>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                @else
                    <?php echo "<h4 class='ml-4 mt-4' style='color: red; font-family: cursive;'>"."No blogs here yet."."</h4>" ?>
                @endif
            </div>

        </div>
    
    </main>

@endsection