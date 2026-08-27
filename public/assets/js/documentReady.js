$(document).ready(function () {    
    
    $('.timeline-year').on('click', function () {
        let index = $(this).data('index');

        $('.other-card').removeClass('is-active');
        $('.other-card[data-index="' + index + '"]').addClass('is-active');

        $('.timeline-year').removeClass('active');
        $(this).addClass('active');
    });


    function hideCookieConsent(value) {
        // Store cookie for 365 days
        document.cookie =
            'cookie_consent=' + value +
            '; path=/' +
            '; max-age=' + (60 * 60 * 24 * 365);

        // Smoothly slide down and fade out
        $('#cookie-consent').animate({
            bottom: '-200px',
            opacity: 0
        }, 500, function () {
            $(this).remove();
        });
    }

    $('#cookie-accept').on('click', function () {        
        hideCookieConsent('accepted');
    });

    $('#cookie-decline').on('click', function () {        
        hideCookieConsent('declined');
    });

    //Slider    
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