<?php require "../includes/header.php" ?>
<?php require "../config/config.php" ?>
<?php 

if(!isset($_SESSION['username'])){
   echo "<script>window.location.href='".APPURL."' </script>";
} 

$username = $phone = $email = $message =  $successmessage = "";

$errors = ['username' => '', 'phone' => '', 'email' => ''];

if(isset($_GET['id'])){
    $id = $_GET['id'];
  $user = $conn->query("SELECT * FROM users WHERE id='$id'");
  $user->execute();
  
  $userSingle = $user->fetch(PDO::FETCH_OBJ);

if (isset($_POST['update'])){
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


    if (array_filter($errors)){
      $message = "There is an Error";
    } else {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];


          $update = $conn->prepare("UPDATE users SET username = :username, phone = :phone, email = :email WHERE id='$id' ");

          $update->execute([
            ":username" => $username,
            ":phone" => $phone,
            ":email" => $email,
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
							<h3 class="mb-3">Update <?php echo $userSingle->username; ?> Profile</h3>
                              <h5 style="color: red;"><?php if(isset($message)){echo $message;}?></h5>
                              <h5 style="color: green;"><?php if(isset($successMessage)){echo $successMessage;}?></h5>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
			    					<input type="text" name="username" class="form-control" value="<?php echo $userSingle->username; ?>" placeholder="Username">
                                    <p style="color: red;"><?php if(isset($errors['username'])){echo $errors['username'];}?></p>
			    				</div>
								</div>
                                <div class="col-md-12">
									<div class="form-group">
			    					<input type="tel" name="phone" class="form-control" value="<?php echo $userSingle->phone; ?>" placeholder="Phone Number">
                                    <p style="color: red;"><?php if(isset($errors['phone'])){echo $errors['phone'];}?></p>
			    				</div>
								</div>
                                <div class="col-md-12">
									<div class="form-group">
			    					<input type="email" name="email" class="form-control" value="<?php echo $userSingle->email; ?>" placeholder="Email">
                                    <p style="color: red;"><?php if(isset($errors['email'])){echo $errors['email'];}?></p>
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