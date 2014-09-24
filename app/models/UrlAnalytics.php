<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class UrlAnalytics extends Eloquent {

    protected $table = 'url_analytics';
    public $timestamps = false;

    /*
     * define relationship with UrlData model.
     */

    public function relatedUrl() {
        return $this->belongsTo('UrlData');
    }

}
