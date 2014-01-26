<?php 
/* [INFO/CS 1300 Project 3] index.php 
 * Main page for our app.
 * Shows all previous posts and highlights the current user's post, if any.
 * Includes a link to form.php if user wishes to create and submit a post.
 */ 

require('wall_database.php');
require('header.php');

?>

<div id="wrapper">

<p><a href="form.php">Submit a Post</a></p>
<?php


function findDeptName($number){

/*Function to find the index of the first occurrence of an integer in the course number

Args: $number: A string containing the course number and name
Returns:$num_loc if an integer is found, 0 if no integer is found
*/

$parts = str_split($number);

$first_num = -1;
$num_loc = 0;
foreach ($parts AS $a_char) {
	if (is_numeric($a_char)) {
		$first_num = $num_loc;
		break;
	}
	$num_loc++;
}

if ($first_num > -1||$num_loc>1) {
	return $num_loc;
} else {
	return 0;
}
}


// Checking if a form was submitted
if (!empty($_REQUEST['username'])||!empty($_REQUEST['number'])||!empty($_REQUEST['comment'])
||!empty($_REQUEST['college'])||!empty($_REQUEST['college'])){

// Set the post as valid for now
$is_valid_post = true;

// Fetching data from the request sent by form.php  
$username = $_REQUEST['username'];
$number = $_REQUEST['number'];
$comment = $_REQUEST['comment'];
$college = $_REQUEST['college'];
$workload = $_REQUEST['workload'];

// Assign N/A for optional values if it's not filled
if(empty($_REQUEST['year'])){
$year="N/A";}
else{
$year=$_REQUEST['year'];}

if(empty($_REQUEST['easiness'])){
$easiness="N/A";}
else{
$easiness=$_REQUEST['easiness'];}

if(empty($_REQUEST['prof'])){
$prof="N/A";}
else{
$prof=$_REQUEST['prof'];}

if (isset($_REQUEST['username'])){
// Fetching data from the request sent by form.php  
$username = strip_tags($_REQUEST['username']);}
  
if (isset($_REQUEST['number'])){
// Fetching data from the request sent by form.php  
$number = strip_tags($_REQUEST['number']);}
  
if (isset($_REQUEST['comment'])){
// Fetching data from the request sent by form.php  
$comment = strip_tags($_REQUEST['comment']);}
  
if (isset($_REQUEST['prof'])){
// Fetching data from the request sent by form.php  
$prof = strip_tags($_REQUEST['prof']);}
  
if (isset($_REQUEST['workload'])){
// Fetching data from the request sent by form.php  
$workload = strip_tags($_REQUEST['workload']);}

// If all required items are set. This is to validate received information. The post would only be stored to database if it's valid.
if(isset($username)&&isset($number)&&isset($comment)&&isset($college)&&isset($workload)) {
	
	// The post has to be longer than 3 characters
	if (strlen($comment)<4){
		echo "<p class='error'><span class='warning'>Warning:</span> Your post is not valid. Please make sure that your comment is longer than 3 characters. 
		You can resubmit your form by clicking the Submit a Post button above.</p>";
		$is_valid_post = false;}
	
	// Workload must be a number between 0 and 10
	if (!is_numeric($workload)||$workload<0||$workload>10){
	echo "<p class='error'><span class='warning'>Warning:</span> Your post is not valid. Please make sure that the workload you entered is a number between 0 and 10. 
		You can resubmit your form by clicking the Submit a Post button above.</p>";
		$is_valid_post = false;}
	
	// Course number must be a combination of letters and numbers and longer than 10 characters
	if (strlen($number)<10||findDeptName($number)==0){
	echo "<p class='error'><span class='warning'>Warning:</span> Please follow the format of the example provided when entering the class number. The 
	department abbreviation needs to be at least two-character-long and followed by a number. You can resubmit your form by clicking the Submit a Post 
	button above.</p>";
	$is_valid_post = false;}
	
	// No special characters for username, prof, and number, but allow spaces
	if (!ctype_alnum(trim(str_replace(' ','',$username)))||(!empty($prof)&&!ctype_alnum(trim(str_replace(' ','',$prof))))||!ctype_alnum(trim(str_replace(' ','',$number)))){
		echo "<p class='error'><span class='warning'>Warning:</span> The information you entered is not valid, please fill the form again and make sure 
		there's no special characters in your answers.</p>";
		$is_valid_post = false;}}
		
	// If not all required items are filled
	else{
	echo "<p class='error'><span class='warning'>Warning:</span> Your form was not complete, please go back and make sure to fill out all the required items.
	<a href='form.php' class='resubmit'>Resubmit the form</a></p>";
	$is_valid_post = false;}
  
  // Saving the current post, if a form is valid
  $post_fields = array();
  $post_fields['username'] = $username;
  $post_fields['number'] = $number;
  $post_fields['comment'] = $comment;
  $post_fields['year'] = $year;
  $post_fields['college'] = $college;
  $post_fields['prof'] = $prof;
  $post_fields['easiness'] = $easiness;
  $post_fields['workload'] = $workload;
  $post_fields['valid'] = $is_valid_post;
  
  if ($post_fields['valid']){
  $success_flag = saveCurrentPost($post_fields);}}
  
  // If no form is submitted, display welcome page
  else{
	echo "<h2>Want to know about people's favorite Cornell courses?<br/> 
	Want to share your own favorite Cornell course? <br/>You are in the right place!</h2>";
	echo "<br/>";
	echo "<h3>Forgot the course number? Find your favorite class on Cornell's <a href='http://courses.cornell.edu/' target='_blank'>Course of Study</a></h3>";
	echo "<img src='images/logoed.png' alt='Cornelllogo' id='logo'>";
	}

