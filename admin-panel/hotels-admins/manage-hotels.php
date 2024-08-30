<?php require "../layouts/header.php"; ?>
<?php require "../../config/config.php"; ?>
<?php
if(!isset($_SESSION['adminname'])){
    echo "<script>window.location.href='".ADMINURL."/admins/login-admins.php' </script>";
  }

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $hotel = $conn->query("SELECT * FROM hotels WHERE id='$id'");
    $hotel->execute();
        
    $singleHotel = $hotel->fetch(PDO::FETCH_OBJ);

} else {
    echo "<script>window.location.href='".ADMINURL."/404.php'</script>";
}

?>
<div class="row">
    <div class="col">
        <div class="card">
            <h2 class="card-title" style="margin-top: 2rem; margin-left: 2rem;"><strong>Hotel Details</strong></h2>
            <div class="card-body">
                <img src="<?php echo HOTELSIMAGES; ?>/<?php echo $singleHotel->image; ?>" alt="" style="width: 25rem; height: 17rem; border-radius: 0.5rem;">
                <p class="card-text"><strong>Hotel Image Name: </strong><?php echo $singleHotel->image; ?></p>
                <p class="card-text"><strong>Hotel ID: </strong><?php echo $singleHotel->id; ?></p>
                <p class="card-text"><strong>Hotel Status: </strong><?php echo $singleHotel->status; ?></p>
                <p class="card-text"><strong>Hotel Name: </strong><?php echo $singleHotel->name; ?></p>
                <p class="card-text"><strong>Hotel Location: </strong><?php echo $singleHotel->location; ?></p>
                <p class="card-text"><strong>Hotel Description: </strong><?php echo $singleHotel->description; ?></p>
                <p class="card-text"><strong>Hotel Created At: </strong><?php echo $singleHotel->created_at; ?></p>
            </div>
        </div>
        <a  href="status-hotels.php?id=<?php echo $singleHotel->id; ?>" class="btn btn-warning text-white text-center ">Change <?php echo $singleHotel->name; ?> Hotel Status</a>
        <a  href="update-hotels.php?id=<?php echo $singleHotel->id; ?>" class="btn btn-warning text-white text-center ">Update <?php echo $singleHotel->name; ?> Hotel</a>
        <a href="delete-hotels.php?id=<?php echo $singleHotel->id; ?>" class="btn btn-danger  text-center ">Delete <?php echo $singleHotel->name; ?> Hotel</a>
        <a  href="show-hotels.php" class="btn btn-primary text-white text-center">Back</a>

    </div>
</div>


 <?php require "../layouts/footer.php"; ?>

