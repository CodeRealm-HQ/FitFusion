<?php

use voku\helper\AntiXSS;

require_once __DIR__ . '../../classes/anti-xss/autoload.php';
require_once __DIR__ . '../../classes/phpmailer/vendor/phpmailer/phpmailer/src/Exception.php';
require_once __DIR__ . '../../classes/phpmailer/vendor/phpmailer/phpmailer/src/PHPMailer.php';
require_once __DIR__ . '../../classes/phpmailer/vendor/phpmailer/phpmailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function connect(){

    global $database;

    try{
        $connect = new PDO('mysql:host='.$database['host'].';dbname='.$database['db'],$database['user'],$database['pass'], array(
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES  \'UTF8\''));
        return $connect;
        
    }catch (PDOException $e){
        return false;
    }
}

function getImage($src){

    return SITE_URL.'/images/'.$src;
}

function getStrings($connect){
    
    $sentence = $connect->prepare("SELECT * FROM strings"); 
    $sentence->execute();
    return $sentence->fetch();
}

function countFormat($num) {

      if($num>1000) {

        $x = round($num);
        $x_number_format = number_format($x);
        $x_array = explode(',', $x_number_format);
        $x_parts = array('k', 'm', 'b', 't');
        $x_count_parts = count($x_array) - 1;
        $x_display = $x;
        $x_display = $x_array[0] . ((int) $x_array[1][0] !== 0 ? '.' . $x_array[1][0] : '');
        $x_display .= $x_parts[$x_count_parts - 1];

        return $x_display;
    }

  return $num;
}

function formatHTML($content){

    $content = str_replace(array("\n","\r","\t"),'', $content);
    $content = str_replace("</li>", "</li><br />", $content);
    $content = str_replace("</h1>", "</h3><br />", $content);
    $content = str_replace("</h2>", "</h3><br />", $content);
    $content = str_replace("</h3>", "</h3><br />", $content);
    $content = str_replace("</h4>", "</h3><br />", $content);
    $content = str_replace("</h5>", "</h3><br />", $content);
    $content = str_replace("</h6>", "</h3><br />", $content);
    return $content;
    
}

function clearGetData($data){

    $antiXss = new AntiXSS();
    $data = $antiXss->xss_clean($data);
    return $data;
}

function getParamsQuery(){
    
    return isset($_GET['query']) && !empty($_GET['query']) && $_GET['query'] ? clearGetData($_GET['query']) : NULL;
}

function getParamsCategory(){
    
    return isset($_GET['category']) && !empty($_GET['category']) && $_GET['category'] ? clearGetData($_GET['category']) : NULL;
}

function getParamsFeatured(){
    
    return isset($_GET['featured']) && !empty($_GET['featured']) && $_GET['featured'] ? clearGetData($_GET['featured']) : NULL;
}

function getParamsGoal(){
    
    return isset($_GET['goal']) && !empty($_GET['goal']) ? clearGetData($_GET['goal']) : NULL;
}

function getParamsLevel(){
    
    return isset($_GET['level']) && !empty($_GET['level']) ? clearGetData($_GET['level']) : NULL;
}

function getParamsPrice(){
    
    return isset($_GET['price']) && !empty($_GET['price']) ? clearGetData($_GET['price']) : NULL;
}

function getParamsDay(){
    
    return isset($_GET['day']) && !empty($_GET['day']) ? clearGetData($_GET['day']) : NULL;
}

function getParamsEquipment(){
    
    return isset($_GET['equipment']) && !empty($_GET['equipment']) ? clearGetData($_GET['equipment']) : NULL;
}

function getParamsMuscle(){
    
    return isset($_GET['muscle']) && !empty($_GET['muscle']) ? clearGetData($_GET['muscle']) : NULL;
}

function getParamsTag(){
    
    return isset($_GET['tag']) && !empty($_GET['tag']) ? clearGetData($_GET['tag']) : NULL;
}

function getParamsType(){
    
    return isset($_GET['type']) && !empty($_GET['type']) ? clearGetData($_GET['type']) : NULL;
}

function getParamsUser(){
    
    return isset($_GET['user']) && !empty($_GET['user']) ? clearGetData($_GET['user']) : NULL;
}

function getParamsID(){
    
    return isset($_GET['id']) && !empty($_GET['id']) ? clearGetData($_GET['id']) : NULL;
}

function getParamsSort(){
    
    return isset($_GET['sortby']) && !empty($_GET['sortby']) && $_GET['sortby'] !== 'undefined' ? clearGetData($_GET['sortby']) : NULL;
}

?>