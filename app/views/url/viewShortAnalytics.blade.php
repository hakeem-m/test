@extends('url.layout')
@section('content')

<h1><small>Analytics</small></h1>
<div class="panel">

    <?php
    echo "<br>";
    echo "<pre>";
    echo "<p align='left'><strong>Long URL:     </strong>" . $analytics->longUrl . "</p>";
    echo "<p align='left'><strong>Short URL:    </strong>" . $analytics->id . "</p>";
    echo "<p align='left'><strong>Kind:         </strong>" . $analytics->kind . "</p>";
    echo "<p align='left'><strong>Created :     </strong>" . $analytics->created . "</p>";

    echo "<p align='left'><strong>Short URL clicks: </strong>" . $analytics->modelData['analytics']['allTime']['shortUrlClicks'] . "</p>";
    echo "<p align='left'><strong>Long URL clicks: </strong>" . $analytics->modelData['analytics']['allTime']['longUrlClicks'] . "</p>";



    if (array_key_exists('referrers', $analytics->modelData['analytics']['allTime'])) {
        echo "<p align='left'><strong>Referrers: </strong></p>";
        $referrers = $analytics->modelData['analytics']['allTime']['referrers'];
        foreach ($referrers as $item) {

            echo "<p align='left'><strong>                 " . $item['id'] . " = " . $item['count'] . "</strong></p>";
        }
    }


    if (array_key_exists('countries', $analytics->modelData['analytics']['allTime'])) {
        $countries = $analytics->modelData['analytics']['allTime']['countries'];
        echo "<p align='left'><strong>Countries: </strong></p>";
        foreach ($countries as $item) {

            echo "<p align='left'><strong>                 " . $item['id'] . " = " . $item['count'] . "</strong></p>";
        }
    }
    if (array_key_exists('browsers', $analytics->modelData['analytics']['allTime'])) {
        $browsers = $analytics->modelData['analytics']['allTime']['browsers'];
        echo "<p align='left'><strong>Browsers: </strong></p>";
        foreach ($browsers as $item) {

            echo "<p align='left'><strong>                 " . $item['id'] . " = " . $item['count'] . "</strong></p>";
        }
    }
    if (array_key_exists('platforms', $analytics->modelData['analytics']['allTime'])) {
        $platforms = $analytics->modelData['analytics']['allTime']['platforms'];
        echo "<p align='left'><strong>Platforms: </strong></p>";
        foreach ($platforms as $item) {

            echo "<p align='left'><strong>                 " . $item['id'] . " = " . $item['count'] . "</strong></p>";
        }
    }

    echo "<p align='left'><strong>Month: </strong></p>";
    echo "<p align='left'><strong>                   Short URL click = " . $analytics->modelData['analytics']['month']['shortUrlClicks'] . "</strong></p>";
    echo "<p align='left'><strong>                   Long URL click  = " . $analytics->modelData['analytics']['month']['longUrlClicks'] . "</strong></p>";


    echo "<p align='left'><strong>Week: </strong></p>";
    echo "<p align='left'><strong>                   Short URL click = " . $analytics->modelData['analytics']['week']['shortUrlClicks'] . "</strong></p>";
    echo "<p align='left'><strong>                   Long URL click  = " . $analytics->modelData['analytics']['week']['longUrlClicks'] . "</strong></p>";


    echo "<p align='left'><strong>Day: </strong></p>";
    echo "<p align='left'><strong>                   Short URL click = " . $analytics->modelData['analytics']['day']['shortUrlClicks'] . "</strong></p>";
    echo "<p align='left'><strong>                   Long URL click  = " . $analytics->modelData['analytics']['day']['longUrlClicks'] . "</strong></p>";


    echo "<p align='left'><strong>Two Hours: </strong></p>";
    echo "<p align='left'><strong>                   Short URL click = " . $analytics->modelData['analytics']['twoHours']['shortUrlClicks'] . "</strong></p>";
    echo "<p align='left'><strong>                   Long URL click  = " . $analytics->modelData['analytics']['twoHours']['longUrlClicks'] . "</strong></p>";

    echo "</pre>";
    ?>
</div> 
@stop


