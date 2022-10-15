<?php 
require("connection.php");

class data
{
	private $id;
	public $sensor_id;
	public $time;
	public $temp;
	public function getDate()
	{
		$timeParsed = strtotime($this->time);
		list($year, $month, $other) = split('-',$this->time);
		list($day, $other) = split(' ', $other);
		list($hour, $minute, $second) = split('[-./:]', $other);
		return "Date.UTC($year, $month-1, $day, $hour, $minute, $second)";
	}
}

function connect()#function to connect to MySQL database
{
	//host, username, passsword
	mysql_connect('localhost', 'admin', 'password');
	mysql_select_db("monitor");//database name
}

function sensors()#specifies which sensor to grab data (temperature) from to
#to display on the graph
{
	$res = array();
	$result = mysql_query("SELECT * FROM sensors");
	$i=0;
	while($row = mysql_fetch_object($result, 'sensor'))
	{
		$res[$i] = $row;
		$i++;
	}
	return $res;
}

#prints which sensor is reading the temperature to the graph
function hMapPrint()
{
	$sensors = sensors();
	foreach($sensors as &$sensor)
	{
		echo $sensor->hMapPrint();
	}
}

function graphData($lookBack, $skip)
{
	$sensors = sensors();
	foreach($sensors as &$sensor)
	{
		$sensor->graph($lookBack, $skip);
	}
}
?>