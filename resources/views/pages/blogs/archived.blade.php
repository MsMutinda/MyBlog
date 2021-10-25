@extends('layouts.main')

@section('content')
    <div class="content-header" style="margin-top: 80px; margin-left: 10px;">
        <div class="row mb-2">
            <ul class="breadcrumb float-sm-left ml-1">
                <li class="breadcrumb-item"><a href="{{url('/')}}" style="color: #000;"><i class="fa fa-home"></i></a></li>
                <li class="breadcrumb-item active"><a href="{{url('/')}}" style="color: #000;">Home</a></li>
                <li class="breadcrumb-item" style="color: #000;">Archives</li>
            </ul>
        </div>
    </div>

    <main role="main" style="margin: 0 auto;">
        @if(count($archived) > 0)
            <table class="table table-striped " id='archives'>
                <thead>
                    <tr class="">
                        <th>#</th>
                        <th> Blog Title </th>
                        <th> Category </th> 
                        <th> Author </th>
                        <th> Date Deleted </th>
                        <th> Actions </th>
                    </tr>
                </thead>
                
                <tbody>
                @foreach($archived as $archive)
                    <tr>
                        <td>{{ $archive->id }} </td>
                        <td>{{ $archive->title}}</td>
                        <td> 
                        <!-- {{ $archive->category }}  -->
                        <?php 
                            $archiveCategory = \App\Models\Category::where('id' , '=', $archive->category)->pluck('name');
                            echo substr($archiveCategory, 2, -2);
                        ?> 
                        </td>
                        <td>{{ $archive->author }}</td>
                        <td>{{ $archive->deleted_at->format('d-m-Y') }}</td>
                        <td>
                            <center>
                                <div class="dropdown dropleft theme-green mt-2" style="width: 30px; cursor: pointer; height: 30px; border-radius: 50%; color: #000; left: -70px !important"><i class="fa fa-ellipsis-v" id="dropdownMenu" data-toggle="dropdown"></i>
                                    <ul class="dropdown-menu">
                                        <li class='dropdown-item'> <a href="{{ route('blog.restore', $archive->id) }}" class="text-success btn btn-default" onclick="return confirm('Continue to restore this blog?')"> <i class="fa fa-undo"></i> Restore blog </a> </li>
                                    </ul>
                                </div>
                            </center>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
        @else
            <?php echo '<h4 class="text-danger"> There are no archived blogs yet </h4>' ?>
        @endif
    </main>

    <footer class="navbar fixed-bottom text-dark text-center">
        <div class="container text-center" style="margin-left: 41%;">
            &copy; {{ date('Y')}} Zalego. All rights reserved.
        </div>
    </footer>

@endsection