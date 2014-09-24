<?php

class UrlsController extends \BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    //'poineer2006@gmail.com account details
    /*
    public $client_id = '122070362224-kd7rd4t0k9nc95eefv5r8fo2g9b7bfgq.apps.googleusercontent.com';
    public $client_secret = 'hiMjn7Zl-WCalw1jbWepkfQZ';
    public $redirect_uri = 'http://localhost/ceniack/';
    public $developerKey = 'AIzaSyAojeQAmixr-8Mt54mkiIv8jYgxccyzNyI';
    */
    //*******************************************************************
    
    // 'development@ceniack.com account details
    public $client_id = '388227684751-vfbk2l6rds1nsnc58pv6gn8j17j380tv.apps.googleusercontent.com';
    public $client_secret = 'DBOPf0eU7WpGKMBYcT2J_YMY';
    public $redirect_uri = 'http://localhost/ceniack/';
    public $developerKey = 'AIzaSyA1koLbii_6laSnwGJZvKLHV3hXGSEhCxM';
    //*******************************************************************

    public function index() {
        $urls = Url::all();
        return View::make('url.index', compact('urls'));
    }

    /**
     * Show the form for long to short url conversion.
     *
     * @return Response
     */
    public function longToShort() {
        return View::make('url.longToShort');
    }

    /**
     * Show the form for short to long url conversion.
     *
     * @return Response
     */
    public function shortToLong() {
        return View::make('url.shortToLong');
    }

    /**
     * Show the form for URL builder.
     *
     * @return Response
     */
    public function urlBuilder() {
        return View::make('url.url_builder');
    }

    /**
     * Show the form for short url, then get its analytics.
     *
     * @return Response
     */
    public function shortAnalytics() {
        return View::make('url.shortAnalytics');
    }

    /**
     * handle  long to short url conversion.
     *
     * @return Response
     */
    public function handleLongToShort() {
        $v = Url::validate_longToShort(Input::all());
        if ($v->passes()) {
            $long = Input::get('long_url');
            $client = Url::getClient($this->client_id, $this->client_secret, $this->redirect_uri);
            $short = Url::getShort($client, $long);
            //var_dump($short);
            //return $short;
            return View::make('url.viewShort', array('short' => $short));
        } else {
            return Redirect::to('/longToShort')->withErrors($v);
        }
    }

    /**
     * handle  short to long.
     *
     * @return Response
     */
    public function handleShortToLong() {
        $v = Url::validate_ShortToLong(Input::all());
        if ($v->passes()) {
            $short = Input::get('short_url');
            $long = Url::getLong($short);
            return View::make('url.viewLong', compact('long'));
        } else {
            return Redirect::to('/shortToLong')->withErrors($v);
        }
    }

    /*     * s
     * save URL data into databse.
     *
     * @return Response
     */

    public function save() {
        $url = new Url;
        $url->description = Input::get('description');
        $url->original_url = Input::get('long_url');
        $url->short_url = Input::get('short_url');
        $url->save();
        return Redirect::action('UrlsController@index');
    }

    /**
     * get analytics of short URL
     *
     * @return Response
     */
    public function handleShortAnalytics() {
        $v = Url::validate_ShortToLong(Input::all());
        if ($v->passes()) {
            $short = Input::get('short_url');
            $client = Url::getClient($this->client_id, $this->client_secret, $this->redirect_uri);
            $client->setDeveloperKey($this->developerKey);
            $analytics = Url::getShortAnalytics($client, $short);
            //var_dump($analytics);
            return View::make('url.viewShortAnalytics', array('analytics' => $analytics));
        } else {
            return Redirect::to('/shortAnalytics')->withErrors($v);
        }
    }

    /**
     * get urlBuilder form data and save it into database and build URL.
     *
     * @return Response
     */
    public function handleUrlBuilder() {
        $v = Url::validate_url_builder(Input::all());
        if ($v->passes()) {
            // builds URL based on input parameter
            $data = array();
            $data['website_url'] = Input::get('website_url');
            $data['campaign_source'] = Input::get('campaign_source');
            $data['campaign_medium'] = Input::get('campaign_medium');
            $data['campaign_content'] = Input::get('campaign_content');
            $data['campaign_name'] = Input::get('campaign_name');
            $data['subject_line'] = Input::get('subject_line');
            $data['wmj_job_number'] = Input::get('wmj_job_number');
            $data['message'] = Input::get('message');
            $data['partner'] = Input::get('partner');
            $data['channel'] = Input::get('channel');
            $data['notes'] = Input::get('notes');
            $data['build_url'] = $data['website_url'] . "?utm_source=" . $data['campaign_source'] . "&utm_medium=" . $data['campaign_medium'] . "&utm_content=" . $data['campaign_content'] . "&utm_campaign=" . $data['campaign_name'];
            //generate short url
            $client = Url::getClient($this->client_id, $this->client_secret, $this->redirect_uri);
            $short_url = Url::getShort($client, $data['website_url']);
            if ($short_url) {
                $data['short_url'] = $short_url->id;
            }
            Session::put('data', $data);

            return View::make('url.buildUrl', array('data' => $data));
        } else {
            return Redirect::to('/dashboard')->withErrors($v);
        }
    }

    /*     * s
     * save Build URL data into url_data table in the databse.
     *
     * @return Response
     */

    public function saveBuildUrl() {


        $session = Session::all();
        $data = $session['data'];
        echo "session <br>";
        var_dump($data);

        $url = new UrlData;
        $url->long_url = $data['build_url'];
        $url->subject_line = $data['subject_line'];
        $url->short_url = $data['short_url'];
        $url->original_url = $data['website_url'];
        $url->notes = $data['notes'];
        $url->partner = $data['partner'];
        $url->channel = $data['channel'];
        $url->message = $data['message'];
        $url->wmj_job_number = $data['wmj_job_number'];
        $url->campaign_medium = $data['campaign_medium'];
        $url->campaign_source = $data['campaign_source'];
        $url->campaign_content = $data['campaign_content'];
        $url->campaign_name = $data['campaign_name'];
        $url->google_account_id = 2;
        $url->save();
        return Redirect::action('UrlsController@index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        //
    }

    public function delete(Url $url) {
        // Show delete confirmation page.
        return View::make('url.delete', compact('url'));
    }

    public function handleDelete() {
        // Handle the delete confirmation.
        $id = Input::get('url');
        $url = Url::findOrFail($id);
        $url->delete();

        return Redirect::action('UrlsController@index');
    }

    /*
     * get data from user table datatable plugin
     */

    public function getDatatable() {
        return Datatable::collection(UrlData::all(array('id', 'long_url', 'subject_line', 'short_url', 'original_url', 'notes', 'partner', 'message', 'wmj_job_number', 'campaign_medium', 'campaign_source', 'campaign_content', 'campaign_name', 'created_at')))
                        // empty column added to show + button of responsive plug-in.
                        ->addColumn('first', function($model) {
                            return " ";
                        }
                        )
                        //extra column added to show checkbo
                        ->addColumn('name1', function($model) {
                           return "<input type='checkbox' name='" . $model->id . "' class='checkbox-record' value='1' >";
                           
                        }
                        )
                        ->showColumns('created_at', 'campaign_content', 'original_url', 'campaign_name', 'campaign_source', 'campaign_medium', 'long_url', 'short_url', 'partner', 'channel', 'wmj_job_number', 'subject_line', 'notes')
                        ->searchColumns('created_at', 'campaign_content', 'original_url', 'campaign_name', 'campaign_source', 'campaign_medium', 'long_url', 'short_url', 'partner', 'channel', 'wmj_job_number', 'subject_line', 'notes')
                        ->orderColumns('created_at', 'campaign_content', 'original_url', 'campaign_name', 'campaign_source', 'campaign_medium', 'long_url', 'short_url', 'partner', 'channel', 'wmj_job_number', 'subject_line', 'notes')
                        ->make();
    }

    /**
     * cron job method to get analytics of each url and store into url_analytics table.
     * Runs Daily.
     */
    public function cronJob() {

        // fetch all data from url_data table to get analytics of each url.
        $urls = UrlData::all(array('id', 'short_url'))->toArray();

        //create google client to get short analytics
        $client = Url::getClient($this->client_id, $this->client_secret, $this->redirect_uri);
        $client->setDeveloperKey($this->developerKey);
        //record object to create new record for analytics table.
        $record = null;
        //iterate over each url and get it's short analytics.
        $i=1;
        foreach ($urls as $item) {

            // sleep for 1 second after every 200 request.
            if(($i%100)==0)
            {
                sleep(1);
            }
            $record = new UrlAnalytics();
            $record->url_data_id = $item['id'];
            //get short url analytics as an object
            $analytics = Url::getShortAnalytics($client, $item['short_url']);
            //set daily total field click.
            $record->daily_total = $analytics->modelData['analytics']['day']['shortUrlClicks'];
            // convert return object into json format.
            $analytics = json_encode($analytics);
            //$analytics=json_decode($analytics, true);
            $record->raw_data = $analytics;
            $record->save();
            $i++;
        }
    }
    

    /**
     *@description:  Export analytics result into CSV file using laravel package.
     *      Get input data from datatable using ajax call,
     *      Filter columns and extract Id's.
     *      Perform database query to get results based on Id's and filtered columns.
     *      Calculate analytics and generate csv.

     */
    public function exportCsv() {
        $val = Input::all();
        //explode input string with special character(#@$) appended in ajax script to separate id's and columns
        $val = explode('#@$', $val['tableData']);
        //first array contains the filtered columns headers.
        $headers = explode(',', $val[0]);
        // columns array() contains column names for database query.
        $columns = array();
        if (in_array("URL", $headers)) {
            $columns[] = 'original_url';
        }
        if (in_array("Source", $headers)) {
            $columns[] = 'campaign_source';
        }
        if (in_array("Medium", $headers)) {
            $columns[] = 'campaign_medium';
        }
        if (in_array("Campaign Content", $headers)) {
            $columns[] = 'campaign_content';
        }
        if (in_array("Campaign Name", $headers)) {
            $columns[] = 'campaign_name';
        }
        if (in_array("Partner", $headers)) {
            $columns[] = 'partner';
        }
        if (in_array("Channel", $headers)) {
            $columns[] = 'channel';
        }
        if (in_array("Subject Line", $headers)) {
            $columns[] = 'subject_line';
        }
        /*********************** code to extract ids from raw string **********/
        // ids array() holds ids of selected records. 
        $ids=array();
        // explode string using ',' , set in ajax call using "sFieldSeperator": ","
        $val = explode(',', $val[1]);
        foreach($val as $item)
        {
            $pos = strpos($item, 'checkbox');
            if ($pos) 
            {
                $data=explode('=',$item);
                $ids[]= Helper::getStringBetween($data[2],'\'','\'');
            }
            
        }
        // query database table to get data of selected urls.
        $url_data = DB::table('url_data')
                        ->select($columns)
                        ->whereIn('id', $ids)->get();
        

        /********************* code to get each url analytics data and perform calculations.*/
        // loop to get analytics of each url and calculate its analytics.
        $index=0;
        foreach($ids as $item)
        {
            // get analytics data of a URl
            $analytics_data = UrlData::find($item)->analytics()->get()->toArray();//->whereBetween('pulled_at', array('2014-08-15 15:39:08', '2014-08-28 15:39:08'))->get()->toArray();

            // analytics data with old date.
            $analytics_old = $analytics_data[0]['raw_data'];
            // used json_decode method to obtain data in array form.
            $analytics_old = json_decode($analytics_old, true);

            //echo "<pre>";
            //print_r($analytics_data);

            // analytics data with recent date.
            $analytics_lates = $analytics_data[count($analytics_data)-1]['raw_data'];
            // used jsone_decode to get data in array() instead of php object.
            $analytics_lates = json_decode($analytics_lates, true);

            //echo "second  Analytics array with most recent date <br>";
            //echo "<br> analytics latest<br>";
            //print_r($analytics_lates);
            //exit();

            // final array that contains calculated analytics.    
            $calculated_analytics = array();
            $calculated_analytics['shortUrlClicks'] = ($analytics_lates['modelData']['analytics']['allTime']['shortUrlClicks']) - ($analytics_old['modelData']['analytics']['allTime']['shortUrlClicks']);
            $calculated_analytics['longUrlClicks'] = ($analytics_lates['modelData']['analytics']['allTime']['longUrlClicks']) - ($analytics_old['modelData']['analytics']['allTime']['longUrlClicks']);

            $referrer=$this->getAnalyticsArrays('referrers',$analytics_lates,$analytics_old);
            $calculated_analytics['referrer']=$this->calculateAnalytics($referrer['latest'],$referrer['old']);

            $countries=$this->getAnalyticsArrays('countries',$analytics_lates,$analytics_old);
            $calculated_analytics['countries']=$this->calculateAnalytics($countries['latest'],$countries['old']);

            $browsers=$this->getAnalyticsArrays('browsers',$analytics_lates,$analytics_old);
            $calculated_analytics['browsers']=$this->calculateAnalytics($browsers['latest'],$browsers['old']);

            $platforms=$this->getAnalyticsArrays('platforms',$analytics_lates,$analytics_old);
            $calculated_analytics['platforms']=$this->calculateAnalytics($platforms['latest'],$platforms['old']);




            //echo "<pre>";
            //echo "Record obtained between two dates";
            //var_dump($analytics_data);

            //echo "first  Analytics array with old date.<br>";
            //print_r($analytics_old);

            //echo "latest platforms<br>";
            //print_r($platforms['latest']);
            //echo "old platforms<br>";
            //print_r($platforms['old']);
            //echo "calculated analytics<br><br>";
            //print_r($calculated_analytics);
            //exit();
            /**********************************************************************************/




            $url_data[$index]->shortUrlClicks=$calculated_analytics['shortUrlClicks'];
            $url_data[$index]->longUrlClicks=$calculated_analytics['longUrlClicks'];
            $url_data[$index]->referrer=$calculated_analytics['referrer'];
            $url_data[$index]->countries=$calculated_analytics['countries'];
            $url_data[$index]->browsers=$calculated_analytics['browsers'];
            $url_data[$index]->platforms=$calculated_analytics['platforms'];
            $index ++;
        }
        
        echo "<pre>";
        print_r($url_data);
        exit();
        //generate CSV of data array and save into given location.
        CSV::with($url_data)->put(storage_path() . '/downloads/myusers.csv');   
        // contains path of download file, this path will be used by ajax script to download file.
        exit();
        $path=URL::to('/downloadCSV');
        echo $path;
        
        
        
    }

    /**
     * download a csv file (usually called via ajax).
     *
     * @return download file generated by exportCsv file.
     */
    public function downloadCsv() {
        $headers = array(
            'Content-Type: application/pdf',
        );
        return Response::download(storage_path() . '/downloads/myusers.csv', 'analytics.csv', $headers);
        
    }
    /*
     * @Descriptin: code to check for each referrer 'id' from latest array to its corresponding old array.
     *     like for referrer_latest ['unkown'] it will search for unkown if exist in old array,
     *     if exist then subtract its value from latest.
     * 
     * @param: array() Latest analytics data array.
     * 
     * @param: array() Old date analytics array.      
     * 
     * @return: array()  Result analytics calculated from two input arrays.
     */

    function calculateAnalytics($latest_data,$old_data=null)
    {
        //flag variable to check if corresponding element found in old array.
        $found=false;
        // result array hold the final calculated results.
        $result=array();
        foreach ($latest_data as $latest)
        {
            $temp['id']= $latest['id'];
            foreach ($old_data as $old)
            {
                //if corresponding element found in old array (like referrer_unkown=123 in old array)
                if(in_array($latest['id'], $old))
                {
                    $temp['count']=$latest['count']-$old['count'];
                    $found=true;
                    break;
                }

            }
            // if corressponding element not found in old array, then subtract just 0 (its new element).
            if(!$found)
            {
                $result[]['count']=$latest['count']-0;
            }
            $result[]=$temp;

        }
        return $result;
    }
    /*
     * @Description: Extract desired array from raw data, 
     *   (example: if 'referrer' provided as arrayKey, referrer 
     *    array will be extracted from both  old and latest raw data.
     * 
     * @param: string   array key that will be extracted from whole raw data array. 
     * 
     * @param: array()  latest analytics of a url obtained from url_analytics table
     * 
     * @param: array()  old analytics of a url obtained from url_analytics table
     * 
     * @return array()  result array that extract values from both latest and old array.
     */
    function getAnalyticsArrays( $arraykey,$lates,$old )
    {
        $result=array();

        //check if referrer array exist in latest analytics
        if (array_key_exists($arraykey, $lates['modelData']['analytics']['allTime'])) 
        {
            $result['latest']=$lates['modelData']['analytics']['allTime'][$arraykey];
        }
        //check if referrer array exist in old analytics
        if (array_key_exists($arraykey, $old['modelData']['analytics']['allTime']))
        {
            $result['old']=$old['modelData']['analytics']['allTime'][$arraykey];
        }
        return $result;
    }
    

}
