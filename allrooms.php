<?php require "includes/header.php" ?>
<?php require "config/config.php" ?>
<?php 


	$rooms = $conn->query("SELECT rooms.* FROM rooms JOIN hotels ON rooms.hotel_id = hotels.id WHERE hotels.status = 1 ORDER BY created_at DESC");
	$rooms->execute();

	$allRooms = $rooms->fetchAll(PDO::FETCH_OBJ);


	$countRooms = $conn->query(" SELECT COUNT(rooms.id) as room_count FROM rooms JOIN hotels ON rooms.hotel_id = hotels.id WHERE hotels.status = 1 AND rooms.status = 1");
	$countAllRooms = $countRooms->fetch(PDO::FETCH_ASSOC);

?>

    <section class="hero-wrap hero-wrap-2" style="background-image: url('images/image_2.jpg');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-9 ftco-animate text-center">
          	<p class="breadcrumbs mb-2"><span class="mr-2"><a href="index.php">Home <i class="fa fa-chevron-right"></i></a></span> <span><?php if ($countAllRooms['room_count'] <= 1) { ?> <?php echo 'Room';?><?php } else { ?><?php echo 'All Rooms';?><?php }?><i class="fa fa-chevron-right"></i></span></p>
            <h1 class="mb-0 bread"><?php if ($countAllRooms['room_count'] <= 1) { ?> <?php echo 'Room';?><?php } else { ?><?php echo 'All Rooms';?><?php }?></h1>
          </div>
        </div>
      </div>
    </section>
   
    <section class="ftco-section bg-light">
		<div class="container-fluid px-md-0">
			<div class="row no-gutters justify-content-center pb-5 mb-3">
				<div class="col-md-7 heading-section text-center ftco-animate">
				<h2><?php if ($countAllRooms['room_count'] <= 1) { ?> <?php echo 'Room';?><?php } else { ?><?php echo 'Rooms';?><?php }?></h2>
				</div>
    		</div>
			<div class="row no-gutters">
			<?php foreach($allRooms as $room) : ?>
    			<div class="col-lg-6">
    				<div class="room-wrap d-md-flex">
    					<a href="<?php echo APPURL; ?>/rooms/room-single.php?id=<?php echo $room->id; ?>" class="img" style="background-image: url(<?php echo ROOMSIMAGES; ?>/<?php echo $room->image; ?>);"></a>
    					<div class="half left-arrow d-flex align-items-center">
    						<div class="text p-4 p-xl-5 text-center">
    							<p class="star mb-0"><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span></p>
    							<!-- <p class="mb-0"><span class="price mr-1">$120.00</span> <span class="per">per night</span></p> -->
	    						<h3 class="mb-3"><a href="<?php echo APPURL; ?>/rooms/room-single.php?id=<?php echo $room->id; ?>"><?php echo $room->name; ?></a></h3>
	    						<ul class="list-accomodation">
	    							<li><span>Max:</span> <?php echo $room->num_persons; ?> <?php if ($room->num_persons <=1) { ?> <?php echo 'Person';?><?php } else { ?><?php echo 'Persons';?><?php }?></li>
	    							<li><span>Size:</span> <?php echo $room->size; ?> m2</li>
	    							<li><span>View:</span> <?php echo $room->view; ?></li>
	    							<li><span>Bed:</span> <?php echo $room->num_beds; ?> <?php if ($room->num_beds <=1) { ?> <?php echo 'Bed';?><?php } else { ?><?php echo 'Beds';?><?php }?></li>
									<li><span>Price per Night:</span> ₦<?php echo $room->price; ?></li>
	    						</ul>
	    						<p class="pt-1"><a href="<?php echo APPURL; ?>/rooms/room-single.php?id=<?php echo $room->id; ?>" class="btn-custom px-3 py-2">View Room Details <span class="icon-long-arrow-right"></span></a></p>
    						</div>
    					</div>
    				</div>
    			</div>
				<?php endforeach; ?>
    		</div>
		</div>
	</section>
		
<?php require "includes/footer.php" ?>