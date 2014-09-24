@extends('url.layout')

@section('content')
<h1><small>Results</small></h1>

<div class="panel">
    <?php
    foreach ($long as $item) {
        echo "<p ><strong>Original URL:  </strong><a href='" . $item->original_url . "'>" . $item->original_url . "</a></p>";
        echo "<p ><strong>Short URL:     </strong><a href='" . $item->short_url . "'>" . $item->short_url . "</a></p>";
        echo "<p ><strong>Description:   </strong>" . $item->description . "</p>";
        echo "<p ><strong>Created Date:  </strong>" . $item->created_at . "</p>";
    }
    ?>
</div>
@stop


