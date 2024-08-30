<?php require "../layouts/header.php"; ?>
<?php require "../../config/config.php"; ?>
<?php
if(!isset($_SESSION['adminname'])){
  echo "<script>window.location.href='".ADMINURL."/admins/login-admins.php' </script>";
}

$hotels = $conn->query("SELECT * FROM hotels");
$hotels->execute();

$allHotels = $hotels->fetchAll(PDO::FETCH_OBJ);

if(isset($_GET['id'])){
    $id = $_GET['id']; 
  $room = $conn->query("SELECT * FROM rooms WHERE id='$id'");
  $room->execute();
  
  $roomSingle = $room->fetch(PDO::FETCH_OBJ);

if(isset($_POST['submit'])){
  if(empty($_POST['name']) OR empty($_POST['price']) OR empty($_POST['num_persons']) 
  OR empty($_POST['num_beds']) OR empty($_POST['size']) OR empty($_POST['view']) OR empty($_POST['hotel_name']) OR empty($_POST['hotel_id']) ) {
  echo "<script>alert('one or more input are empty')</script>";
} else {
  
  $name = $_POST['name'];
  $price = $_POST['price'];
  $num_persons = $_POST['num_persons'];
  $num_beds = $_POST['num_beds'];
  $size = $_POST['size'];
  $view = $_POST['view'];
  $hotel_name = $_POST['hotel_name'];
  $hotel_id = $_POST['hotel_id'];
  $image = $_FILES['image']['name'];

  $dir = "rooms_images/" . basename($image);

  $update = $conn->prepare("UPDATE rooms SET name = :name, price = :price, num_persons = :num_persons, num_beds = :num_beds, size = :size, view = :view, hotel_name = :hotel_name, hotel_id = :hotel_id, image = :image WHERE id='$id' ");

  $update->execute([
    ":name" => $name,
    ":price" => $price,
    ":num_persons" => $num_persons,
    ":num_beds" => $num_beds,
    ":size" => $size,
    ":view" => $view,
    ":hotel_name" => $hotel_name,
    ":hotel_id" => $hotel_id,
    ":image" => $image
  ]);


  echo "<script>window.location.href='".ADMINURL."/rooms-admins/show-hotels.php' </script>";

}
}
}

?>
    <div class="container-fluid">
       <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-5 d-inline">Update Room</h5>
          <form method="POST" action="update-rooms.php?id=<?php echo $id; ?>" enctype="multipart/form-data">
                <!-- Email input -->
                <div class="form-outline mb-4 mt-4">
                  <input type="text" value="<?php echo $roomSingle->name; ?>" name="name" id="form2Example1" class="form-control" placeholder="name" />
                 
                </div>
                <div class="form-outline mb-4 mt-4">
                  <input type="file" value="<?php echo $roomSingle->image; ?>" name="image" id="form2Example1" class="form-control" />
                 
                </div>  
                <div class="form-outline mb-4 mt-4">
                  <input type="text" value="<?php echo $roomSingle->price; ?>" name="price" id="form2Example1" class="form-control" placeholder="price" />
                 
                </div> 
                 <div class="form-outline mb-4 mt-4">
                  <input type="text" value="<?php echo $roomSingle->num_persons; ?>" name="num_persons" id="form2Example1" class="form-control" placeholder="num_persons" />
                 
                </div> 
                <div class="form-outline mb-4 mt-4">
                  <input type="text" value="<?php echo $roomSingle->num_beds; ?>" name="num_beds" id="form2Example1" class="form-control" placeholder="num_beds" />
                 
                </div> 
                <div class="form-outline mb-4 mt-4">
                  <input type="text" value="<?php echo $roomSingle->size; ?>" name="size" id="form2Example1" class="form-control" placeholder="size" />
                 
                </div> 
               <div class="form-outline mb-4 mt-4">
                <input type="text" value="<?php echo $roomSingle->view; ?>" name="view" id="form2Example1" class="form-control" placeholder="view" />
               
               </div> 
               <select name="hotel_name" class="form-control">
                <option>Choose Hotel Name</option>
                <?php foreach($allHotels as $hotel) : ?>
                <option value="<?php echo $hotel->name; ?>"><?php echo $hotel->name; ?></option>
                <?php endforeach ?>
               </select>
               <br>
   
               <select name="hotel_id" class="form-control">
                <option>Choose Same Hotel id</option>
                <?php foreach($allHotels as $hotel) : ?>
                <option value="<?php echo $hotel->id; ?>"><?php echo $hotel->name; ?></option>
                <?php endforeach ?>
               </select>
               <br>

              <button type="submit" name="submit" class="btn btn-warning text-white text-center">update room</button>
              <a  href="manage-rooms.php?id=<?php echo $hotelSingle->id; ?>" class="btn btn-primary text-white text-center">Back</a>

          
              </form>

<?php require "../layouts/footer.php"; ?>