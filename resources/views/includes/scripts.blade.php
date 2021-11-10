<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
        crossorigin="anonymous"></script>

<script>
        $(document).ready(function() {
                $(function () {
                        $("#archives").DataTable();
                        $("#all-blogs").DataTable();
                        $("#blog-comments").DataTable();
                });
        });
</script>


<!-- dark mode switch -->
<script>
        const btn = document.querySelector('.btn-toggle');
        const icon = document.querySelector('#toggle-icon');
        btn.addEventListener('click', function() {
                document.body.classList.toggle('dark-theme');
                icon.classList.toggle('fa-toggle-on');
        })
</script>


<!-- toastr alert timeout -->
<script type="text/javascript">
        setTimeout(function() {
                $('.alert').fadeOut('fast');
        }, 5000);
</script>


<!-- summernote -->
<script type="text/javascript">
        $('#summernote').summernote({
                height: 330
        });
</script>
