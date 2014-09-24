<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class UrlData extends Eloquent {

    protected $table = 'url_data';
    public $timestamps = false;

    /*
     * define one to many relationship with url_analytics table.
     */

    public function analytics() {
        return $this->hasMany('UrlAnalytics');
    }

    public function getCreatedAtAttribute($date) {
        return Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('m-d-Y');
    }

    public function getUpdatedAtAttribute($date) {
        return Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('m-d-Y');
    }

}
