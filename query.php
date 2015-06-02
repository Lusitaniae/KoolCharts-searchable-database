<?php
ini_set('display_errors', 1); //DEV ONLY

$minRows = 3;


// For extra security limit db user to read only access
$mysqli = mysqli_connect( 'localhost', 'root', '', 'database' );

if(mysqli_connect_errno()) {
	// send debug info to developer and hide from user
	 mysqli_connect_errno(); 
	//exit();
}

//sanitize input
$comp = str_replace("%20", "", $_GET["t"]);

if (strlen($comp) < 3 || strlen($comp) > 6 ) 
	exit();
 


/* Create a prepared statement */
$stmt = $mysqli -> prepare(" SELECT * FROM datatable WHERE name = ? GROUP BY id ASC LIMIT 12");
print	$stmt->error;
 	$stmt -> bind_param("s", $comp); print	$stmt->error;

 	$stmt -> execute();print	$stmt->error;

  	$stmt -> bind_result($id, $name, $s1, $s2, $s3);print	$stmt->error;

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


			// if < x fallback todefault
		}print	$stmt->error;
		echo "\n]";	
		//echo '[{ "company" : "'. $name.'" }]';
	}else{
		//echo '[{ "status" : "n/a data" }]';
	}

	$stmt -> close();



$mysqli -> close();


?>