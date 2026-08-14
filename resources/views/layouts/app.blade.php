<!DOCTYPE html>
<html lang="en" class="w-mod-js wf-ambroisefrancoisstd-n4-active wf-sloopscriptthree-n4-active wf-active lenis" style="--_100svh: 643px;">
<head>
<meta charset="utf-8">
<title>Satyamev Group</title>  
<meta content="width=device-width, initial-scale=1" name="viewport">   
<link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}" type="text/css">
</head>
<body>

<div data-barba="wrapper" class="transition-wrapper">
    @include('layouts.header.header')
    
    <main data-barba-namespace="home" data-barba="container" class="transition-container">
        @yield('content')
    </main>

    @include('layouts.footer.footer')
</div>

<script src="{{ asset('assets/js/jquery-3.5.1.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/webflow.a0aa6ca1.b7683852b8a60d8e.js') }}" type="text/javascript" ></script>
<script src="https://unpkg.com/@barba/core"></script>
<script src="{{ asset('assets/js/gsap.min.js') }}"></script>
<script src="{{ asset('assets/js/ScrollTrigger.min.js') }}"></script>
<script src="{{ asset('assets/js/SplitText.min.js') }}"></script>
<script src="{{ asset('assets/js/CustomEase.min.js') }}"></script>
<script src="{{ asset('assets/js/lenis.min.js') }}"></script>
<script src="https://assets.slater.app/slater/20164.js?v=1.0" type="module"></script>
<script>
    $(document).ready(function () {
        var $years = $('.timeline-year');
        var $slides = $('.timeline-slide');
        var currentIndex = 0;
        var totalSlides = $years.length;
        
        function showTimeline(index) {
            if (index < 0) {
                index = totalSlides - 1;
            }
            if (index >= totalSlides) {
                index = 0;
            }
            if (index === currentIndex) { return; }

            var oldIndex = currentIndex;         

            currentIndex = index;

            // Year active class
            $years.removeClass('active');
            $years.eq(index).addClass('active');

            // Slide
            $slides.removeClass('active'); 
            $slides.eq(index).addClass('active');
        
            // Scroll active year into view
            var $activeYear = $years.eq(index);
            var $nav = $('.timeline-nav');

            var navScroll =
                $activeYear.position().left +
                $nav.scrollLeft() -
                ($nav.width() / 2) +
                ($activeYear.outerWidth() / 2);

            $nav.animate({
                scrollLeft: navScroll
            }, 400);
        }

        $years.on('click', function () {
            var index = parseInt($(this).attr('data-index'));
            showTimeline(index);
        });
        
        $('.timeline-next').on('click', function () {
            showTimeline(currentIndex + 1);
        });   

        $('.timeline-prev').on('click', function () {
            showTimeline(currentIndex - 1);
        });
    });
</script>

@yield('customJs')

</body>
</html>