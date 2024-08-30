<?php require "../layouts/header.php"; ?>
<?php require "../../config/config.php"; ?>
<?php 

if(!isset($_SESSION['adminname'])){
  echo "<script>window.location.href='".ADMINURL."/admins/login-admins.php' </script>";
}

$bookings = $conn->query("SELECT * FROM bookings ORDER BY created_at DESC");
$bookings->execute();

$allBookings = $bookings->fetchAll(PDO::FETCH_OBJ);


?> 
    <div class="container-fluid">

              <h5 class="card-title mb-4 d-inline">Bookings</h5>
            
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">check in</th>
                    <th scope="col">check out</th>
                    <th scope="col">email</th>
                    <th scope="col">phone number</th>
                    <th scope="col">full name</th>
                    <th scope="col">hotel name</th>
                    <th scope="col">room name</th>
                    <th scope="col">status</th>
                    <th scope="col">payment</th>
                    <th scope="col">created at</th>
                    <th scope="col">status</th>
                    <th scope="col">delete</th>
                  </tr>
                </thead>
                <tbody>
                <?php foreach($allBookings as $booking) : ?>
                  <tr>
                    <th scope="row"><?php echo $booking->id; ?></th>
                    <td><?php echo $booking->check_in; ?></td>
                    <td><?php echo $booking->check_out; ?></td>
                    <td><?php echo $booking->email; ?></td>
                    <td><?php echo $booking->phone_number; ?></td>
                    <td><?php echo $booking->full_name; ?></td>
                    <td><?php echo $booking->hotel_name; ?></td>
                    <td><?php echo $booking->room_name; ?></td>
                    <td><?php echo $booking->status; ?></td>
                    <td>$<?php echo $booking->payment; ?></td>
                    <td><?php echo $booking->created_at; ?></td>
                    
                    <td><a href="status-bookings.php?id=<?php echo $booking->id; ?>" class="btn btn-warning  text-white text-center ">Status</a></td>
                    <td><a href="delete-bookings.php?id=<?php echo $booking->id; ?>" class="btn btn-danger  text-center ">Delete</a></td>
                  </tr>
                  <?php endforeach; ?>
                </tbody>
              </table> 
      </div>

<?php require "../layouts/footer.php"; ?>