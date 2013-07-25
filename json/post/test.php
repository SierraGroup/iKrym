<?php
// setup the database connect
$link = mysql_connect('mysql.hostinger.com.ua', 'u463638321_w', 'WW3895738qq');
if (!$link)
    exit;
mysql_select_db('u463638321_w',$link);

// check if we can get hold of the form field
if (!$_POST['restaurant_id_name'])
    exit;
// lets setup our insert query

$sql = sprintf("INSERT INTO restaurant(restaurant_id_name) VALUES ('%s')",$_POST['restaurant_id_name']);
// lets run our query
$result = mysql_query($sql, $link);

if($result){
    echo "Send" . $_POST['restaurant_id_name'];
}



