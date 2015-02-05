<?php
session_start();

$servername = "";
$username = "";
$password = "";
$dbname = "";
	
// Is this file included? 
echo " The connection file is included. <br>";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Connection success! ";
    }
	
/* CODE THAT SHOULD BE USED SPECIFICALLY ON THE PAGE 
 * THAT REQUIRES IT.
 */
$query = 'SELECT * FROM TestTable';
$results = mysqli_query($query);
$total_results = mysqli_num_rows($results);

echo "Total results: " . $total_results . "<br>";
echo $total_results;
echo "<br>";
echo $query;
/*
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["testTableID"]. " - Name: " . $row["recipeName"]. " " . $row["prepTime"]. "<br>";
    }
} else {
    echo "0 results";
}*/
/* END CODE */

/* Should this happen at the end of each script?
 * And each script should call Connect.php at it's start?
 */
$conn->close();
?>