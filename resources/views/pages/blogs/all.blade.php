@extends('layouts.main')

@section('content')

    <main role="main" class="all-blogs">
        <div class="row"> 
            <div class="col-lg-12 col-sm-12"> 
                <h2 style="font-weight: bolder; margin-bottom: 20px;"> All blogs </h2>
            </div>
        </div>

        @if(Session::has('success'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p>{{ Session::get('success') }}</p>
            </div>
        @endif

        @if(Session::has('error'))
            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p>{{ Session::get('error') }}</p>
            </div>
        @endif

        @if(count($all) > 0)
            <table class="table table-hover" id = "all-blogs">
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
                                @php
                                    $blogCategory = \App\Models\Category::where('id' , '=', $single->category)->pluck('name');
                                    echo substr($blogCategory, 2, -2);
                                @endphp
                            </td>
                            <td>{{ $single->author }}</td>
                            <td>{{ $single->created_at }} </td>
                            <td>
                                <center>
                                    <div class="dropdown dropleft"><i class="fa fa-ellipsis-v" id="dropdownMenu" data-toggle="dropdown" style="cursor: pointer;"></i>
                                        <ul class="dropdown-menu">

                                            @if(Auth::user()->can('publish-blog'))
                                                <li class="dropdown-item" style="cursor: pointer;">
                                                    <a id="publish-blog" class="text-success publishsuspend" data-type="publish" data-post="{{ $single->id }}">
                                                        <i class="fa fa-check"></i>
                                                        Publish blog
                                                    </a>
                                                </li>
                                            @endif

                                            @if(Auth::user()->can('publish-blog'))
                                                <li class="dropdown-item" style="cursor: pointer;">
                                                    <a id="publish-blog" class="text-danger publishsuspend" data-type="suspend" data-post="{{ $single->id }}">
                                                        <i class="fa fa-close"></i>
                                                        Suspend blog
                                                    </a>
                                                </li>
                                            @endif

                                            @if(Auth::user()->can('view-blogComments'))
                                            <li class="dropdown-item" style="cursor: pointer;">
                                                <a class="text-info" href="{{ route('view-blogComments', $single->id) }}">
                                                    <i class="fa fa-eye"></i>
                                                    View Comments
                                                </a>
                                            </li>
                                            @endif

                                            @if(Auth::user()->can('edit-blog'))
                                                <li class="dropdown-item" style="cursor: pointer;">
                                                    <a class="text-primary" href="{{ route('edit-blog', $single->id) }}" data-toggle="modal" data-target="#myModal-{{$single->id}}">
                                                        <i class="fa fa-pencil"></i>
                                                        Edit blog
                                                    </a>
                                                </li>
                                            @endif

                                            @if(Auth::user()->can('archive-blog'))
                                                <li class="dropdown-item" style="cursor: pointer;">
                                                    <a class="text-danger" href="{{ route('archive-blog', $single->id) }}" onclick="return confirm('You are about to archive this blog. Continue?');">
                                                        <i class="fa fa-trash"></i>
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
        @endif
    </main>

            <script type="text/javascript">
            $(document).on('click', '#publish-blog', function() {
                var _type = $(this).data('type');
                var _blog = $(this).data('post');
                var _user = "{{ Auth::user()->id }}";

                $.ajax({
                    url:"{{ url('publish-blog') }}",
                    type:"post",
                    dataType:'json',
                    data:{
                        type: _type,
                        blog: _blog,
                        user: _user,
                        _token:"{{ csrf_token() }}"
                    },
                    success:function(response){
                        if(response.publish === true){
                            toastr.options = {
                                "preventDuplicates": true,
                                "preventOpenDuplicates": true
                                };
                                toastr.success(response.publishing_msg,
                                {
                                    timeOut: 5000,
                                });
                        }
                        else if(response.suspend === true) {
                            toastr.options = {
                                "preventDuplicates": true,
                                "preventOpenDuplicates": true
                                };
                                toastr.success(response.suspending_msg,
                                {
                                    timeOut: 5000,
                                });
                        }
                        else{
                            toastr.options = {
                                "preventDuplicates": true,
                                "preventOpenDuplicates": true
                                };
                                toastr.error('Error', 'Something went wrong!',
                                {
                                    timeOut: 5000,
                                });
                        }

                    }
                });
            });
                
        </script>

@endsection