<?php
include "database.php";

function storeData(){
	$database = new Database();
	$connection = $database->getConnection();
    $query = "SELECT * from temperatures";
    $exec = mysqli_query($connection,$query);
        $results=[];
    
        while($row = mysqli_fetch_array($exec)){
                array_push($results,$row);
            }
            return $results;
    }

 $data=storeData();
 $dataPoints=[];
 for ($i=0; $i < sizeof($data); $i++) {
    array_push($dataPoints,
    array("label"=>$data[$i]["device"], "y"=> $data[$i]["temperature"]));
 }

?>
<!DOCTYPE HTML>
<html>
<head>  
<script>
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	exportEnabled: true,
	theme: "light2", 
	title:{
		text: "Temperature Chart"
	},
	axisY:{
		includeZero: true
	},
	data: [{
		type: "area", //change type to bar, line, area, pie, etc
		indexLabel: "{y}", //Shows y value on all Data Points
		indexLabelFontColor: "#5A6750",
		indexLabelPlacement: "outside",   
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
}
</script>
</head>
<body>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html>       