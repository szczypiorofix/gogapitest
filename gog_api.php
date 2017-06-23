<?php

class App
{
    private static $output;
    
    private function __construct() {}
    private function __clone() {}
    
    public static function init() {
        $gogApi = new GogApiApp();
        self::$output = $gogApi->getContent('GET', '1440163901'); // INSERT GAME ID HERE
        self::$output .= $gogApi->getUserData('GET', '842773838996');
    }
    
    public static function showOutput() {
        //echo '<pre>'.self::$output.'</pre>';
        echo self::$output;
    }
}

class GogUser
{
    public $userId;
    public $username;
    
    public function __construct() {}
}

class GogGameContent
{
    public $id;
    public $title;
    public $description;
    public $whats_cool_about_it;
    public $languages = [];
    
    public function __construct() {}
}

class GogApiApp
{
    public function __construct() {}
    
    private function getDataFromAPI($url, $type, $args) {
        $c = curl_init();
        curl_setopt($c, CURLOPT_HEADER, 0);
        curl_setopt($c, CURLOPT_VERBOSE, 0);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($c, CURLOPT_URL, $url);
        //url_setopt($c, CURLOPT_CAINFO, dirname(__FILE__) .  '/trello.com.crt');

        if (count($args)) {
            curl_setopt($c, CURLOPT_POSTFIELDS, http_build_query($args));
        }

        switch ($type) {
            case 'POST':
                curl_setopt($c, CURLOPT_POST, 1);
                break;
            case 'GET':
                curl_setopt($c, CURLOPT_HTTPGET, 1);
                break;
            default:
                curl_setopt($c, CURLOPT_CUSTOMREQUEST, $type);
        }
        $data = curl_exec($c);
        echo curl_error($c);
        curl_close($c);
        return json_decode($data);
        
        // JS - how to get Trello Token from Local Storage
        //console.log(localStorage.trello_token);
    }
    
    public function getUserData($type, $request, $args = false)
    {
        if (!$args) {
            $args = array();
        } elseif (!is_array($args)) {
            $args = array($args);
        }

         // http://api.gog.com/products/1207658691?expand=description
        $url = 'users.gog.com/users/' . $request;
        $dataFromAPI = $this->getDataFromAPI($url, $type, $args);
        $gogUser = new GogUser();
        $content = '';
        
//        if ($dataFromAPI !== '') {
//            $gogGameContent->id = $dataFromAPI->id;
//            $gogGameContent->title = $dataFromAPI->title;
//            $gogGameContent->description = $dataFromAPI->description;
//            $gogGameContent->languages = get_object_vars($dataFromAPI->languages);
//            
//            $content .= '<p class="stat"><b>Name</b></p><h3>'.$gogGameContent->title.'</h3>';
//            $content .= '<p class="stat"><b>ID</b></p><p>'.$gogGameContent->id.'</p>';
//            $content .= '<p class="stat"><b>Languages</b></p><p>';
//            foreach ($gogGameContent->languages as $lang) {
//                $content .= $lang.', ';
//            }
//            $content .= '</p>';
//            $content .= '<p class="stat"><b>Description (short)</b></p><p>'.$gogGameContent->description->lead.'</p>';
//            $content .= '<p class="stat"><b>Description (full)</b></p><p>'.$gogGameContent->description->full.'</p>';
//            $content .= '<p class="stat"><b>What is cool about this game?</b></p><p>'.$gogGameContent->description->whats_cool_about_it.'</p>';
//        }
        
        $content = print_r($dataFromAPI);
        
        return $content;
    }
    
    public function getContent($type, $request, $args = false)
    {
        if (!$args) {
            $args = array();
        } elseif (!is_array($args)) {
            $args = array($args);
        }

         // http://api.gog.com/products/1207658691?expand=description
        $url = 'http://api.gog.com/products/' . $request . '?expand=description';
        $dataFromAPI = $this->getDataFromAPI($url, $type, $args);
        
        $gogGameContent = new GogGameContent();
        $content = '';
        if ($dataFromAPI !== '') {
            $gogGameContent->id = $dataFromAPI->id;
            $gogGameContent->title = $dataFromAPI->title;
            $gogGameContent->description = $dataFromAPI->description;
            $gogGameContent->languages = get_object_vars($dataFromAPI->languages);
            
            $content .= '<p class="stat"><b>Name</b></p><h3>'.$gogGameContent->title.'</h3>';
            $content .= '<p class="stat"><b>ID</b></p><p>'.$gogGameContent->id.'</p>';
            $content .= '<p class="stat"><b>Languages</b></p><p>';
            foreach ($gogGameContent->languages as $lang) {
                $content .= $lang.', ';
            }
            $content .= '</p>';
            $content .= '<p class="stat"><b>Description (short)</b></p><p>'.$gogGameContent->description->lead.'</p>';
            $content .= '<p class="stat"><b>Description (full)</b></p><p>'.$gogGameContent->description->full.'</p>';
            $content .= '<p class="stat"><b>What is cool about this game?</b></p><p>'.$gogGameContent->description->whats_cool_about_it.'</p>';
        }
        
        //$content = print_r($dataFromAPI);
        
        return $content;
    }
}