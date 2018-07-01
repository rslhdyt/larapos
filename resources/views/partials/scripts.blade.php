<!-- Bootstrap core JavaScript-->
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- Core plugin JavaScript-->
<script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>


@stack('before-scripts')

<script src="{{ asset('js/app.js') }}"></script>

<!-- Custom scripts for all pages-->
<script src="{{ asset('js/sb-admin.min.js') }}"></script>

<script>
    @if(Session::has('message_success'))
        Vue.swal({
            title: 'Success',
            text: '{{ Session::get('message_success') }}',
            type: 'success',
        });
    @endif
</script>

@stack('after-scripts')