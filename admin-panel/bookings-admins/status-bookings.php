<?php require "../layouts/header.php"; ?>
<?php require "../../config/config.php"; ?>
<?php
if(!isset($_SESSION['adminname'])){
  echo "<script>window.location.href='".ADMINURL."/admins/login-admins.php' </script>";
}

if(isset($_GET['id'])){
  $id = $_GET['id'];
  $booking = $conn->query("SELECT * FROM bookings WHERE id='$id'");
  $booking->execute();
      
  $singleBooking = $booking->fetch(PDO::FETCH_OBJ);

  if(isset($_POST['submit'])) {
//     if(empty($_POST['status'])) {
//   echo "<script>alert('one or more input are empty')</script>";
// } else {


  $status = $_POST['status'];
  $update = $conn->prepare("UPDATE bookings SET status = :status WHERE id='$id'");
  $update->execute([
    ":status" => $status
  ]);


  // header("location: show-bookings.php");
  echo "<script>window.location.href='".ADMINURL."/bookings-admins/show-bookings.php' </script>";



 }
}

  

// }
?>
    <div class="container-fluid">
       <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-5 d-inline" >Update <?php echo $singleBooking->full_name; ?>'s <?php echo $singleBooking->room_name; ?> Booking Status</h5>
              <form method="POST" action="status-bookings.php?id=<?php echo $id; ?>" enctype="multipart/form-data">
                <select name="status" style="margin-top: 15px;" class="form-control">
                    <option>Choose Status</option>
                    <option value="Pending">Pending</option>
                    <option value="Confirmed">Confirmed</option>
                    <option value="Done">Done</option>
                </select>

                <button type="submit" name="submit" class="btn btn-primary text-center">Change <?php echo $singleBooking->full_name; ?>'s <?php echo $singleBooking->room_name; ?> Booking Status</button>
                <a  href="show-bookings.php?id=<?php echo $singleBooking->id; ?>" class="btn btn-primary text-white text-center">Back</a>
              </form>
              </div>
          </div>
        </div>
      </div>
<?php require "../layouts/footer.php"; ?>