<?php
//http://php.net/manual/en/function.mysql-connect.php
$link = mysql_connect('mysql.hostinger.com.ua', 'u463638321_w', 'WW3895738qq');

mysql_set_charset('utf8',$link);
$db  =  mysql_select_db('u463638321_w');
if (!$link) {
    die('Could not connect: ' . mysql_error());
}

//http://stackoverflow.com/questions/6281963/how-to-build-a-json-array-from-mysql-database
$return_arr = array();


$fetch = mysql_query("SELECT * FROM restaurant ORDER BY restaurant_timestamp DESC");
while ($row = mysql_fetch_array($fetch, MYSQL_ASSOC)) {
    $row_array['restaurant_id'] = $row['restaurant_id'];
    $row_array['restaurant_id_name'] = $row['restaurant_id_name'];
    $row_array['restaurant_name'] = $row['restaurant_name'];
    $row_array['restaurant_type'] = $row['restaurant_type'];
    $row_array['restaurant_thumbnail'] = $row['restaurant_thumbnail'];
    $row_array['restaurant_work_time'] = $row['restaurant_work_time'];
    $row_array['restaurant_telephone'] = $row['restaurant_telephone'];
    $row_array['restaurant_latitude'] = $row['restaurant_latitude'];
    $row_array['restaurant_longitude'] = $row['restaurant_longitude'];

    array_push($return_arr,$row_array);
}
echo json_encode($return_arr);
mysql_close($link);