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


$fetch = mysql_query("SELECT * FROM attraction ORDER BY attraction_timestamp DESC");
while ($row = mysql_fetch_array($fetch, MYSQL_ASSOC)) {
    $row_array['attraction_id'] = $row['attraction_id'];
    $row_array['attraction_id_name'] = $row['attraction_id_name'];
    $row_array['attraction_name'] = $row['attraction_name'];
    $row_array['attraction_type'] = $row['attraction_type'];
    $row_array['attraction_main_photo'] = $row['attraction_main_photo'];
    $row_array['attraction_time_work'] = $row['attraction_time_work'];
    $row_array['attraction_telephone'] = $row['attraction_telephone'];

    array_push($return_arr,$row_array);
}
echo json_encode($return_arr);
mysql_close($link);