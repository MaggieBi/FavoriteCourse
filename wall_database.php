<?php
/* [INFO/CS 1300 Project 3] database.php
 * Database driver for our file database that stores previous user posts
 * 
 * Note: A simple implementation. In database parlance, this implementation will
 * have an undefined behavior on concurrent reads and writes. But good enough
 * for our purposes.
 */
 
// Name for your database file.
$DATABASE_FILE = "posts.dat";

// Delimiter for database entries. DO NOT CHANGE.
$DATABASE_EOL = "&|\n";

function saveCurrentPost($post_fields, $db_filename = null, $db_eol = null){
  /* Function to save current user post to the database. For most uses, you will
     only need to specify $post_fields
   Args:
    $post_fields: An associative array containing all the fields 
                  that make up a post
    $db_filename: The name of the database file being used (optional)
    $db_eol: Delimiter for database entries (optional)
   Returns:
    $success_flag: TRUE if save was successful, FALSE otherwise
  */
  if(is_null($db_filename))
    $db_filename = $GLOBALS['DATABASE_FILE'];
  if(is_null($db_eol))
    $db_eol = $GLOBALS['DATABASE_EOL'];
  
  $success_flag = TRUE;  
  $data_file = fopen($db_filename,"a");
  if ($data_file) {
    $post_data = json_encode($post_fields);
    $success_flag = fwrite($data_file, $post_data.$db_eol);
    fclose($data_file);
  } else {
    $success_flag = FALSE;
  }  
  return (bool)$success_flag;
}

function getAllPosts($db_filename = null, $db_eol = null) {
  /* Function to fetch all posts stored in the database. For most uses, this
     function does not require any parameter.
     Args:
      $db_filename: The name of the database file being used (optional)
      $db_eol: Delimiter for database entries (optional)
     Returns:
      $posts_array: An array containing all the posts. Each post is returned as 
      an associative array over its fields. In case of an error, or an empty 
      database, an array of size 0 is returned.
  */
  if (is_null($db_filename))
    $db_filename = $GLOBALS['DATABASE_FILE'];
  if(is_null($db_eol))
    $db_eol = $GLOBALS['DATABASE_EOL'];
   
  $posts_data = file_get_contents($db_filename);
  $posts_array = array();
  if ($posts_data) {
    $json_array = explode($db_eol, trim($posts_data, $db_eol));
  
    foreach($json_array as $post){
      $current_post = json_decode($post, TRUE);
      $posts_array[] = $current_post;
    }
  }
  return $posts_array;
}

function resetDatabase($db_filename = null){
  /* Function to delete all posts from the database.
     Args:
      $db_filename: The name of the database file being used (optional)
     Returns:
      $success_flag: TRUE if reset was successful, FALSE otherwise
  */
  if (is_null($db_filename))
    $db_filename = $GLOBALS['DATABASE_FILE'];
  $success_flag = TRUE;
  $data_file = fopen($db_filename,"w");
  if (!$data_file)
    $success_flag = FALSE;
  fclose($data_file);
  return $success_flag;
}
