<?php require "../includes/header.php" ?>
<?php require "../config/config.php" ?>
<?php 

    if(!isset($_SESSION['username'])) {
        echo "<script>window.location.href='".APPURL."'</script>"; 
    }

    if(isset($_GET['id'])) {
        $id = $_GET['id'];

		$user = $conn->query("SELECT * FROM users WHERE id='$id'");
		$user->execute();
			
		$singleUser = $user->fetch(PDO::FETCH_OBJ);

    } else {
        echo "<script>window.location.href='".APPURL."/404.php'</script>"; 
    }

?>

	<section class="ftco-section ftco-book ftco-no-pt ftco-no-pb">
    	<div class="container">    	
	    	<div class="card justify-content-middle col-md-6 mt-5 mb-5">
			<h3 class="mb-3"><?php echo $singleUser->username; ?> Account Details</h3>
			<p class="card-text"><strong>Username: </strong><?php echo $singleUser->username; ?></p>
			<p class="card-text"><strong>Email: </strong><?php echo $singleUser->email; ?></p>
			<p class="card-text"><strong>Phone Number: </strong><?php echo $singleUser->phone; ?></p>
			<p class="card-text"><strong>Created At: </strong><?php echo $singleUser->created_at; ?></p>
			<a  href="accountsettings.php?id=<?php echo $singleUser->id; ?>" class="btn btn-primary text-center mb-2 ">Edit <?php echo $singleUser->username; ?>'s Details</a>
			<a  href="accountpassword.php?id=<?php echo $singleUser->id; ?>" class="btn btn-primary text-center mb-2 ">Change <?php echo $singleUser->username; ?>'s Password</a>
	    	</div>	    	
	    </div>
    </section>

<?php require "../includes/footer.php" ?>