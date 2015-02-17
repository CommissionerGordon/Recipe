<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1"><script src="http://code.jquery.com/jquery.js"></script

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0-rc1/js/bootstrap.min.js"></script>
    
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="stylesheet.css">
</head>

<body>

<div class="container">
<h1><span class="glyphicon glyphicon-glass" style="padding: 25px 10px;"></span>Team Recipe</h1>
<!-- CAROUSEL -->
<div id="myCarousel" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0"></li>
    <li data-target="#myCarousel" data-slide-to="1" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="2"></li>
    <li data-target="#myCarousel" data-slide-to="3"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
    <div class="item active">
      <img src="banner-alcohol-06.jpg" alt="Booze"><div class="carousel-caption">
	  <!-- Not currently using the captions. We might once the site designers start working their magic. -->
          <h3 style="color: black; text-shadow: 1.5px 1.5px #333333"></h3>
      </div>
    </div>

    <div class="item">
      <img src="banner-Absolut-2.jpg" class="img-rounded" alt="Booze">
	  <div class="carousel-caption">
          <h3 style="color: black; text-shadow: 1.5px 1.5px #333333"></h3>
      </div>
    </div>

    <div class="item">
      <img src="banner-alcohol-06.jpg" class="img-rounded" alt="More Booze!">
	  <div class="carousel-caption">
          <h3 style="color: black; text-shadow: 1.5px 1.5px #333333"></h3>
      </div>
    </div>

    <div class="item">
      <img src="banner-Bottles.jpg" class="img-rounded" alt="But wait! There's more!">
	  <div class="carousel-caption">
          <h3 style="text-shadow: 1.5px 1.5px #333333"></h3>
      </div>
    </div>
  </div>

  <!-- Left and right controls -->
  <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
<!-- END CAROUSEL -->

<!--
<div class="jumbotron">
<h1><span class="glyphicon glyphicon-glass"></span>Recipe Site</h1>
<br><h1><small> Using Bootstrap CSS</small></h1>
</div>
 -->

<div class="row">

	<div class="col-md-3" style="padding: 25px 10px;">
	<h2>Site Skeleton</h2>
	My initial thoughts about this project were that it was going to be large scope,
    huge learning curve, and have lots of obstacles - both technologically and logistically.
    <br/><br/>
    Because of that mindset, I decided to work on figuring out the initial setup and what would be
    the best way for the team to submit their work. This is the "test page" for what I've been
    working on.<br/>
	</div>
    
	<div class="col-md-3" style="padding: 25px 10px;">
	<h2>PHP Test</h2>
	<?php
	echo "<strong>First Test: </strong>";
    echo "<br>";
    echo "This is a test of whether or not PHP is set up and working correctly on the server.
    If the date and the user's IP address show up, then PHP is working. <br><br>";
	$time = time();
	echo("Server time: " . $time . "<br>");
    echo "Date: " . date('Y-m-d');
    echo "<br><br>";
	$ip = $_SERVER['REMOTE_ADDR'];
	echo "Your IP Address is: ";
	echo $ip;
	?>
    <br/>
	</div>
	
	<div class="col-md-3" style="padding: 25px 10px;">
	<h2>MySQL Test</h2>
    <?php
    echo "<strong>Second test: </strong><br>";
	
    /* Could this be eliminated by including the Connect.php
     * and using $_GET["conn"]; */
    $dbhost = getenv("OPENSHIFT_MYSQL_DB_HOST");
    $dbport = getenv("OPENSHIFT_MYSQL_DB_PORT");
    $dbuser = getenv("OPENSHIFT_MYSQL_DB_USERNAME");
    $dbpwd = getenv("OPENSHIFT_MYSQL_DB_PASSWORD");
    $dbname = getenv("OPENSHIFT_APP_NAME");
    $dbserver = $dbhost . ":" . $dbport;
    // Create connection
    $conn = new mysqli($dbserver, $dbuser, $dbpwd, $dbname);

// Check connection
if (!$conn) {
	echo "Could not connect to DB.";
	} else {
	echo "Connected successfully!";
	}
    echo "<br>";
    
	echo "<br>";
    $query = "SELECT * from TestTable";
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
	
	<div class="col-md-3" style="padding: 25px 10px;">
	<h2>Fabulous Vivamus</h2>
    Vivamus mattis aliquet velit nec cursus. Donec maximus volutpat sagittis. Suspendisse potenti - 
    blah, blah, blah - lorem ipsum.<br/><br/>
    The PHP cartridge is working as well as the MySQL and PHPMyAdmin.<br/><br/>
    I am working on "cheat sheets" for PHP, MySQL, and Git so that everyone can work and push that work to the server. I
    think we can assess this once we all get togehter and figure out who's good at what.
	<br/></div>

</div>

<div class="row">
	<div class="col-md-12" style="padding: 25px 10px;">
	<h2>Full 12 Column Width<small> With a paragraph tag...</small></h2>
	<p>Nam lacinia metus nisi, at pulvinar justo finibus sed. Nulla congue velit ac elit congue rutrum. Mauris finibus sollicitudin ligula, nec dictum elit faucibus porttitor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nullam vestibulum, purus non finibus rutrum, nisi lorem egestas leo, eget vestibulum tortor massa eget leo. Cras vel ultricies felis. Mauris rhoncus augue dui, et sodales dui gravida aliquet. Etiam auctor velit eget metus mollis egestas. Duis faucibus dictum dictum. Integer purus purus, rutrum feugiat dui sed, pretium condimentum urna. Vestibulum at elit lacinia, convallis enim ut, dictum sapien. Proin fermentum ex non augue rutrum facilisis. Praesent eu rhoncus risus, eget sagittis dolor. Ut at elementum odio.</p>
	<br/></div>
</div>

</div>

</body>

</html>