<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Url extends Eloquent {

    /**
     * return the client object of google API.
     *
     * @param  int  $client_id,$client_secret,$client_secret
     * @return $client
     */
    public static function getClient($client_id, $client_secret, $redirect_uri) {
        $client = new Google_Client();
        $client->setClientId($client_id);
        $client->setClientSecret($client_secret);
        $client->setRedirectUri($redirect_uri);
        $client->addScope("https://www.googleapis.com/auth/urlshortener");
        return $client;
    }

    public static function getShort($client, $long) {
        $service = new Google_Service_Urlshortener($client);
        $url = new Google_Service_Urlshortener_Url();
        $url->longUrl = $long;
        $short = $service->url->insert($url);
        //$short =Response::json($short);
        //$data = json_decode($short, TRUE);
        return $short;
    }

    public static function getLong($short) {
        return Url::where('short_url', '=', $short)->get();
    }

    public static function getShortAnalytics($client, $short) {
        $service = new Google_Service_Urlshortener($client);
        $url = new Google_Service_Urlshortener_Url();
        $analytics = $service->url->get($short, array('projection' => 'FULL'));
        return $analytics;
    }

    /*
     * validate UrlBuilder form fields
     */

    public static function validate_url_builder($input) {


        $rules = array(
            'website_url' => 'Required|url',
            'compaign_source' => 'Required',
            'compaign_medium' => 'Required',
            'compaign_name' => 'Required'
        );

        return Validator::make($input, $rules);
    }

    /*
     * validate long to short  form fields
     */

    public static function validate_longToShort($input) {


        $rules = array(
            'long_url' => 'Required|url'
        );

        return Validator::make($input, $rules);
    }

    /*
     * validate short to long  form fields
     */

    public static function validate_ShortToLong($input) {


        $rules = array(
            'short_url' => 'Required|url'
        );

        return Validator::make($input, $rules);
    }

    /*
     * validate short analytics  form fields
     */

    public static function validate_ShortAnalytics($input) {


        $rules = array(
            'short_url' => 'Required|url'
        );

        return Validator::make($input, $rules);
    }

}
