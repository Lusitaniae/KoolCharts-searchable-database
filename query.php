<?php
ini_set('display_errors', 0); 

$minRows = 3;
$limit = 0;


// For extra security limit dbuser to SELECT only permissions on the respective db
$mysqli = mysqli_connect( 'localhost', 'root', '', 'database' );

if(mysqli_connect_errno()) {
	// send debug info to developer and hide from user
	//mysqli_connect_errno(); 
	exit();
}

//sanitize input
$comp = str_replace("%20", "", $_GET["t"]);

if (strlen($comp) < 3 || strlen($comp) > 6 ) 
	exit();
 


/* Create a prepared statement */
if( $stmt = $mysqli -> prepare(" SELECT * FROM datatable WHERE name = ? GROUP BY id ASC LIMIT 12")){

 	$stmt -> bind_param("s", $comp);

 	$stmt -> execute();

  	$stmt -> bind_result($id, $name, $s1, $s2, $s3);

  	$stmt->store_result();

	if( $stmt->num_rows >= $minRows ){

	 	$prefix = '';
		echo "[\n";
		$i = 0;

	 	while ($stmt->fetch()){
	 		$i++;

			echo $prefix . " {\n";
			echo '  "Day": "' . $i . '",' . "\n";
			echo '  "Um": ' . $s1 . ',' . "\n";
			echo '  "Dois": ' . $s2 . ',' . "\n";
			echo '  "Tres": ' . $s3 . '' . "\n";
			echo " }";
			$prefix = ",\n";


			// if < x fallback to default
		}
		echo ',	{ "company" : "'. $name.'" }';
		echo "\n]";	
		//echo '[{ "company" : "'. $name.'" }]';
	}else{
		echo '[{ "status" : "n/a data" }]';
	}

	$stmt -> close();
}else
	echo '[{ "status" : "n/a data" }]';




$mysqli -> close();


?>