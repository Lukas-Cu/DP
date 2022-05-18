<!doctype html>
<html lang="en">
<head>
<?php
	$sql_typ = "'%'";
	$sql_hodnota = "'%'";
	$sql_ukaz_sloupce = "*";
	$sql_cas = "'%'";
?>
	<meta charset="utf-8">
	<title>Vypis elektromeru</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<?php
	$servername = "localhost";
	$username = "elektromer";
	$password = "raspberry";
	$dbname = "elektromer";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	  die("Connection failed: " . $conn->connect_error);
	}

	$sql = "SELECT ".$sql_ukaz_sloupce." FROM log WHERE TYP LIKE ". $sql_typ." AND HODNOTA LIKE ".$sql_hodnota." AND cas LIKE ".$sql_cas;
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
	  // output data of each row
	  echo "<table border=1>";
	  $first_line = true;
	  while($row = $result->fetch_assoc()) {
	    if ($first_line) {
	      foreach($row as $row_key => $row_value) {
	        echo "<th>".$row_key."</th>";
	      }
	      $first_line = false;
	    }
	    $first_item = true;
	    echo "<tr>";
	    foreach ($row as $row_key => $row_value) {
	      if ($first_item) {
	        $first_item = false;
	      }
              echo "<td>" . $row_value . "</td>";
	    }
	    echo "</tr>";
	  }
	} else {
	  echo "0 results";
	}
	$conn->close();
?>
</body>
</html>
