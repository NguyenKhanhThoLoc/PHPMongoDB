<?php
include("./templates/header.php");
?>
<body>
	<div class="container mt-3">
	    <div class="row justify-content-center">
	      <div class="col-md-6">
	        <h2>Sign up</h2>
	        <form action="actions/actions.php" method="POST">
	          <div class="mb-3">
	            <label for="fname" class="form-label">Firstname</label>
	            <input type="text" class="form-control" id="fname" name="fname" placeholder="Enter Firstname" required>
	          </div>
	          <div class="mb-3">
	            <label for="lname" class="form-label">Lastname</label>
	            <input type="text" class="form-control" id="lname" name="lname" placeholder="Enter Lastname" required>
	          </div>
	          <div class="mb-3">
	            <label for="email" class="form-label">Email</label>
	            <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" required>
	          </div>
	          <div class="mb-3">
	            <label for="phoneNo" class="form-label">Phone No</label>
	            <input type="tel" class="form-control" id="phoneNo" name="phoneNo" placeholder="Enter Phone Number" required>
	          </div>
	          <div class="mb-3">
	            <label for="password" class="form-label">Password</label>
	            <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password" required>
	          </div>
			  <div class="mb-3">
	            <label for="password" class="form-label">Repeat password</label>
	            <input type="password" class="form-control" id="repeat password" name="repeatpassword" placeholder="Enter Password again" required>
	          </div>
	          <button type="submit" id="signup" name="signup" class="btn btn-primary">Signup</button>
	        </form>
	      </div>
	    </div>
	  </div>
  	<div class="text-center mt-3">
  	  <a href="index.php">Already have an account? Login</a>
  	</div>
</body>
</html>