<div class='modal fade' id="createBlogModal" tabindex="-1" role="dialog" aria-labelledby="createBlogModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createBlogModalLabel"> Add a new blog </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form method="POST" action="{{ route('save-blog') }}" enctype="multipart/form-data" id="createBlog-form">
                    @csrf                 
                    <div class="form-group">
                        <label for="title"> Blog Title <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control shadow" placeholder="Blog name goes here" required>
                    </div>

                    <div class="form-group">
                        <label for="category"> Category <span class="text-danger">*</span></label>
                        <select class='form-control shadow' name="category">
                            <option value="--Select Category" selected disabled>Select category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>                    
                    </div>

                    <div class="form-group">
                        <label for="content"> Content <span class="text-danger">*</span></label>
                        <textarea class="form-control shadow" name="content" id="summernote" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="file"> Upload blog image <span class="text-danger">*</span></label> <br>
                        <input type="file" name="file" required>
                    </div>
                    
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-success" form="createBlog-form" onclick="return confirm('You are about to save this Blog, continue?');"> Save Blog</button>
            </div>

        </div>
    </div>
</div> 