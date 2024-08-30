<?php
require "../layouts/header.php";
require "../../config/config.php";
if(!isset($_SESSION['adminname'])){
    echo "<script>window.location.href='".ADMINURL."/admins/login-admins.php' </script>";
  }

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $room = $conn->query("SELECT * FROM rooms WHERE id='$id'");
    $room->execute();
        
    $singleRoom = $room->fetch(PDO::FETCH_OBJ);
    
    
    if(isset($_POST['submit'])) {
    $getImage = $conn->query("SELECT * FROM rooms WHERE id='$id'");
    $getImage->execute();

    $fetch = $getImage->fetch(PDO::FETCH_OBJ);

    unlink("rooms_images/" . $fetch->image);



    $delete = $conn->query("DELETE FROM rooms WHERE id='$id'");
    $delete->execute();


    // header("location: show-rooms.php");
    echo "<script>window.location.href='".ADMINURL."/rooms-admins/show-hotels.php' </script>";

    }
}

?>

<div class="row">
    <div class="col">
        <div class="card">
            <h2 class="card-title" style=" color: red; margin-top: 2rem; margin-left: 2rem;"><strong>Delete Room?</strong></h2>
            <div class="card-body">
                <img src="<?php echo ROOMSIMAGES; ?>/<?php echo $singleRoom->image; ?>" alt="" style="width: 25rem; height: 17rem; border-radius: 0.5rem;">
                <p class="card-text"><strong>Room Name: </strong><?php echo $singleRoom->name; ?></p>
                <p class="card-text"><strong>Room Hotel Name: </strong><?php echo $singleRoom->hotel_name; ?></p>
                <p class="card-text"><strong>Room Price: </strong>₦<?php echo $singleRoom->price; ?></p>
                <p class="card-text"><strong>Room No. of Persons: </strong><?php echo $singleRoom->num_persons; ?></p>
                <p class="card-text"><strong>Room No. of Beds: </strong><?php echo $singleRoom->num_beds; ?></p>
                <p class="card-text"><strong>Room Size: </strong><?php echo $singleRoom->size; ?>m2</p>
                <p class="card-text"><strong>Room Created At: </strong><?php echo $singleRoom->created_at; ?></p>
            </div>
        </div>
        <form method="post">
        <button type="submit" name="submit" class="btn btn-danger  text-center ">Delete <?php echo $singleRoom->name; ?></button>
        <a  href="manage-rooms.php?id=<?php echo $singleRoom->id; ?>" class="btn btn-primary text-white text-center">Back</a>
        </form>
    </div>
</div>


 <?php require "../layouts/footer.php"; ?>