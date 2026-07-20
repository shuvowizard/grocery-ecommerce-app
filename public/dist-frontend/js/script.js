// FreshMart Grocery Store - Custom JavaScript

$(document).ready(function() {
    
    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Smooth scrolling for anchor links
    $('a[href^="#"]').on('click', function(event) {
        var target = $(this.getAttribute('href'));
        if(target.length) {
            event.preventDefault();
            $('html, body').stop().animate({
                scrollTop: target.offset().top - 100
            }, 1000);
        }
    });

    // Add to cart and wishlist will be handled by PHP
    // No jQuery functionality needed here

    // Search functionality will be handled by PHP form submission

    // Newsletter subscription will be handled by PHP form submission

    // Navbar scroll effect
    $(window).scroll(function() {
        if ($(this).scrollTop() > 50) {
            $('.navbar').addClass('navbar-scrolled');
        } else {
            $('.navbar').removeClass('navbar-scrolled');
        }
    });

    // Category cards - no notification needed

    // Wishlist functionality will be handled by PHP

    // Product rating hover effect
    $('.text-warning i').on('mouseenter', function() {
        $(this).addClass('bi-star-fill').removeClass('bi-star bi-star-half');
    });

    // Initialize carousel with custom settings
    var heroCarousel = new bootstrap.Carousel(document.getElementById('heroCarousel'), {
        interval: 5000,
        wrap: true,
        keyboard: true
    });

    // Lazy loading for images (if you add real images later)
    if ('IntersectionObserver' in window) {
        let lazyImages = [].slice.call(document.querySelectorAll('img.lazy'));
        
        let lazyImageObserver = new IntersectionObserver(function(entries, observer) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    let lazyImage = entry.target;
                    lazyImage.src = lazyImage.dataset.src;
                    lazyImage.classList.remove('lazy');
                    lazyImageObserver.unobserve(lazyImage);
                }
            });
        });

        lazyImages.forEach(function(lazyImage) {
            lazyImageObserver.observe(lazyImage);
        });
    }

    // Console message
    console.log('FreshMart - Grocery eCommerce Website Initialized');
    console.log('Bootstrap 5.3.2 & jQuery 3.7.1 loaded successfully');

});
