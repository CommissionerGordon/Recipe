<?php

//***Include the class for image resizing
include("ImageResizing-class.php");

//***Initialize/load the image
$resizeObj = new ImageResize('sample.jpg');

//***Resize image(options: exact, portrait, landscape, auto, crop)
$resizeObj -> resizeImage(150, 100, 'crop');

//***Save image
$resizeObj -> saveImage('sample-resized.gif', 100);

?>