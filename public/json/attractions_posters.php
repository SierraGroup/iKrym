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


$fetch = mysql_query("SELECT * FROM attraction_poster");
while ($row = mysql_fetch_array($fetch, MYSQL_ASSOC)) {
    $row_array['attraction_id'] = $row['attraction_id'];
    $row_array['attraction_id_name'] = $row['attraction_id_name'];
    $row_array['attraction_poster_name'] = $row['attraction_poster_name'];
    $row_array['attraction_poster_image'] = $row['attraction_poster_image'];
    $row_array['attraction_poster_header'] = $row['attraction_poster_header'];
    $row_array['attraction_poster_date'] = $row['attraction_poster_date'];
    $row_array['attraction_poster_description'] = $row['attraction_poster_description'];

    array_push($return_arr,$row_array);
}
echo json_encode($return_arr);
mysql_close($link);