<?php require "../includes/header.php" ?>
<?php require "../config/config.php" ?>
<?php 

if(!isset($_SESSION['username'])){
   echo "<script>window.location.href='".APPURL."' </script>";
} 

$password = $message =  $successmessage = "";

$errors = ['password' => '', 'confirmpassword' => ''];

if(isset($_GET['id'])){
    $id = $_GET['id'];
  $user = $conn->query("SELECT * FROM users WHERE id='$id'");
  $user->execute();
  
  $userSingle = $user->fetch(PDO::FETCH_OBJ);

if (isset($_POST['update'])){
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

        
        $password = password_hash( $_POST['password'], PASSWORD_DEFAULT);

          $update = $conn->prepare("UPDATE users SET mypassword = :mypassword WHERE id='$id' ");

          $update->execute([
            ":mypassword" => $password,
          ]);


            if ($update){
                // $successMessage = "Details Updated Successfully";
                echo "<script>window.location.href='".APPURL."/users/accountdetails.php?id=<?php echo $userSingle->id; ?>' </script>";
                
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
	    	<div class="row justify-content-middle" style="margin-left: 397px;">
	    		<div class="col-md-6 mt-5">
						<form action="accountsettings.php?id=<?php echo $id; ?>" method="POST" class="appointment-form" style="margin-top: -700px;">
							<h3 style="color: red;" class="mb-3">Change <?php echo $userSingle->username; ?> Password</h3>
                              <h5 style="color: red;"><?php if(isset($message)){echo $message;}?></h5>
                              <h5 style="color: green;"><?php if(isset($successMessage)){echo $successMessage;}?></h5>
							<div class="row">
                                <div class="col-md-12">
									<div class="form-group">
			    					<input type="password" name="password" class="form-control" placeholder="New Password">
                                    <p style="color: red;"><?php if(isset($errors['password'])){echo $errors['password'];}?></p>
			    				</div>
								</div>
                                <div class="col-md-12">
									<div class="form-group">
			    					<input type="password" name="confirmpassword" class="form-control" placeholder="Confirm New Password">
                                    <p style="color: red;"><?php if(isset($errors['confirmpassword'])){echo $errors['confirmpassword'];}?></p>
			    				</div>
								</div>
								<div class="col-md-12">
                                  <div class="form-group">
                                  <input type="submit" name="update" value="Update <?php echo $userSingle->username; ?> Profile" class="btn btn-primary py-3 px-4">
                                  <a  href="accountdetails.php?id=<?php echo $userSingle->id; ?>" class="btn btn-primary py-3 px-4 mt-4 text-center">Back</a>
                                  </div>
								</div>
							</div>
	    			</form>
	    		</div>
	    	</div>
	    </div>
    </section>

<?php require "../includes/footer.php" ?>