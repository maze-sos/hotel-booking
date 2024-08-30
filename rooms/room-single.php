<?php require "../includes/header.php" ?>
<?php require "../config/config.php" ?>
<?php 


	if(isset($_GET['id'])){

		$id = $_GET['id'];
		$room = $conn->query("SELECT * FROM rooms WHERE status = 1 AND id='$id'");
		$room->execute();

		$singleRoom = $room->fetch(PDO::FETCH_OBJ);
	

	if(isset($_POST['submit'])){
		if(empty($_POST['email']) OR empty($_POST['phone_number']) OR empty($_POST['full_name']) OR empty($_POST['check_in'])  OR empty($_POST['check_out']) ){
		  echo "<script>alert('one or more input are empty')</script>";
		} else {

			$check_in = date_create($_POST['check_in']);
			$check_out = date_create($_POST['check_out']);
			$email = $_POST['email'];
			$phone_number = $_POST['phone_number'];
			$full_name = $_POST['full_name'];
			$hotel_name = $singleRoom->hotel_name;
			$room_name = $singleRoom->name;
			$user_id = $_SESSION['id'];
			$status = "pending";
			$payment = $singleRoom->price;
			$days = date_diff($check_in,$check_out);
			
			$_SESSION['username'] = $_POST['full_name'];
			$_SESSION['price'] = $singleRoom->price *intval($days->format('%R%a'));
			$_SESSION['name'] = $singleRoom->name;
			$_SESSION['email'] = $_POST['email'];
			if(date("m/d/Y") > $check_in OR  date("m/d/Y") > $check_out){
				echo "<script>alert('Pick a date that is not in the past, pick Starting from Tomorrow')</script>";
			}else {
				if($check_in > $check_out OR $check_in == date("m/d/Y")){
					echo  "<script>alert('Pick a date that is not Today for Check in and pick a check in date that is less than Check out')</script>";
				} else{
					// User input
					$userSelectedStartDate = $_POST['check_in'];
					$userSelectedEndDate = $_POST['check_out'];
					$roomName = $singleRoom->name;  // Adjust accordingly based on your form input

					// Check if the room is available for the selected dates
					$checkAvailability = $conn->prepare("SELECT COUNT(*) as overlapping_bookings FROM bookings
														WHERE room_name = :room_name
														AND check_in < :user_selected_end_date
														AND check_out > :user_selected_start_date");
					$checkAvailability->bindParam(':room_name', $roomName, PDO::PARAM_STR);
					$checkAvailability->bindParam(':user_selected_start_date', $userSelectedStartDate, PDO::PARAM_STR);
					$checkAvailability->bindParam(':user_selected_end_date', $userSelectedEndDate, PDO::PARAM_STR);
					$checkAvailability->execute();

					$overlappingBookings = $checkAvailability->fetch(PDO::FETCH_ASSOC)['overlapping_bookings'];

					if ($overlappingBookings > 0) {
						echo "<script>alert('Sorry, the room is not available for the selected dates. Please choose different dates.')</script>";
					} else {
						$booking = $conn->prepare("INSERT INTO bookings (check_in, check_out, email, phone_number, full_name, hotel_name, room_name, status, payment, user_id) VALUES (:check_in, :check_out, :email, :phone_number, :full_name, :hotel_name, :room_name, :status, :payment, :user_id)");

						$booking->execute([
							":check_in" => $_POST['check_in'],
							":check_out" => $_POST['check_out'],
							":email" => $_SESSION['email'],
							":phone_number" => $phone_number,
							":full_name" => $_SESSION['username'],
							":hotel_name" => $hotel_name,
							":room_name" => $_SESSION['name'],
							":status" => $status,
							":payment" => $_SESSION['price'],
							":user_id" => $user_id
						]);

						echo "<script>window.location.href='".APPURL."/rooms/pay.php'</script>"; 
					}


					// header("location:pay.php");
				}
			}

		}
	}	
} else {
	echo "<script>window.location.href='".APPURL."/404.php'</script>"; 
}
?>


    <div class="hero-wrap js-fullheight" style="background-image: url('<?php echo ROOMSIMAGES; ?>/<?php echo $singleRoom->image; ?>')" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-start" data-scrollax-parent="true">
          <div class="col-md-7 ftco-animate">
          	<h2 class="subheading">Welcome to Vacation Rental</h2>
          	<h1 class="mb-4"><?php echo $singleRoom->name; ?></h1>
            <!-- <p><a href="#" class="btn btn-primary">Learn more</a> <a href="#" class="btn btn-white">Contact us</a></p> -->
          </div>
        </div>
      </div>
    </div>

    <section class="ftco-section ftco-book ftco-no-pt ftco-no-pb">
    	<div class="container">
	    	<div class="row justify-content-end">
	    		<div class="col-lg-4">
					<form action="room-single.php?id=<?php echo $id; ?>" method="POST" class="appointment-form" style="margin-top: -568px;">
						<h3 class="mb-3">Book <?php echo $singleRoom->name; ?></h3>
						<div class="row">
						<?php if(isset($_SESSION['username'])) : ?>
							<?php
							$session_login = $_SESSION['username'];
							$user_sql = "SELECT * FROM users WHERE username = :session_login";
							$stmt = $conn->prepare($user_sql);
							$stmt->bindParam(':session_login', $session_login, PDO::PARAM_STR);
							$stmt->execute();
							$user_result = $stmt->fetch(PDO::FETCH_ASSOC);

							?>
							<div class="col-md-12">
								<div class="form-group">
									<input type="text" name="email" class="form-control" value="<?php echo $user_result['email']; ?>" readonly>
								</div>
							</div>
						   
							<div class="col-md-12">
								<div class="form-group">
									<input type="text" name="full_name" class="form-control" value="<?php echo $user_result['username']; ?>" readonly>
								</div>
							</div>

							<div class="col-md-12">
								<div class="form-group">
									<input type="text" name="phone_number" class="form-control" value="<?php echo $user_result['phone']; ?>">
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group">
								<div class="input-wrap">
									<div class="icon"><span class="ion-md-calendar"></span></div>
										<input type="text" name="check_in" class="form-control appointment_date-check-in" placeholder="Check-In">
									</div>
								</div>
							</div>
						
							<div class="col-md-6">
									<div class="form-group">
										<div class="icon"><span class="ion-md-calendar"></span></div>
										<input type="text" name="check_out" class="form-control appointment_date-check-out" placeholder="Check-Out">
									</div>
							</div>
						
							<div class="col-md-12">
								<div class="form-group">
									<input type="submit" name="submit" value="Book and Pay Now" class="btn btn-primary py-3 px-4">
								</div>
							</div>
							<?php else : ?>

								<div class="col-md-12">
									<div class="form-group">
										<input type="text" name="email" class="form-control" placeholder="Email">
									</div>
								</div>
							
								<div class="col-md-12">
									<div class="form-group">
										<input type="text" name="full_name" class="form-control" placeholder="Full Name">
									</div>
								</div>

								<div class="col-md-12">
									<div class="form-group">
										<input type="text" name="phone_number" class="form-control" placeholder="Phone Number">
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
									<div class="input-wrap">
										<div class="icon"><span class="ion-md-calendar"></span></div>
											<input type="text" name="check_in" class="form-control appointment_date-check-in" placeholder="Check-In">
										</div>
									</div>
								</div>
							
								<div class="col-md-6">
										<div class="form-group">
											<div class="icon"><span class="ion-md-calendar"></span></div>
											<input type="text" name="check_out" class="form-control appointment_date-check-out" placeholder="Check-Out">
										</div>
								</div>
							
								<div class="col-md-12">
									<div class="form-group">
										<a class="btn btn-primary py-3 px-4 " href="<?php echo APPURL; ?>/auth/login.php">Login</a>
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<a class="btn btn-primary py-3 px-4 " href="<?php echo APPURL; ?>/auth/register.php">Register</a>
									</div>
								</div>
								<?php endif; ?>

						</div>
				</form>
	    		</div>
	    	</div>
	    </div>
    </section>

    <section class="ftco-section bg-light">
			<div class="container">
				<div class="row no-gutters">
					<div class="col-md-6 wrap-about">
						<div class="img img-2 mb-4" style="background-image: url(<?php echo ROOMSIMAGES; ?>/<?php echo $singleRoom->image; ?>);">
						</div>
						
					</div>
					<div class="col-md-6 wrap-about ftco-animate">
	          <div class="heading-section">
	          	<div class="pl-md-5 mt-5">
		            <h2 class="mb-2">What <?php echo $singleRoom->name; ?> offer</h2>
	            </div>
	          </div>
	          <div class="pl-md-5">
			  			<h2><?php echo $singleRoom->name; ?>'s Details</h2>
						<p><?php echo $singleRoom->description; ?></p>

						<h2><?php echo $singleRoom->name; ?>'s Utilities</h2>
						<p><?php echo $singleRoom->uti_description; ?></p>
		
						</div> 
					</div>
				</div>
			</div>
		</section>
		
		<section class="ftco-intro" style="background-image: url(<?php echo APPURL; ?>/images/image_2.jpg);" data-stellar-background-ratio="0.5">
			<div class="overlay"></div>
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-md-9 text-center">
						<h2>Ready to get started</h2>
						<p class="mb-4">It’s safe to book online with us! Get your dream stay in clicks or drop us a line with your questions.</p>
						<p class="mb-0"><a href="#" class="btn btn-primary px-4 py-3">Learn More</a> <a href="#" class="btn btn-white px-4 py-3">Contact us</a></p>
					</div>
				</div>
			</div>
		</section>


<?php require "../includes/footer.php" ?>