<?php require "../layouts/header.php"; ?>
<?php require "../../config/config.php"; ?>
<?php
if(!isset($_SESSION['adminname'])){
    echo "<script>window.location.href='".ADMINURL."/admins/login-admins.php' </script>";
  }
            
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $room = $conn->query("SELECT * FROM rooms WHERE id='$id'");
    $room->execute();
        
    $singleRoom = $room->fetch(PDO::FETCH_OBJ);

} else {
    echo "<script>window.location.href='".ADMINURL."/404.php'</script>";
}

?>
<div class="row">
    <div class="col">
        <div class="card">
            <h2 class="card-title" style="margin-top: 2rem; margin-left: 2rem;"><strong>Room Details</strong></h2>
            <div class="card-body">
                <img src="<?php echo ROOMSIMAGES; ?>/<?php echo $singleRoom->image; ?>" alt="" style="width: 25rem; height: 17rem; border-radius: 0.5rem;">
                <p class="card-text"><strong>Room Image Name: </strong><?php echo $singleRoom->image; ?></p>
                <p class="card-text"><strong>Room ID: </strong><?php echo $singleRoom->id; ?></p>
                <p class="card-text"><strong>Room Status: </strong><?php echo $singleRoom->status; ?></p>
                <p class="card-text"><strong>Room Name: </strong><?php echo $singleRoom->name; ?></p>
                <p class="card-text"><strong>Room Hotel Name: </strong><?php echo $singleRoom->hotel_name; ?></p>
                <p class="card-text"><strong>Room Price: </strong>₦<?php echo $singleRoom->price; ?></p>
                <p class="card-text"><strong>Room View: </strong><?php echo $singleRoom->view; ?></p>
                <p class="card-text"><strong>Room No. of Persons: </strong><?php echo $singleRoom->num_persons; ?></p>
                <p class="card-text"><strong>Room No. of Beds: </strong><?php echo $singleRoom->num_beds; ?></p>
                <p class="card-text"><strong>Room Size: </strong><?php echo $singleRoom->size; ?>m2</p>
                <p class="card-text"><strong>Room Created At: </strong><?php echo $singleRoom->created_at; ?></p>
            </div>
        </div>
        <a  href="status-rooms.php?id=<?php echo $singleRoom->id; ?>" class="btn btn-warning text-white text-center ">Change <?php echo $singleRoom->name; ?> Status</a>
        <a  href="update-rooms.php?id=<?php echo $singleRoom->id; ?>" class="btn btn-warning text-white text-center ">Update <?php echo $singleRoom->name; ?></a>
        <a  href="delete-rooms.php?id=<?php echo $singleRoom->id; ?>" class="btn btn-danger  text-center ">Delete <?php echo $singleRoom->name; ?></a>
        <a  href="show-rooms.php" class="btn btn-primary text-white text-center">Back</a>

    </div>
</div>


 <?php require "../layouts/footer.php"; ?>
