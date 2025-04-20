<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link rel="stylesheet" href="css/style log.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	
    <div class="d-flex justify-content-center align-items-center vh-100">
    	
    	<form class="wrapper" 
    	      action="php/login.php" 
    	      method="post">

			  <img src="upload/hadra.png" alt="Hadra Logo">
    		<?php if(isset($_GET['error'])){ ?>
    		<div class="alert alert-danger" role="alert">
			  <?php echo htmlspecialchars($_GET['error']); ?>
			</div>
		    <?php } ?>

		  <div class="mb-3">
		    <label class="form-label">User name</label>
		    <input type="text" 
		           class="form-control"
		           name="uname"
		           value="<?php echo (isset($_GET['uname']))? htmlspecialchars($_GET['uname']):"" ?>">
		  </div>

		  <div class="mb-3">
		    <label class="form-label">Password</label>
		    <input type="password" 
		           class="form-control"
		           name="pass">
		  </div>
		  
		  <button type="submit" >Login</button>

		  <div class="auth-redirect">
            
            
        
		  <a href="admin-login.php" id="gapping_log" >Admin login</a>
		  
		  <a href="blog.php" id="gapping_log">Log as Visiter</a>
		 
		  <p id="p_log">Don't have an account?</p>
		  <a href="signup.php">Sign Up</a>
		  </div>
		</form>
    </div>
</body>
</html>