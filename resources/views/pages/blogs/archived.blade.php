@extends('layouts.main')

@section('content')
    <main role="main" style="margin: 0 auto;">

        <div class="archived-blogs">
            <div class="row"> 
                <div class="col-lg-12 col-sm-12"> 
                    <h2 style="font-weight: bolder; margin-bottom: 20px;"> Archived blogs </h2>
                </div>
            </div>

            <div class="row">
                @if(count($archived) > 0)
                <table class="table table-hover" id="archives" style="width: 90vw">
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
                            @if(Auth::user()->can('restore-archivedBlogs'))
                                <td>
                                    <center>
                                        <div class="dropdown dropright"><i class="fa fa-ellipsis-v" id="dropdownMenu" data-toggle="dropdown" style="cursor: pointer;"></i>
                                            <ul class="dropdown-menu">
                                                <li class="dropdown-item">
                                                    <a class="text-success" href="{{ url('/blog/'.$a->id.'/restore') }}" onclick="return confirm('You are about to restore an archived blog, continue?');">
                                                        <i class="text-success fa fa-undo"></i>
                                                        Restore
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </center>
                                </td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @endif
            </div>

        </div>
    
    </main>

@endsection