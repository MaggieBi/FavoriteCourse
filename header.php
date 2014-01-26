<?php // The name of your app
$APP_TITLE = "Your Favorite Cornell Course";

// Maximum characters for a post by a user.
$CHAR_LIMIT = 1000;

?>
<!-- Sample header content. -->

<!--TODO Add doctype, html and head tags, the opening body tag and whatever 
         elements inside body (e.g. header image and title text) that will be
         common to form.php and posting_wall.php 
-->

<!DOCTYPE html>
<head>
      <title><?php echo $APP_TITLE ?></title>
      <link rel="STYLESHEET" type="text/css" href="stylesheet.css" />
</head>
<body>
<div id="container">
<div id="headerimg">
<p id="headertext"><?php echo $APP_TITLE ?></p>
<img src="images/cornelllogo.jpg" alt="cornelllogo"/>

</div>

