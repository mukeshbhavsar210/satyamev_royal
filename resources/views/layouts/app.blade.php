<!DOCTYPE html>
<html lang="en" class="w-mod-js wf-ambroisefrancoisstd-n4-active wf-sloopscriptthree-n4-active wf-active lenis" style="--_100svh: 643px;">
<head>
<meta charset="utf-8">
<title>Satyamev Group</title>  
<meta content="width=device-width, initial-scale=1" name="viewport">   
<link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}" type="text/css">

</head>
<body class="body">

<div data-barba="wrapper" class="transition-wrapper">
    @include('layouts.header.header')    
    
    <main data-barba-namespace="home" data-barba="container" class="transition-container">
        @yield('content')
    </main>

    @include('layouts.footer.footer')
</div>

<script src="{{ asset('assets/js/jquery-3.5.1.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/effects.js') }}"></script>
<script src="{{ asset('assets/js/gsap.min.js') }}"></script>
<script src="{{ asset('assets/js/ScrollTrigger.min.js') }}"></script>
<script src="{{ asset('assets/js/SplitText.min.js') }}"></script>
<script src="{{ asset('assets/js/CustomEase.min.js') }}"></script>
<script src="{{ asset('assets/js/lenis.min.js') }}"></script>
<script src="{{ asset('assets/js/effects2.js') }}"></script>
<script src="{{ asset('assets/js/documentReady.js') }}"></script>

@yield('customJs')

</body>
</html>