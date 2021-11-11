<div class="modal fade" id="newsletterModal" tabindex="-1" role="dialog" aria-labelledby="newsletterModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newsletterModalLabel"> Get alerts for newly published blogs </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form action="{{ route('save-subscriber') }}" method="post" id="newsletter-form">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Please enter your name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" name="email" class="form-control" aria-describedby="emailHelp" placeholder="Enter your email address" required>
                    </div>
                    <small id="emailHelp" class="form-text text-muted">We promise to only send you the best &#128521; </small>
                    <input type="text" name="blog" value="{{ $blog_id }}" style="display: none;">
                </form>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success" name="submit" form="newsletter-form">Save changes</button>
            </div>
        </div>
    </div>
</div>