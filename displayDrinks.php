<!DOCTYPE html>
<html lang="en">

<head>
    <title>Recipe Warehouse</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"><script src="http://code.jquery.com/jquery.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0-rc1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="stylesheet.css">

    <style>
        body {
            background-color: darkgray;
        }
        h2 {
            color: darkblue;
        }
        td {
            font-size: x-large;
        }
        .roundBox {
            background-color: white;
            border: 2px solid #a1a1a1;
            border-radius: 25px;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">
                    <h2 style="color: orangered;"><span class="glyphicon glyphicon-glass"></span>
                        Team Recipe<small> Vote for Pedro!</small></h2></a>
            </div>
            <div>
                <ul class="nav navbar-nav">
                    <li class="active"><a href="#">Home</a></li>
                    <li><a href="#">Browse</a></li>
                    <li><a href="#">Search</a></li>
                    <li><a href="#">Log In / Register</a></li>
                </ul>
            </div>
        </div>
    </nav>
<!-- Page container -->
<div class="container">
<!-- <h1><span class="glyphicon glyphicon-glass" style="padding: 25px 10px;"></span>Team Recipe<small> Vote for Pedro!</small></h1>
    -->

<div class="row">
    <!--Left Sidebar Content -->
	<div class="col-md-2" style="padding: 25px 10px;">
	<h2>Left Sidebar</h2>
    <br/>
    <?php
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
    
        $categories = "SELECT DISTINCT Category FROM TestTable";
        $catResults = mysqli_query($conn, $categories);
        $totalCats = mysqli_num_rows($catResults);
        
        if($totalCats > 0) 
        {
            while($row = $catResults->fetch_assoc()) 
            {
                echo $row["recipeName"] . "<br>";
            }
        } 
        else 
        {
            echo "No categories found!";
        }
        ?>
	</div>
    <!-- End left sidebar -->
	
    <!-- Main content area -->
	<div class="col-md-8 roundBox" style="padding: 25px 10px;">
	<h2>MySQL Test</h2><br /><br />
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
    echo "<br><br>";
    
    $query = "SELECT * from TestTable";
    $results = mysqli_query($conn, $query);
    $total_results = mysqli_num_rows($results);
    
    echo "Total number of recipes: " . $total_results . "<br /><br />";
    
	echo "<table>";
    echo "<tr><td colspan=2>Recipe</td><td colspan=2>Ingredient</td><td>Instructions</td></tr>";
    if ($total_results > 0) {
        // output data of each row
        while($row = $results->fetch_assoc()) {
            echo "<tr>";
            echo "<td><img src=\"" . $row["image"] . ".jpg\"></td>";
            echo "<td> " . $row["recipeName"] . "</td>";
            echo "<td>" . $row["meas"] . "</td>";
            echo "<td>" . $row["ingrName"] . "</td>";
            echo "</tr>";
            echo "</tr><td colspan=5>" . $row["mixInstructions"] . "</td></tr>"; 
        }
    } else {
        echo "0 results";
    }
    echo "</table>";
    ?>
    <br/>
	</div>
    <!-- End main content area -->
	
    <!-- Right sidebar -->
	<div class="col-md-2" style="padding: 25px 10px;">
	<h2>Right Sidebar</h2>
    Vivamus mattis aliquet velit nec cursus. Donec maximus volutpat sagittis. Suspendisse potenti - 
    blah, blah, blah - lorem ipsum.<br /><br />
    The PHP cartridge is working as well as the MySQL and PHPMyAdmin.<br /><br />
    <br />
	</div>
    <!-- End right sidebar -->

</div>

<div class="row">
	<div class="col-md-12" style="padding: 25px 10px;">
	<h2>Full 12 Column Width<small> With a paragraph tag...</small></h2>
	<p>Nam lacinia metus nisi, at pulvinar justo finibus sed. Nulla congue velit ac elit congue rutrum. Mauris finibus sollicitudin ligula, nec dictum elit faucibus porttitor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nullam vestibulum, purus non finibus rutrum, nisi lorem egestas leo, eget vestibulum tortor massa eget leo. Cras vel ultricies felis. Mauris rhoncus augue dui, et sodales dui gravida aliquet. Etiam auctor velit eget metus mollis egestas. Duis faucibus dictum dictum. Integer purus purus, rutrum feugiat dui sed, pretium condimentum urna. Vestibulum at elit lacinia, convallis enim ut, dictum sapien. Proin fermentum ex non augue rutrum facilisis. Praesent eu rhoncus risus, eget sagittis dolor. Ut at elementum odio.</p>
	<br /></div>
</div>

</div>
<!-- End page container -->

<?php
    $conn->close();
?>

</body>

</html>