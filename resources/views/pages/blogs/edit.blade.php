<div class="modal fade" id="myModal-{{$single->id}}" role="dialog">
    <div class="modal-dialog">
        <div class='modal-content px-3' id='editModal'>
            <div class='modal-header'>
                <h4 class='ml-2 pl-1 pt-3 mt-1'><strong> Edit blog</strong></h4>
                <!-- dismiss button -->
                <button type="button" class="close bg-danger p-2 pt-2 mt-2" data-dismiss="modal">&times;</button>
            </div>
        
            <div class='modal-body'>
                <form action="{{ route('update-blog', $single->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="w-full sm:w-auto order-last sm:order-first">
                        <div class="md:flex md:items-center mb-4">
                            <div class="md:w-1/3">
                                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4">
                                    New Title 
                                </label>
                            </div>
                            <div class="md:w-3/3">
                                <input name="title" class="form-control bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" type="text" value="{{$single->title}}">
                                @error('name')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="md:flex md:items-center mb-4">
                            <div class="md:w-2/3">
                                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4">
                                    Category 
                                </label>
                            </div>
                            <div class="md:w-3/3">
                                <select class='form-control' name="category">
                                    <option value="--Select Category" selected disabled>Set new category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('question')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="md:flex md:items-center mb-4">
                            <div class="md:w-2/3">
                                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4">
                                    New blog image 
                                </label>
                            </div>
                            <div class="md:w-3/3">
                                <input type="file" name="file" required>
                                @error('content')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <br>

                        <div class='modal-footer'>
                            <button class="w-full shadow bg-warning hover:bg-blue-400 focus:shadow-outline focus:outline-none text-dark font-bold py-2 px-4 rounded" type="submit">
                                Update Blog
                            </button>
                        </div>
                    </div>
                </form>  
            </div>
        </div>
    </div>
</div>