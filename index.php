<?php
include("./templates/header.php")
?>
<body>
	<form action="actions/login.php" method="POST" class="mx-auto w-50 h-700 mt-5">
	  <h2>Sign in</h2>
	  <!-- Email input -->
	  <div data-mdb-input-init class="form-outline mb-4">
	    <input type="email"  name="email" id="email" required="" class="form-control" />
	    <label class="form-label" for="email">Email address</label>
	  </div>
	
	  <!-- Password input -->
	  <div data-mdb-input-init class="form-outline mb-4">
	    <input type="password" name="password" id="password" required="" class="form-control" />
	    <label class="form-label" for="password">Password</label>
	  </div>

	  <!-- Submit button -->
	  <button type="submit" name="login" id="login" value="Login" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-block mb-4">Sign in</button>
	  </div>
	</form>
	<div class="text-center">
	    <p>Not a member? <a href="signup.php">Register</a></p>
	</div>
</body>
</html>