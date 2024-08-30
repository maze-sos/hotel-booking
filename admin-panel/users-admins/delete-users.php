<?php
require "../layouts/header.php";
require "../../config/config.php";

if(!isset($_SESSION['adminname'])){
    echo "<script>window.location.href='".ADMINURL."/admins/login-admins.php' </script>";
  }

if(isset($_GET['id'])){
    $id = $_GET['id'];

    $user = $conn->query("SELECT * FROM users WHERE id='$id'");
    $user->execute();
        
    $singleUser = $user->fetch(PDO::FETCH_OBJ);
    
    
    if(isset($_POST['submit'])) {

    $delete = $conn->query("DELETE FROM users WHERE id='$id'");
    $delete->execute();


    // header("location: show-bookings.php");
    echo "<script>window.location.href='".ADMINURL."/users-admins/show-users.php' </script>";
    }
}

?>

<div class="row">
    <div class="col">
        <div class="card">
            <h2 class="card-title" style=" color: red; margin-top: 2rem; margin-left: 2rem;"><strong>Delete <?php echo $singleUser->username; ?>?</strong></h2>
            <div class="card-body">
                <p class="card-text"><strong>User Name: </strong><?php echo $singleUser->username; ?></p>
                <p class="card-text"><strong>User Phone Number: </strong><?php echo $singleUser->phone; ?></p>
                <p class="card-text"><strong>User Email: </strong><?php echo $singleUser->email; ?></p>
                <p class="card-text"><strong>User Created At: </strong><?php echo $singleUser->created_at; ?></p>
            </div>
        </div>
        <form method="post">
        <button type="submit" name="submit" class="btn btn-danger  text-center ">Delete <?php echo $singleUser->username; ?></button>
        <a  href="show-users.php?id=<?php echo $singleUser->id; ?>" class="btn btn-primary text-white text-center">Back</a>
        </form>
    </div>
</div>


 <?php require "../layouts/footer.php"; ?>