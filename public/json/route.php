<?php
// Here's the argument from the client.
$success = $_POST['myData'];



if ($success == true){

// Set up associative array
$data = array('success'=> true,'message'=>'Success message: hooray!');

// JSON encode and send back to the server
echo json_encode($data);
echo $_POST['myData'];
//echo $success;
}
else{
// Set up associative array
$data = array('success'=> false,'message'=>'Failure message: boo!');

// JSON encode and send back to the server
echo json_encode($data);
}
?>