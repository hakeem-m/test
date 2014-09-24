<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <title>URL Analytics App</title>

        {{ HTML::style('public/css/foundation.css') }}
        {{ HTML::script('public/js/vendor/modernizr.js') }}
        {{ HTML::script('public/js/vendor/jquery.js') }}
        <!--  main datatable js file -->
        {{ HTML::script('public/js/jquery.dataTables.min.js') }}
        <!--  css and js files of datepicker made by foundation. -->
        {{ HTML::script('public/js/foundation-datepicker.js') }}
        {{ HTML::style('public/css/foundation-datepicker.css') }}
        <!--  css and js files of responsive plug-in of datatable -->
        {{ HTML::style('public/css/dataTables.responsive.css') }}
        {{ HTML::script('public/js/dataTables.responsive.js') }}
        <!--  css and js foundation made for datatables -->
        {{ HTML::style('public/css/dataTables.foundation.css') }}
        {{ HTML::script('public/js/dataTables.foundation.js') }}
        <!--  css and js files of colvis plug-in to filter datatable columns -->
        {{ HTML::style('public/css/dataTables.colVis.css') }}
        {{ HTML::script('public/js/dataTables.colVis.js') }}
        <!--  css and js files of tableTools plug-in that generates csv,pdf etc. -->
        {{ HTML::style('public/css/dataTables.tableTools.css') }}
        {{ HTML::script('public/js/dataTables.tableTools.js') }}
        <!--   js files of tableTools column filter plug-in  -->
        {{ HTML::script('public/js/jquery.dataTables.columnFilter.js') }}        
        <!--  css to add custom style beside foundation. style -->
        {{ HTML::style('public/css/styles.css') }}
    </head>
    <body>
        <nav class="top-bar" data-topbar>
            <ul class="title-area">
                <li class="name">
                    <h1><a href="{{ action('UrlsController@index') }}">Home</a></h1>
                </li>
                <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
            </ul>
            <section class="top-bar-section">
                <!-- Right Nav Section -->
                <ul class="right">
                    <li>
                        <a href="{{ action('UrlsController@longToShort') }}">Long to Short</a>
                    </li>
                    <li>
                        <a href="{{ action('UrlsController@shortToLong') }}">Short to Long</a>
                    </li>
                    <li>
                        <a href="{{ action('UrlsController@shortAnalytics') }}">View Short URL Analytics</a>
                    </li>
                    <li class="has-form">
                        {{ link_to('users/logout','Logout',array('class'=>'button tiny'), $secure = null)}}
                    </li>

                </ul>

            </section>
        </nav>
        <div class="header" style="text-align: center;">
            <h2 class="hide-for-small">A.R.M. URL Builder and Analytics</h2>
        </div>
        <div  class="columns">
            @yield('content')
        </div>
        {{ HTML::script('public/js/foundation.min.js') }}
        <script>
            $(document).foundation();
         </script>
        <script>
            @yield('end_scripts')
        </script>
    </body>
</html>