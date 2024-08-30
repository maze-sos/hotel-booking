<?php require "../includes/header.php" ?>
<?php require "../config/config.php" ?>
<?php 

if(isset($_SESSION['username'])){
   echo "<script>window.location.href='".APPURL."' </script>";
} 

$username = $phone = $email = $password = $message =  $successmessage = "";

$errors = ['username' => '', 'phone' => '', 'email' => '', 'password' => '', 'confirmpassword' => ''];

if (isset($_POST['register'])){
    if(empty($_POST['email'])){
        $errors['email'] = "E-Mail is Required". "<br />";
    } else {
        $email = $_POST['email']; 
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $errors['email'] = "Input a Valid Email". "<br />";
        }
    }

    if(empty($_POST['phone'])){
      $errors['phone'] = "Phone Number is Required". "<br />";
    } else {
        $phone = $_POST['phone'];
        if (!preg_match('/^[0-9+]+$/', $phone)) {
            $errors['phone'] = "Input a Valid Phone Number". "<br />";
        }
    }

    if(empty($_POST['username'])){
        $errors['username'] = "Username is Required". "<br />";
    } else {
        $username = $_POST['username'];
        if (!preg_match('/^[a-zA-Z0-9,@_\s]+$/', $username)) {
            $errors['username'] = "Input a Valid Username". "<br />";
        }
    }

    if (!empty($_POST['password'])) {
      $password = $_POST['password'];
      $confirmPassword = $_POST['confirmpassword'];
      if (strlen($password) < 8) {
          $errors['password'] = "Password must have at least 8 characters." . "<br />";
      } else if ($password !== $confirmPassword) {
        $errors['confirmpassword'] = "Passwords do not match.";
      } {
          $password = password_hash($password, PASSWORD_DEFAULT);
      }
    } else {
        $errors['password'] = "Password is Required." . "<br />";
    }
  

    if (array_filter($errors)){
      $message = "There is an Error";
    } else {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $password = password_hash( $_POST['password'], PASSWORD_DEFAULT);

        $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email OR username = :username OR phone = :phone LIMIT 1");

        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);

        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            if ($user['username'] == $username){
              $message = "Username already Exists!!!";
            }
            if ($user['email'] == $email){
                $message = "Email already Exists!!!";
            }
            if ($user['username'] == $username){
                $message = "Username already Exists!!!";           
            } 
            if ($user['phone'] == $phone){
              $message = "Phone Number already Exists!!!";           
            }
        } else {
          $insert = $conn->prepare("INSERT INTO users (username, phone, email, mypassword) VALUES (:username, :phone, :email, :mypassword)");

          $insert->execute([
            ":username" => $username,
            ":phone" => $phone,
            ":email" => $email,
            ":mypassword" => $password,
          ]);

            if ($insert){
              // $successmessage = "Registration Successful";
              // echo "<script>window.location.href='".APPURL."/auth/login.php' </script>";
              $successMessage = "Registration Successful!";
              $redirectURL = APPURL . "/auth/login.php?success=" . urlencode($successMessage);
              echo "<script>window.location.href='$redirectURL'</script>";
                exit();
            } else {
                $message = "Unable to Submit your data. Try again later.";
            }
        }

    }
}
?>

    <div class="hero-wrap js-fullheight" style="background-image: url('<?php echo APPURL; ?>/images/image_2.jpg');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-start" data-scrollax-parent="true">
          <div class="col-md-7 ftco-animate">

          </div>
        </div>
      </div>
    </div>

    <section class="ftco-section ftco-book ftco-no-pt ftco-no-pb">
    	<div class="container">
	    	<div class="row justify-content-middle" style="margin-left: 397px; margin-top: 100px;">
	    		<div class="col-md-6 mt-5">
						<form action="register.php" method="POST" class="appointment-form" style="margin-top: -700px;">
							<h3 class="mb-3">Register</h3>
              <h5 style="color: red;"><?php if(isset($message)){echo $message;}?></h5>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
			    					<input type="text" name="username" class="form-control" placeholder="Username">
                    <p style="color: red;"><?php if(isset($errors['username'])){echo $errors['username'];}?></p>
			    				</div>
								</div>
                <div class="col-md-12">
									<div class="form-group">
			    					<input type="tel" name="phone" class="form-control" placeholder="Phone Number">
                    <p style="color: red;"><?php if(isset($errors['phone'])){echo $errors['phone'];}?></p>
			    				</div>
								</div>
                <div class="col-md-12">
									<div class="form-group">
			    					<input type="email" name="email" class="form-control" placeholder="Email">
                    <p style="color: red;"><?php if(isset($errors['email'])){echo $errors['email'];}?></p>
			    				</div>
								</div>
                <div class="col-md-12">
									<div class="form-group">
			    					<input type="password" name="password" class="form-control" placeholder="Password">
                    <p style="color: red;"><?php if(isset($errors['password'])){echo $errors['password'];}?></p>
			    				</div>
								</div>
                <div class="col-md-12">
									<div class="form-group">
			    					<input type="password" name="confirmpassword" class="form-control" placeholder="Confirm Password">
                    <p style="color: red;"><?php if(isset($errors['confirmpassword'])){echo $errors['confirmpassword'];}?></p>
			    				</div>
								</div>
								<div class="col-md-12">
                  <div class="form-group">
                      <input type="submit" name="register" value="Register" class="btn btn-primary py-3 px-4">
                  </div>
								</div>
							</div>
	    			</form>
	    		</div>
	    	</div>
	    </div>
    </section>

<?php require "../includes/footer.php" ?>