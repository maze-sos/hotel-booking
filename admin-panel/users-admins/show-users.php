<?php require "../layouts/header.php"; ?>
<?php require "../../config/config.php"; ?>
<?php 

if(!isset($_SESSION['adminname'])){
  echo "<script>window.location.href='".ADMINURL."/admins/login-admins.php' </script>";
}

$users = $conn->query("SELECT * FROM users");
$users->execute();

$allUsers = $users->fetchAll(PDO::FETCH_OBJ);


?> 
    <div class="container-fluid">

              <h5 class="card-title mb-4 d-inline">Users</h5>
            
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">username</th>
                    <th scope="col">phone number</th>
                    <th scope="col">email</th>
                    <th scope="col">login status</th>
                    <th scope="col">created at</th>
                    <th scope="col">change status</th>
                    <th scope="col">delete</th>
                  </tr>
                </thead>
                <tbody>
                <?php foreach($allUsers as $user) : ?>
                  <tr>
                    <th scope="row"><?php echo $user->id; ?></th>
                    <td><?php echo $user->username; ?></td>
                    <td><?php echo $user->phone; ?></td>
                    <td><?php echo $user->email; ?></td>
                    <td><?php echo $user->status; ?></td>
                    <td><?php echo $user->created_at; ?></td>
                    
                    <td><a href="status-users.php?id=<?php echo $user->id; ?>" class="btn btn-warning  text-white text-center ">change <?php echo $user->username; ?> Status</a></td>
                    <td><a href="delete-users.php?id=<?php echo $user->id; ?>" class="btn btn-danger  text-center ">Delete <?php echo $user->username; ?> </a></td>
                  </tr>
                  <?php endforeach; ?>
                </tbody>
              </table> 
      </div>

<?php require "../layouts/footer.php"; ?>