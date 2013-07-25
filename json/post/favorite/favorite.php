<?php
// setup the database connect

$link = mysql_connect('mysql.hostinger.com.ua', 'u463638321_w', 'WW3895738qq');
if (!$link)
    exit;
mysql_select_db('u463638321_w',$link);
$sql = sprintf("INSERT INTO user_favorite(user_id_name,user_favorite_photo,user_favorite_work_time,user_favorite_type,user_favorite_ticket_price) VALUES ('%s','%s','%s','%s','%s')",$_POST['user_id_name'],$_POST['user_favorite_photo'],$_POST['user_favorite_work_time'],$_POST['user_favorite_type'],$_POST['user_favorite_ticket_price']);
// lets run our query
$result = mysql_query($sql, $link);

if($result){
    header("location:http://s-group.in.ua/yalta/attractions");
}



