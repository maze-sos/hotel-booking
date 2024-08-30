<?php require "../layouts/header.php"; ?>
<?php require "../../config/config.php"; ?>

<?php 

if(!isset($_SESSION['adminname'])){
  echo "<script>window.location.href='".ADMINURL."/admins/login-admins.php' </script>";
}

$hotels = $conn->query("SELECT * FROM hotels");
$hotels->execute();

$allHotels = $hotels->fetchAll(PDO::FETCH_OBJ);


?> 

          <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-4 d-inline">Hotels</h5>
             <a  href="create-hotels.php" class="btn btn-primary mb-4 text-center float-right">Create Hotels</a>
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">name</th>
                    <th scope="col">location</th>
                    <th scope="col">status value</th>
                    <th scope="col">manage</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($allHotels as $hotels) : ?>
                  <tr>
                    <th scope="row"><?php echo $hotels->id; ?></th>
                    <td><?php echo $hotels->name; ?></td>
                    <td><?php echo $hotels->location; ?></td>
                    <td><?php echo $hotels->status; ?></td>
                    <td><a  href="manage-hotels.php?id=<?php echo $hotels->id; ?>" class="btn btn-primary text-white text-center ">Manage <?php echo $hotels->name; ?> Hotel Details</a></td>
                  </tr>
                  <?php endforeach; ?>
  
                </tbody>
              </table> 
            </div>
          </div>
        </div>
      </div>


 <?php require "../layouts/footer.php"; ?>