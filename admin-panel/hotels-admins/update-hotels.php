<?php require "../layouts/header.php"; ?>
<?php require "../../config/config.php"; ?>
<?php
if(!isset($_SESSION['adminname'])){
  echo "<script>window.location.href='".ADMINURL."/admins/login-admins.php' </script>";
}
if(isset($_GET['id'])){
  $id = $_GET['id'];
$hotel = $conn->query("SELECT * FROM hotels WHERE id='$id'");
$hotel->execute();

$hotelSingle = $hotel->fetch(PDO::FETCH_OBJ);

  if(isset($_POST['submit'])) {
    if(empty($_POST['name']) OR empty($_POST['description']) OR empty($_POST['location'])) {
  echo "<script>alert('one or more input are empty')</script>";
} else {

  $name = $_POST['name'];
  $description = $_POST['description'];
  $location = $_POST['location'];
  $image = $_FILES['image']['name'];

  $dir = "hotels_image/" . basename($image);


  $update = $conn->prepare("UPDATE hotels SET name = :name, description = :description, location = :location, image = :image WHERE id='$id'");
  $update->execute([
    ":name" => $name,
    ":description" => $description,
    ":location" => $location,
    ":image" => $image
  ]);


  // header("location: show-hotels.php");
  echo "<script>window.location.href='".ADMINURL."/hotels-admins/show-hotels.php' </script>";



  }
}

  

}

?>
 <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-5 d-inline">Update Hotel</h5>
          <form method="POST" action="update-hotels.php?id=<?php echo $id; ?>">
                <div class="form-outline mb-4 mt-4">
                  <label for="name">Name:</label>
                  <input type="text" value="<?php echo $hotelSingle->name; ?>" name="name" id="form2Example1" class="form-control" placeholder="name" />
                 
                </div>
                <div class="form-group">
                  <label for="description">Description:</label>
                  <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3"><?php echo $hotelSingle->description; ?></textarea>
                </div>

                <div class="form-outline mb-4 mt-4">
                  <label for="location">Location:</label>
                  <input type="text"  value="<?php echo $hotelSingle->location; ?>" name="location" id="form2Example1" class="form-control"/>
                 
                </div>
                
                <div class="form-outline mb-4 mt-4">
                 <label for="image">Image:</label>
                  <input type="file" name="image" id="form2Example1" class="form-control"/>
                </div>
      
                
                <button type="submit" name="submit" class="btn btn-warning text-white text-center">Update <?php echo $hotelSingle->name; ?> Hotel</button>
                <a  href="manage-hotels.php?id=<?php echo $hotelSingle->id; ?>" class="btn btn-primary text-white text-center">Back</a>
                
          
              </form>

            </div>
          </div>
        </div>
      </div>
<?php require "../layouts/footer.php"; ?>