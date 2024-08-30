<?php require "../layouts/header.php"; ?>
<?php require "../../config/config.php"; ?>
<?php
if(!isset($_SESSION['adminname'])){
  echo "<script>window.location.href='".ADMINURL."/admins/login-admins.php' </script>";
}

if(isset($_GET['id'])){
  $id = $_GET['id'];
  $user = $conn->query("SELECT * FROM users WHERE id='$id'");
  $user->execute();
      
  $singleUser = $user->fetch(PDO::FETCH_OBJ);
  if(isset($_POST['submit'])) {
//     if(empty($_POST['status'])) {
//   echo "<script>alert('one or more input are empty')</script>";
// } else {


  $status = $_POST['status'];
  $update = $conn->prepare("UPDATE users SET status = :status WHERE id='$id'");
  $update->execute([
    ":status" => $status
  ]);


  // header("location: show-bookings.php");
  echo "<script>window.location.href='".ADMINURL."/users-admins/show-users.php' </script>";



 }
}

  

// }
?>
    <div class="container-fluid">
       <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-5 d-inline" >Update <?php echo $singleUser->username; ?>'s Status</h5>
              <form method="POST" action="status-users.php?id=<?php echo $id; ?>" enctype="multipart/form-data">
                <select name="status" style="margin-top: 15px; margin-bottom: 5px;" class="form-control">
                    <option>Choose Status</option>
                    <option value="1">1</option>
                    <option value="0">0</option>
                </select>

                <button type="submit" name="submit" class="btn btn-primary text-center">Change <?php echo $singleUser->username; ?> Status</button>
                <a  href="show-users.php?id=<?php echo $singleUser->id; ?>" class="btn btn-primary text-white text-center">Back</a>
              </form>
              </div>
          </div>
        </div>
      </div>
<?php require "../layouts/footer.php"; ?>