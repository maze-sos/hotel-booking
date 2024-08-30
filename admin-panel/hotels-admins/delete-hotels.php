<?php
require "../layouts/header.php";
require "../../config/config.php";
if(!isset($_SESSION['adminname'])){
    echo "<script>window.location.href='".ADMINURL."/admins/login-admins.php' </script>";
  }

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $hotel = $conn->query("SELECT * FROM hotels WHERE id='$id'");
    $hotel->execute();
        
    $singleHotel = $hotel->fetch(PDO::FETCH_OBJ);
    
    
    if(isset($_POST['submit'])) {
    $getImage = $conn->query("SELECT * FROM hotels WHERE id='$id'");
    $getImage->execute();

    $fetch = $getImage->fetch(PDO::FETCH_OBJ);

    unlink("hotel_images/" . $fetch->image);

    $delete = $conn->query("DELETE FROM hotels WHERE id='$id'");
    $delete->execute();


    // header("location: show-hotels.php");
    echo "<script>window.location.href='".ADMINURL."/hotels-admins/show-hotels.php' </script>";

    }
}

?>

<div class="row">
    <div class="col">
        <div class="card">
            <h2 class="card-title" style="color: red; margin-top: 2rem; margin-left: 2rem;"><strong>Delete Hotel?</strong></h2>
            <div class="card-body">
                <img src="<?php echo HOTELSIMAGES; ?>/<?php echo $singleHotel->image; ?>" alt="" style="width: 25rem; height: 17rem; border-radius: 0.5rem;">
                <p class="card-text"><strong>Hotel Name: </strong><?php echo $singleHotel->name; ?></p>
                <p class="card-text"><strong>Hotel Location: </strong><?php echo $singleHotel->location; ?></p>
                <p class="card-text"><strong>Hotel Description: </strong><?php echo $singleHotel->description; ?></p>
                <p class="card-text"><strong>Hotel Created At: </strong><?php echo $singleHotel->created_at; ?></p>
            </div>
        </div>
        <form method="post">
        <button type="submit" name="submit" class="btn btn-danger  text-center ">Delete <?php echo $singleHotel->name; ?> Hotel</button>
        <a  href="manage-hotels.php?id=<?php echo $singleHotel->id; ?>" class="btn btn-primary text-white text-center">Back</a>
        </form>
    </div>
</div>


 <?php require "../layouts/footer.php"; ?>