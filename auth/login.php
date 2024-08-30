<?php require "../includes/header.php" ?>
<?php require "../config/config.php" ?>
<?php 
    
    $successMessage = isset($_GET['success']) ? urldecode($_GET['success']) : '';

    if(isset($_SESSION['username'])){
      echo "<script>window.location.href='".APPURL."' </script>";
    }

$email = $password = $message = "";
 
$errors = ['name' => '', 'password' => ''];


if(isset($_POST['login'])){
  if(empty($_POST['email'])){
        $errors['email'] = "E-Mail is Required". "<br />";
    } else {
        $email = $_POST['email']; 
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $errors['email'] = "Input a Valid Email". "<br />";
        }
    }

    if (empty($_POST['password'])) {
      $errors['password'] = "Password is Required." . "<br />";
    } else {
        $password = $_POST['password'];
        $password = password_hash($password, PASSWORD_DEFAULT);
        }

    if (array_filter($errors)){
      $message = "THERE IS AN ERROR ON YOUR FORM";
    } else {
    $email = $_POST['email'];
    $password = $_POST['password'];

      $login = $conn->query("SELECT * FROM users WHERE email='$email'");
      $login->execute();

      $fetch = $login->fetch(PDO::FETCH_ASSOC);

        if ($login->rowCount() > 0) {
            if(password_verify($password, $fetch['mypassword']) && $fetch['status'] == '1') {
              $_SESSION['username'] = $fetch['username'];
              $_SESSION['id'] = $fetch['id'];
  
              echo "<script>window.location.href='".APPURL."' </script>";
              }else {
                $message = "Incorrect Password or Account Suspended";
            }
        } else {
            $message = "Incorrect Email";
        }
    }
  }  



    // if(isset($_POST['submit'])){
    //   if(empty($_POST['email']) OR empty($_POST['password']) ){
    //     echo "<script>alert('one or more input are empty')</script>";
    //   } else {

    //     $email = $_POST['email'];
    //     $password = $_POST['password'];

    //     $login = $conn->query("SELECT * FROM users WHERE email='$email'");
    //     $login->execute();

    //     $fetch = $login->fetch(PDO::FETCH_ASSOC);

    //     if($login->rowCount() > 0){
    //       if(password_verify($password, $fetch['mypassword'])) {
    //         // echo "<script>alert('LOGGED IN')</script>";

    //         $_SESSION['username'] = $fetch['username'];
    //         $_SESSION['id'] = $fetch['id'];

    //         echo "<script>window.location.href='".APPURL."' </script>";
    //       } else {
    //         echo "<script>alert('Email or Password is Wrong')</script>";
    //       }
    //     } else {
    //       echo "<script>alert('Email or Password is Wrong')</script>";
    //     }

    //   };
    // };  
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
	    	<div class="row justify-content-middle" style="margin-left: 397px;">
	    		<div class="col-md-6 mt-5">
						<form action="login.php" method="POST" class="appointment-form" style="margin-top: -568px;">
            <h3 style="color: green;"><?php if(isset($successMessage)){echo $successMessage;}?></h3>
            <h3 style="color: red;"><?php if(isset($message)){echo $message;}?></h3>
							<h3 class="mb-3">Login</h3>
							<div class="row">
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
                    <input type="submit" name="login" value="Login" class="btn btn-primary py-3 px-4">
                  </div>
								</div>
							</div>
	    			</form>
	    		</div>
	    	</div>
	    </div>
    </section>

  <?php require "../includes/footer.php" ?>