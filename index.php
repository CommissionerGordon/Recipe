<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="stylesheet.css">
</head>

<body>

<!-- <?php include 'Connect.php';?> -->

<div class="container">

<div class="jumbotron">
<h1>Recipe Site</h1>
<br><h1><small> Using Bootstrap CSS</small></h1>
</div>

<div class="row">

	<div class="col-md-3">
	<h2>Skeleton</h2>
	My initial thoughts about this project were that it was going to be large scope,
    huge learning curve, and have lots of obstacles - both technologically and logistically.
    <br/><br/>
    Because of that mindset, I decided to work on figuring out the initial setup and what would be
    the best way for the team to submit their work. This is the "test page" for what I've been
    working on.<br/>
	</div>
    
	<div class="col-md-3">
	<h2>PHP Test</h2>
	<?php
	echo "<strong>First Test: </strong>";
    echo "<br>";
    echo "This is a test of whether or not PHP is set up and working correctly on the server.
    If the date and the user's IP address show up, then PHP is working. <br><br>";
    echo "Date: " . date('Y-m-d');
    echo "<br><br>";
	$ip = $_SERVER['REMOTE_ADDR'];
	echo "Your IP Address is: ";
	echo $ip;
	?>
    <br/>
	</div>
	
	<div class="col-md-3">
	<h2>MySQL Test</h2>
    <?php
    echo "<strong>Second test: </strong>";
    echo "<br>";
    
    $serverName = "127.3.156.2:3306";
    $userName = "adminm2YEpUG";
    $password = "Y57qrEZXaq-h";
    $dbname = "csc413";
    // Create connection
    $conn = new mysqli($serverName, $userName, $password, $dbname);
    // Check connection
    if ($conn->connect_error) 
    {
        die ("Connection failed: " . $conn->connect_error);
    } else {
        echo "Successfully connected to DB!<br>";
    }
    
    $query = "select testTableID, recipeName, prepTime from TestTable";
    $results = mysqli_query($conn, $query);
    $total_results = mysqli_num_rows($results);
    
    echo "Total number of recipes: " . $total_results . "<br><br>";
    
    if ($total_results > 0) {
        // output data of each row
        while($row = $results->fetch_assoc()) {
            echo "Recipe: " . $row["recipeName"]. ",  Prep Time: " . $row["prepTime"]. " minutes<br>";
        }
    } else {
        echo "0 results";
    }
    ?>
    <br/>
	</div>
	
	<div class="col-md-3">
	<h2>Fabulous Vivamus</h2>
    Vivamus mattis aliquet velit nec cursus. Donec maximus volutpat sagittis. Suspendisse potenti - 
    blah, blah, blah - lorem ipsum.<br/><br/>
    The PHP cartridge is working as well as the MySQL and PHPMyAdmin.<br/><br/>
    I am working on "cheat sheets" for PHP, MySQL, and Git so that everyone can work and push that work to the server. I
    think we can assess this once we all get togehter and figure out who's good at what.
	<br/></div>

</div>

<div class="row">
	<div class="col-md-12">
	<h2>Full 12 Column Width<small> With a paragraph tag...</small></h2>
	<p>Nam lacinia metus nisi, at pulvinar justo finibus sed. Nulla congue velit ac elit congue rutrum. Mauris finibus sollicitudin ligula, nec dictum elit faucibus porttitor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nullam vestibulum, purus non finibus rutrum, nisi lorem egestas leo, eget vestibulum tortor massa eget leo. Cras vel ultricies felis. Mauris rhoncus augue dui, et sodales dui gravida aliquet. Etiam auctor velit eget metus mollis egestas. Duis faucibus dictum dictum. Integer purus purus, rutrum feugiat dui sed, pretium condimentum urna. Vestibulum at elit lacinia, convallis enim ut, dictum sapien. Proin fermentum ex non augue rutrum facilisis. Praesent eu rhoncus risus, eget sagittis dolor. Ut at elementum odio.</p>
	<br/></div>
</div>


</div>

</body>

</html>