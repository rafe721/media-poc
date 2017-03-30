 <?php 

?>
<form action="">
	<input type="text" name="username" placeholder="Username"><br>
	<input type="text" name="password" placeholder="Password"><br>
	<input type="text" name="confirm_password" placeholder="confirm Password"><br>
	<!-- next Step -->
	<input type="text" name="email_id" placeholder="Email Id"><br>
	<input type="text" name="password" placeholder="Password"><br>
	<input type="text" name="first_name" placeholder="First Name"><br>
	<input type="text" name="second_name" placeholder="Second Name"><br>
	<!-- Plan can be chosen later -->
	  <button type="button" onclick="insertUser('#operation_container')">Add User</button>
	  <button type="button" onclick="clearForm()">Cancel</button>
</form> 