//Fetching all posts from the database
 $posts_array = getAllPosts();
?>

    
    <?php
	//display current post and current users' past posts
    if(isset($username)&&isset($number)&&isset($comment)&&isset($college)&&$is_valid_post) {
      echo "<div class='currentpost'><h3>Thank you, ".$username.", for submitting your post!</h3>";
	  echo "<h1>".$username."  |      ".$number."</h1> <h5>Year: ".$year." |  ".$college." |   Professor: ".$prof."  |  Easiness: ".$easiness."  |  Workload: ".$workload."</h5>";
	  echo "<p>$comment</p></div>";
	  
	  $posts_array_1 = array_reverse($posts_array);
	  array_shift($posts_array_1);
	  if ($posts_array_1!=null){
	  foreach(array_reverse($posts_array_1) as $post){
	  $name = $post['username'];
	  if ($name==$username){
	  echo "<div class='currentpost'>";
	  echo "<h1>Your Past Post: ".$post['number']."</h1>";
	  echo "<p>".$post['comment']."</p></div>";
	  }}}
	  
	// display all the posts by students from the same college
	echo "<div id='samecollege'><h1 id='title'>People from the same college as you love these classes...</h1>";
	
	echo"<ul>";
	$counter=1;
	foreach(array_reverse($posts_array_1) as $post){
      $postcollege = $post['college'];
	  
	  // Compare the colleges
	  if ($college==$postcollege){
	  
	  if ($counter % 2==1)
        $li_class = "float-left";
      else
        $li_class = "float-right";
      
      echo "<li class=$li_class><h1>".$post['username']."  | ".$post['number']."</h1><h5>  ".$post['college']." |  Workload: ".$post['workload']."</h5>";
	  echo "<p>".$post['comment']."</p></li>";
	  $counter++;}
    }
	echo"</ul></div>";
	
	// If there's no one from the same college
	if ($counter<2){
	echo "<p>No one from your college has posted. Invite them to share their favorite Cornell courses now! <a href='http://www.facebook.com'>Facebook</a> OR <a href='http://www.twitter.com'>Twitter</a></p>";}
	  
    }
	?>
	
	
    <div id="postwall">
    <a href='index.php' id="posthistory">Post History</a>
	
    <ul id="posts_list">
    <?php 
    //Display all posts in the database
	$counter=1;
    // Looping through all the posts in posts_array
    foreach(array_reverse($posts_array) as $post){
      $name = $post['username'];
	  
	  if ($counter % 2==1)
        $li_class = "float-left";
      else
        $li_class = "float-right";
      
      echo "<li class=$li_class><h1>".$post['username']."  | ".$post['number']."</h1><h5>  ".$post['college']." |  Workload: ".$post['workload']."</h5>";
	  echo "<p>".$post['comment']."</p></li>";
	  $counter++;
    }
    ?>
    </ul>
	</div>
  </div>

  
<?php 
require('footer.php');
?>