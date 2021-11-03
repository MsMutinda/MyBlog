@extends('layouts.main')

@section('content')

        <main role="main">
            <div class="all-blogs">
                <div class="row"> 
                    <div class="col-lg-12 col-sm-12"> 
                        <h2 style="font-weight: bolder; margin-bottom: 20px;"> All blogs </h2>
                    </div>
                </div>

                @if(count($all) > 0)
                    <table class="table table-hover" id="all-blogs" style="width: 90vw;">
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
                                            <div class="dropdown dropleft"><i class="fa fa-ellipsis-v" id="dropdownMenu" data-toggle="dropdown" style="cursor: pointer;"></i>
                                                <ul class="dropdown-menu">
                                                    <li class="dropdown-item">
                                                        <a class="text-dark" href="{{ route('view-blog', 2) }}">
                                                            <i class="text-success fa fa-eye"></i>
                                                            Read blog
                                                        </a>
                                                    </li>
                                                    
                                                    <li class="dropdown-item">
                                                        <a class="text-dark" href="">
                                                            <i class="text-primary fa fa-eye"></i>
                                                            View Comments
                                                        </a>
                                                    </li>

                                                    @if(Auth::user()->can('edit-blog'))
                                                        <li class="dropdown-item">
                                                            <a class="text-dark" href="{{ route('edit-blog', $single->id) }}" data-toggle="modal" data-target="#myModal-{{$single->id}}">
                                                                <i class="text-primary fa fa-pencil"></i>
                                                                Edit blog
                                                            </a>
                                                        </li>
                                                    @endif

                                                    @if(Auth::user()->can('archive-blog'))
                                                        <li class="dropdown-item">
                                                            <a class="text-dark" href="{{ route('archive-blog', $single->id) }}" onclick="return confirm('You are about to archive this blog. Continue?');">
                                                                <i class="text-danger fa fa-trash"></i>
                                                                Archive blog
                                                            </a>
                                                        </li>
                                                    @endif
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
        </main>

@endsection