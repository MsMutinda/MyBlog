@extends('layouts.main')

@section('content')

    <main role="main">
        <div class="all-blogs">
            <div class="row"> 
                <div class="col-lg-12 col-sm-12"> 
                    @foreach($blog as $b)
                        <h2 style="font-weight: bolder; margin-bottom: 20px;"> 
                            {{ $b->title }} comments 
                        </h2>
                    @endforeach
                </div>
            </div>

            <table class="table table-hover" id="all-blogs" style="width: 90vw;">
                <thead>
                    <th>#</td>
                    <th>Comment</th>
                    <th>Posted At</th>
                    <th>Approval Status </th>
                    <th>Action</th>
                </thead>
                <tbody>
                    @if(count($comments)>0)
                        @foreach($comments as $comment)
                            <tr>
                                <td>{{ $comment->id }}</td>
                                <td>{{ $comment->comment }}</td>
                                <td>{{ $comment->created_at->format('d-m-Y H:i A') }} </td>
                                <td>{{ $comment->approval_status }} </td>
                                <td>
                                    <center>
                                        <div class="dropdown dropleft"><i class="fa fa-ellipsis-v" id="dropdownMenu" data-toggle="dropdown" style="cursor: pointer;"></i>
                                            <ul class="dropdown-menu">
                                                @if(Auth::user()->can('approve-comment'))
                                                    <li class="dropdown-item">
                                                        <a id="approve-comment" class="approvereject" data-type="approve" data-post="{{ $comment->id }}" style="color: #f57e20;"> 
                                                            <i class="fa fa-check" style="cursor:pointer; font-size: 1em; position: relative; bottom: 6px; left: 3px;"> Approve </i> 
                                                        </a>
                                                    </li>
                                                    <li class="dropdown-item">
                                                        <a id="approve-comment" class="approvereject" data-type="reject" data-post="{{ $comment->id }}"> 
                                                            <i class="fa fa-close text-danger" style="cursor: pointer; font-size: 1em; position: relative; bottom: 6px; left: 10px;"> Reject </i> 
                                                        </a>
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                    </center>
                                </td>
                            </tr>
                        @endforeach

                    @endif
                </tbody>
            </table>
        </div>

        <script type="text/javascript">
            $(document).on('click', '#approve-comment', function() {
                var _type = $(this).data('type');
                var _comment = $(this).data('post');
                var _user = "{{ Auth::user()->id }}";
                var elem = $(this);

                $.ajax({
                    url:"{{ url('approve-comment') }}",
                    type:"post",
                    dataType:'json',
                    data:{
                        type: _type,
                        comment: _comment,
                        user: _user,
                        _token:"{{ csrf_token() }}"
                    },
                    success:function(response){
                        if(response.approve === true){
                            toastr.options = {
                                "preventDuplicates": true,
                                "preventOpenDuplicates": true
                                };
                                toastr.success(response.approve_msg,
                                {
                                    timeOut: 5000,
                                });
                        }
                        else if(response.reject === true) {
                            toastr.options = {
                                "preventDuplicates": true,
                                "preventOpenDuplicates": true
                                };
                                toastr.success(response.approve_msg,
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

    </main>

@endsection