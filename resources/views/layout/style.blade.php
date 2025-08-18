
 <!-- App css -->
 <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />

 <!-- Icons -->
 <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

 <link href="{{ asset('assets/css/font-awesome.css') }}" rel="stylesheet">

 <link rel="stylesheet" href="{{ asset('assets/css/sweetalert2.min.css') }}">

 <link rel="stylesheet" href="{{ asset('assets/css/lightbox.min.css') }}">

 <link rel="stylesheet" href="{{ asset('assets/css/daterangepicker.css') }}">

 <link rel="stylesheet" href="{{ asset('assets/css/choices.min.css') }}">

 <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}?v={{ fileatime(public_path('assets/css/main.css')) }}">

 <link rel="stylesheet" href="{{ asset('global/css/toastr.css') }}">

 @stack('style')
