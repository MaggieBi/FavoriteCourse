<?php 
/* [INFO/CS 1300 Project 3] database.php
 * Utility file for resetting the app. Currently only resets the database. 
 * If needed, you can add more functionality here. E.g. cancel a session.
 *
 */

require('wall_database.php');

$reset_flag = resetDatabase();
if ($reset_flag)
  echo "Successfully reset the database";
else
  echo "Could not reset the database. Please check permissions and try again."
  
?>

