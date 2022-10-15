<?php
require("connection.php");

class sensor
{
	private $id;
	private $nickname;
	private $x;
	private $y;

	#grabs the latest data from the database specified by time
	private function latestData()
	{
		$result = mysql_query("SELECT * FROM `data` WHERE sensor_id =".$this->id." ORDER BY `time` DESC limit 1");
		return mysql_fetch_object($result, 'data');
	}
	
	#print Heat Mapping	with lateset data from database
	public function hMapPrint()
	{
		echo "{x: ".($this->x*100).", y: ".($this->y*120).", count: ".$this->latestData()->temp."},";
	}

	#gathers graphing data to display with highcharts API
	public function graph($lookBack, $skip)
	{
		echo "{";
		echo "name: '$this->nickname',";
		echo "data: [";
		$i =0;
	
		#specifies the location in the MySQL database where to read temperature.
		#Read test.py for more information on configuring database
		$result = mysql_query("SELECT * FROM `data` WHERE `sensor_id`=".$this->id." AND `time` > DATE_ADD(NOW(), INTERVAL -".$lookBack." MINUTE)");
		while($row = mysql_fetch_object($result, 'data'))
		{
			if( $i == $skip)
			{
				echo "[" . $row->getDate() . ", $row->temp],";
				$i = 0;
			}
			$i++;
		}
		echo "]";
		echo "},";
	}
}


?>