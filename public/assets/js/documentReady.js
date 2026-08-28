$(document).ready(function () { 
    $('.filter-dropdown-toggle').on('click', function (e) {
        e.stopPropagation();

        let $dropdown = $(this).closest('.apartment-filter-dropdown');

        // Close all other dropdowns
        $('.apartment-filter-dropdown')
            .not($dropdown)
            .removeClass('is-open');

        // Toggle clicked dropdown
        $dropdown.toggleClass('is-open');
    });

    $(document).on('click', '.filter_select_drop-down a', function (e) {
        e.preventDefault();

        let $item = $(this);
        let filterKey = $item.data('filter'); // status, bedrooms, sort_by
        let value = $item.data('value');
        let label = $item.text().trim();

        // Active only inside current filter
        $item
            .closest('.filter_select_drop-down')
            .find('a')
            .removeClass('is-active');

        $item.addClass('is-active');

        // Update selected label only for current filter
        $item
            .closest('.apart-s_cms_filter_item')
            .find('.selected-filter')
            .text(label);

        // Current URL
        let url = new URL(window.location.href);

        // Remove filter if "All"/empty value selected
        if (value === '' || value === null || value === undefined) {
            url.searchParams.delete(filterKey);
        } else {
            // Add/update individual filter
            url.searchParams.set(filterKey, value);
        }

        // Update browser URL without refresh
        window.history.pushState({}, '', url);

        // AJAX filtering
        $.ajax({
            url: url.pathname + url.search,
            type: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            },

            beforeSend: function () {
                $('#apartments-list').addClass('is-loading');
            },

            success: function (response) {
                $('#apartments-list').html(response);
            },

            error: function (xhr) {
                console.log(xhr.responseText);
            },

            complete: function () {
                $('#apartments-list').removeClass('is-loading');
            }
        });
    });

    // Close dropdown when clicking outside
    $(document).on('click', function () {
        $('.apartment-filter-dropdown').removeClass('is-open');
    });


    $(document).on('click', '.reset-filters', function (e) {
    e.preventDefault();

    let url = $(this).attr('href');

    // Update URL
    history.pushState({}, '', url);

    // Remove active classes
    $('.filter_select_drop-down a').removeClass('is-active');

    // Reset selected labels
    $('.apart-s_cms_filter_item').each(function () {
        let $filter = $(this);

        let title = $filter
            .find('.l2.reg')
            .text()
            .trim();

        $filter
            .find('.selected-filter')
            .text(title);
    });

    // Reload all apartments through AJAX
    $.ajax({
        url: url,
        type: 'GET',
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        },
        beforeSend: function () {
            $('#apartments-list').addClass('is-loading');
        },
        success: function (response) {
            $('#apartments-list').html(response);
        },
        complete: function () {
            $('#apartments-list').removeClass('is-loading');
        }
    });
});


    let currentIndex = 0;
    const $years = $('.timeline-year');
    const $items = $('.timeline-item');
    const totalItems = $years.length;

    function showTimeline(index) {
        if (index < 0) {
            index = 0;
        }

        if (index >= totalItems) {
            index = totalItems - 1;
        }

        currentIndex = index;

        // Remove active
        $years.removeClass('is-active');
        $items.removeClass('is-active');

        // Add active
        const $activeYear = $years.eq(index);
        const $activeItem = $items.eq(index);

        $activeYear.addClass('is-active');
        $activeItem.addClass('is-active');

        // Scroll selected year into center
        const $container = $('.timeline-years');

        const containerWidth = $container.outerWidth();
        const yearLeft = $activeYear.position().left;
        const yearWidth = $activeYear.outerWidth();

        const scrollLeft =
            $container.scrollLeft() +
            yearLeft -
            (containerWidth / 2) +
            (yearWidth / 2);

        $container.animate({
            scrollLeft: scrollLeft
        }, 400);

        // Disable/enable buttons
        $('.timeline-prev').prop('disabled', currentIndex === 0);
        $('.timeline-next').prop('disabled', currentIndex === totalItems - 1);
    }

    // Click year
    $years.on('click', function () {
        const index = $(this).data('index');
        showTimeline(index);
    });

    // Previous
    $('.timeline-prev').on('click', function () {
        if (currentIndex > 0) {
            showTimeline(currentIndex - 1);
        }
    });

    // Next
    $('.timeline-next').on('click', function () {
        if (currentIndex < totalItems - 1) {
            showTimeline(currentIndex + 1);
        }
    });

    // Keyboard support
    $(document).on('keydown', function (e) {
        if (e.key === 'ArrowLeft') {
            if (currentIndex > 0) {
                showTimeline(currentIndex - 1);
            }
        }
        if (e.key === 'ArrowRight') {
            if (currentIndex < totalItems - 1) {
                showTimeline(currentIndex + 1);
            }
        }
    });

    // First year active
    showTimeline(0);

     function animateTimelineImages() {
        $('.timeline-image-item').each(function () {
            let $item = $(this);
            let itemTop = $item.offset().top;
            let itemBottom = itemTop + $item.outerHeight();
            let scrollTop = $(window).scrollTop();
            let windowHeight = $(window).height();
            let viewportTop = scrollTop;
            let viewportBottom = scrollTop + windowHeight;

            // Image is inside viewport
            if (
                itemBottom > viewportTop &&
                itemTop < viewportBottom
            ) {
                $item
                    .addClass('in-view')
                    .removeClass('out-view');
            }

            // Image is above or below viewport
            else {
                $item
                    .removeClass('in-view')
                    .addClass('out-view');
            }

        });

    }

    // On scroll
    $(window).on('scroll', function () {
        animateTimelineImages();
    });

    // On page load
    animateTimelineImages();

    
    $('.timeline-year').on('click', function () {
        let index = $(this).data('index');

        $('.other-card').removeClass('is-active');
        $('.other-card[data-index="' + index + '"]').addClass('is-active');

        $('.timeline-year').removeClass('is-active');
        $(this).addClass('is-active');
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

   
});


$(document).on('click', '.apartment-filters a', function (e) {
    e.preventDefault();

    let $this = $(this);
    let url = $this.attr('href');

    // Active filter
    $('.apartment-filters a').removeClass('active');
    $this.addClass('active');

    // Change browser URL without refreshing
    history.pushState(null, '', url);

    // Load filtered apartments
    $.ajax({
        url: url,
        type: 'GET',
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        },
        beforeSend: function () {
            $('#apartments-list').addClass('is-loading');
        },
        success: function (response) {
            $('#apartments-list').html(response);
        },
        complete: function () {
            $('#apartments-list').removeClass('is-loading');
        }
    });
});