<script src="{{asset('admin/js/jquery.min.js?v=2.1.4')}}"></script>
<script src="{{asset('admin/js/bootstrap.min.js?v=3.3.6')}}"></script>
<script src="{{asset('admin/js/content.min.js?v=1.0.0')}}"></script>
<div class="container">
    @include('flash::message')
</div>
<script>
    $('div.alert').not('.alert-important').delay(3000).fadeOut(350);
</script>