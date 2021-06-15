<script src="{{ asset('') }}assets/js/core/jquery.min.js" type="text/javascript"></script>
<script src="{{ asset('') }}assets/js/core/popper.min.js" type="text/javascript"></script>
<script src="{{ asset('') }}assets/js/core/bootstrap-material-design.min.js" type="text/javascript"></script>
<script src="{{ asset('') }}assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
<!-- Place this tag in your head or just before your close body tag. -->
{{-- <script async defer src="https://buttons.github.io/buttons.js"></script> --}}
<!-- Chartist JS -->
<script src="{{ asset('') }}assets/js/plugins/chartist.min.js"></script>
<!--  Notifications Plugin    -->
<script src="{{ asset('') }}assets/js/plugins/bootstrap-notify.js"></script>
<!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
<script src="{{ asset('') }}assets/js/material-dashboard.min.js?v=2.1.2" type="text/javascript"></script>
<!-- Material Dashboard DEMO methods, don't include it in your project! -->
<script src="{{ asset('') }}assets/demo/demo.js"></script>
<script>
    $(document).ready(function () {
        // Javascript method's body can be found in assets/js/demos.js
        md.initDashboardPageCharts();

    });

</script>
<!-- Sharrre libray -->
<script src="{{ asset('') }}assets/demo/jquery.sharrre.js"></script>
<script>
    $(document).ready(function () {

        // Facebook Pixel Code Don't Delete
        ! function (f, b, e, v, n, t, s) {
            if (f.fbq) return;
            n = f.fbq = function () {
                n.callMethod ?
                    n.callMethod.apply(n, arguments) : n.queue.push(arguments)
            };
            if (!f._fbq) f._fbq = n;
            n.push = n;
            n.loaded = !0;
            n.version = '2.0';
            n.queue = [];
            t = b.createElement(e);
            t.async = !0;
            t.src = v;
            s = b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t, s)
        }(window,
            document, 'script', 'https://connect.facebook.net/en_US/fbevents.js');

        try {
            fbq('init', '111649226022273');
            fbq('track', "PageView");

        } catch (err) {
            console.log('Facebook Track Error:', err);
        }

    });

</script>
<noscript>
    <img height="1" width="1" style="display:none"
        src="https://www.facebook.com/tr?id=111649226022273&ev=PageView&noscript=1" />
</noscript>
<script>
    $(document).ready(function () {
        $().ready(function () {
            $sidebar = $('.sidebar');
            $sidebar_img_container = $sidebar.find('.sidebar-background');

            $full_page = $('.full-page');

            $sidebar_responsive = $('body > .navbar-collapse');
            sidebar_mini_active = true;

            window_width = $(window).width();

            fixed_plugin_open = $('.sidebar .sidebar-wrapper .nav li.active a p').html();

            // if( window_width > 767 && fixed_plugin_open == 'Dashboard' ){
            //     if($('.fixed-plugin .dropdown').hasClass('show-dropdown')){
            //         $('.fixed-plugin .dropdown').addClass('show');
            //     }
            //
            // }

            
        });

        if (window_width > 767) {
            if ($('.fixed-plugin .dropdown').hasClass('show-dropdown')) {
                $('.fixed-plugin .dropdown').addClass('show');
                $('.fixed-plugin .dropdown-menu').addClass('show');
            }
        }
    });

</script>


@stack('js')
</body>

</html>
