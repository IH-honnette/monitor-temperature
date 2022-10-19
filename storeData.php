<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include "database.php";


$database = new Database();
$connection = $database->getConnection();

$data = json_decode(file_get_contents("php://input"));

if(!empty($data->device) && !empty($data->temperature)) {
   
   $device= $data->device;
   $temperature= $data->temperature;
$addQuery= mysqli_query($connection,"INSERT INTO temperatures(device, temperature)
     VALUES ('$device','$temperature');");
   if($addQuery) {
      http_response_code(201);     
       echo json_encode(
        array("message" => "Successfully added data.")
    );
   }else{
      http_response_code(404);     
      echo json_encode(
          array("Error Occurred: ".mysqli_error($connection))
      );
   }
}else {
   http_response_code(400);     
   echo json_encode(
    array("message" => "All fields must not be empty!."));
}
?>

