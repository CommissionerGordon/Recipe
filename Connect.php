<?php

session_start();

    //$serverName = "127.3.156.2:3306";
    //$userName = "adminm2YEpUG";
    //$password = "XmG6hsx8yMeDn7Zy";
    //$dbname = "csc413";
	//  Y57qrEZXaq-h
	
	
$dbhost = getenv("OPENSHIFT_MYSQL_DB_HOST");
$dbport = getenv("OPENSHIFT_MYSQL_DB_PORT");
$dbuser = getenv("OPENSHIFT_MYSQL_DB_USERNAME");
$dbpwd = getenv("OPENSHIFT_MYSQL_DB_PASSWORD");
$dbname = getenv("OPENSHIFT_APP_NAME");
	
// Is this file included? 
echo " The connection file is included. <br>";

// Create connection
$conn = mysql_connect($dbhost, $dbuser, $dbpwd, $dbname);
//$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
	echo "Could not connect to DB.";
	} else {
	echo "Connected successfully!";
	}
	
	echo $conn;
//if ($conn->connect_error) {
 //   die("Connection failed: " . $conn->connect_error);
//} else {
 //   echo "Connection success! ";
//    }
	
/* CODE THAT SHOULD BE USED SPECIFICALLY ON THE PAGE 
 * THAT REQUIRES IT.
 */
//$sql = "SELECT * FROM TestTable";
//$results = $conn->query($sql);
//$total_results = mysqli_num_rows($results);

$query = 'SELECT * FROM TestTable';
echo "<br>Query: ";
echo $query;
$results = mysqli_query($query);
$total_results = mysqli_num_rows($results);

echo "<br>";
echo "Total results: " . $total_results . "<br>";
echo $total_results;
echo "<br>";
echo $query;

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["testTableID"]. " - Name: " . $row["recipeName"]. " " . $row["prepTime"]. "<br>";
    }
} else {
    echo "0 results";
}
/* END CODE */

/* Should this happen at the end of each script?
 * And each script should call Connect.php at it's start?
 */
//$conn->close();
?>