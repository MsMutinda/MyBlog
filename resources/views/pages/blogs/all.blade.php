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
                    <h2 style="font-weight: bolder; margin-bottom: 20px;"> All blogs </h2>
                </div>
            </div>

            <div class="row">
                @if(count($all) > 0)
                <table class="table" id="archives">
                    <thead>
                        <th>#</td>
                        <th>Blog title</th>
                        <th>Category</th>
                        <th>Author</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @foreach($all as $single)    
                            <tr>
                                <td>{{ $single->id }}</td>
                                <td>{{ $single->title }}</td>
                                <td>
                                    <?php 
                                        $blogCategory = \App\Models\Category::where('id' , '=', $single->category)->pluck('name');
                                        echo substr($blogCategory, 2, -2);
                                    ?>
                                </td>
                                <td>{{ $single->author }}</td>
                                <td>{{ $single->created_at }} </td>
                                <td>
                                    <center>
                                        <div class="dropdown dropleft"><i class="fa fa-ellipsis-v" id="dropdownMenu" data-toggle="dropdown" style="cursor: pointer; position: relative; right: 30px;"></i>
                                            <ul class="dropdown-menu">
                                                <li class="dropdown-item">
                                                    <a class="text-dark" href="{{ route('view-blog', 2) }}">
                                                        <i class="text-success fa fa-eye"></i>
                                                        Read blog
                                                    </a>
                                                </li>
                                                <li class="dropdown-item">
                                                    <a class="text-dark" href="{{ route('edit-blog', $single->id) }}" data-toggle="modal" data-target="#myModal-{{$single->id}}">
                                                        <i class="text-primary fa fa-pencil"></i>
                                                        Edit blog
                                                    </a>
                                                </li>
                                                <li class="dropdown-item">
                                                    <a class="text-dark" href="{{ route('archive-blog', $single->id) }}" onclick="return confirm('You are about to archive this blog. Continue?');">
                                                        <i class="text-danger fa fa-trash"></i>
                                                        Archive blog
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </center>
                                </td>
                            </tr>
                    
                        @include('pages.blogs.edit')
                    
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