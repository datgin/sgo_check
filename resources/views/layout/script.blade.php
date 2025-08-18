<!-- Vendor -->
<script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>
<script src="{{ asset('assets/libs/waypoints/lib/jquery.waypoints.min.js') }}"></script>
<script src="{{ asset('assets/libs/jquery.counterup/jquery.counterup.min.js') }}"></script>
<script src="{{ asset('assets/libs/feather-icons/feather.min.js') }}"></script>
<script src="{{ asset('assets/js/pages/sweetalert2.min.js') }}"></script>

<script src="{{ asset('assets/js/pages/moment.min.js') }}"></script>

<script src="{{ asset('assets/js/pages/daterangepicker.min.js') }}"></script>

<script src="{{ asset('assets/js/pages/lightbox.min.js') }}"></script>

<script src="{{ asset('assets/js/pages/choices.min.js') }}"></script>

<script src="{{ asset('library/ckeditor/ckeditor.js') }}"></script>

<!-- App js-->
<script src="{{ asset('assets/js/app.js') }}"></script>

<script src="{{ asset('global/js/helpers.js') }}"></script>

<script src="{{ asset('global/js/toastr.js') }}"></script>

<script src="{{ asset('global/js/media.js') }}"></script>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })
</script>

<script>
    $(document).ready(function() {
        @php
            $types = ['success', 'error', 'info', 'warning'];
        @endphp

        @foreach ($types as $type)
            @if (session()->has($type))
                setTimeout(function() {
                    datgin.{{ $type }}(@json(session($type)));
                }, 600);
                @break
            @endif
        @endforeach
    });
</script>

@stack('script')
