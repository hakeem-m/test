<!doctype html>
<html class="no-js" lang="en">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
 
	<title>URL Analytics App</title>
 
	{{ HTML::style('public/css/foundation.css') }}
	{{ HTML::script('public/js/vendor/modernizr.js') }}
</head>
<body>

    <div class="row">
      <div class="large-12 columns">
        
      </div>
    
 
	@yield('content')
 </div>
    
	  {{ HTML::script('public/js/vendor/jquery.js') }}
	  {{ HTML::script('public/js/foundation.min.js') }}
    
	<script>
		$(document).foundation();
	</script>
 
  <script>
      @yield('end_scripts')
  </script>
</body>
</html>