<?php

    //header('Content-Type: application/json');
    //http://stackoverflow.com/questions/10950507/ajax-send-json-and-fetch-data-using-php
    //получаем данные с json-формата

    //http://stackoverflow.com/questions/15380192/firebug-shows-posted-json-data-using-ajax-but-php-says-post-is-empty
//                if(!isset($_POST['input_name'])){
//                        died('We are sorry, but there appears to be a problem with the form you submitted.');
//                }

print_r($_POST);
$data = file_get_contents("php://input");
print_r($data);

if(isset($_POST["json"])){
    $json = stripslashes($_POST["json"]);
    $output = json_decode($json);


    // Now you can access your php object like so
    // $output[0]->variable-name
}