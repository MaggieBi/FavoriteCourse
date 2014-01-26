<?php 
/* [INFO/CS 1300 Project 3] form.php 
 * Contains code for the user form and submits it to posting_wall.php
 * 
 * 
 */

// TODO Include common header code
include "header.php";
?>


  <!--TODO Add a name for your app -->
  <div id="form">
  <p><a href="index.php">Posting Wall</a></p>
  <h5>Share your favorite class at Cornell by filling out the form below!</h5>
  
  <form action="index.php" method="post" autocomplete="on">
  
    <label>What's your name (required):</label> 
	<input type="text" name="username" autofocus required/>
	
	<label>What's your email (required):</label>
	<input type="email" name="email" required/><br/>
	
	<span class="question">What year are you (optional):</span> <br/>
	<span class="year">Freshman</span><input type="radio" name="year" class="radio" value="Freshman" /><br/>
	<span class="year">Sophomore</span><input type="radio" name="year" class="radio" value="Sophomore" /><br/>
	<span class="year">Junior</span><input type="radio" name="year" class="radio" value="Junior" /><br/>
	<span class="year">Senior</span><input type="radio" name="year" class="radio" value="Senior" /><br/>
	
	<div id="college">
	<span class="question">Which college within Cornell are you in (required):</span><br/>
	<select name="college" >
	<option value="College of Arts and Sciences">College of Arts and Sciences</option>
	<option value="College of Engineering">College of Engineering</option>
	<option value="School of Industrial and Labor Relations">School of Industrial and Labor Relations</option>
	<option value="College of Architecture, Art, and Planning">College of Architecture, Art, and Planning</option>
	<option value="College of Human Ecology">College of Human Ecology</option>
	<option value="College of Agriculture and Life Sciences">College of Agriculture and Life Sciences</option>
	<option value="School of Hotel Administration">School of Hotel Administration</option>
	</select>
	<br/>
	</div>
	
	<span class="question">What's your favourite class at Cornell (required):</span><br/>
	<span class="sidenote">Please write down both the course number and course name. Eg. CS1110 Introduction to Python</span>
	<input type="text" name="number" required/>
	<br/>
	
	<label>Who's the professor (optional):</label>
	<input type="text" name="prof" />
	<br/>
	
	<label>Rate the easiness of the class (optional):<br/> <span class="sidenote">(1-Hardest; 5-Easiest)</span></label>
	<input type="number" name="easiness" min="1" max="5" />
	<br/>
	
	<label>Rate the workload of the class (required):<br/> <span class="sidenote">(1-Lighest; 5-Default; 10-Heaviest)</span></label>
	<input id="range" type="range" name="workload" min="0" max="10"/>
	<br/>
	
	<span class="question">Tell us why you love the class (required comment):</span>
	<textarea rows="10" cols="20" name="comment" maxlength="<?php echo $CHAR_LIMIT?>" autocomplete="off"></textarea>
	<br/>
	
    <button type="submit" id="submit" value="Submit">Submit</button>
	<button type="reset" id="reset" value="Reset">Reset</button>
	
		
  </form>
  </div>
  
  <!-- TODO Add common footer here. -->
  <?php include 'footer.php'; ?>

