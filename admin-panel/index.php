<?php require "./layouts/header.php";?> 
<?php require "../config/config.php";?> 

<?php 

if(!isset($_SESSION['adminname'])){
  echo "<script>window.location.href='".ADMINURL."/admins/login-admins.php' </script>";
}



//hotel count

$hotels = $conn->query("SELECT COUNT(*) AS count_hotels FROM hotels WHERE status = 1");
$hotels->execute();

$allHotels = $hotels->fetch(PDO::FETCH_OBJ);



//admin count

$admins = $conn->query("SELECT COUNT(*) AS count_admins FROM admins");
$admins->execute();

$allAdmins = $admins->fetch(PDO::FETCH_OBJ);


//rooms count

$rooms = $conn->query("SELECT COUNT(rooms.id) as count_rooms FROM rooms JOIN hotels ON rooms.hotel_id = hotels.id WHERE hotels.status = 1 AND rooms.status = 1");
$allRooms = $rooms->fetch(PDO::FETCH_OBJ);



//bookings count

$bookings = $conn->query("SELECT COUNT(*) AS count_bookings FROM bookings");
$bookings->execute();

$allBookings= $bookings->fetch(PDO::FETCH_OBJ);


//bookings count

$conBookings = $conn->query("SELECT COUNT(*) AS count_conbookings FROM bookings WHERE status = 'confirmed' ");
$conBookings->execute();

$allConBookings= $conBookings->fetch(PDO::FETCH_OBJ);


// users count
$users = $conn->query("SELECT COUNT(*) AS count_users FROM users");
$users->execute();

$allUsers= $users->fetch(PDO::FETCH_OBJ);


?>

      <div class="row">
        <div class="col-md-4">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Admins</h5>
              <p class="card-text">number of admins: <?php echo $allAdmins->count_admins; ?></p>
              <a class="btn btn-primary text-white text-center" href="<?php echo ADMINURL; ?>/admins/admins.php">View Admins</a>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Hotels</h5>
              <p class="card-text">number of hotels: <?php echo $allHotels->count_hotels; ?></p>
              <a class="btn btn-primary text-white text-center" href="<?php echo ADMINURL; ?>/hotels-admins/show-hotels.php">View Hotels</a>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Rooms</h5>
              <p class="card-text">number of rooms: <?php echo $allRooms->count_rooms; ?></p>
              <a class="btn btn-primary text-white text-center" href="<?php echo ADMINURL; ?>/rooms-admins/show-rooms.php">View Rooms</a>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-4">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Users</h5>
              <p class="card-text">number of users: <?php echo $allUsers->count_users; ?></p>
              <a class="btn btn-primary text-white text-center" href="<?php echo ADMINURL; ?>/users-admins/show-users.php">View Users</a>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Bookings</h5>
              <p class="card-text">number of bookings: <?php echo $allBookings->count_bookings; ?></p>
              <a class="btn btn-primary text-white text-center" href="<?php echo ADMINURL; ?>/bookings-admins/show-bookings.php">View Bookings</a>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Confirmed Bookings</h5>
              <p class="card-text">number of confirmed bookings: <?php echo $allConBookings->count_conbookings; ?></p>
              <a class="btn btn-primary text-white text-center" href="<?php echo ADMINURL; ?>/bookings-admins/show-bookings.php">View Bookings</a>
            </div>
          </div>
        </div>
      </div>


<?php require "layouts/footer.php";?>
