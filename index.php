<?php require "includes/header.php" ?>
<?php require "config/config.php" ?>
<?php 

	$hotels = $conn->query("SELECT * FROM hotels WHERE status = 1 ORDER BY created_at DESC LIMIT 3");
	$hotels->execute();

	$allHotels = $hotels->fetchAll(PDO::FETCH_OBJ);

	$rooms = $conn->query("SELECT rooms.* FROM rooms JOIN hotels ON rooms.hotel_id = hotels.id WHERE hotels.status = 1 ORDER BY created_at DESC LIMIT 4");
	$rooms->execute();

	$allRooms = $rooms->fetchAll(PDO::FETCH_OBJ);


	$countRooms = $conn->query(" SELECT COUNT(rooms.id) as room_count FROM rooms JOIN hotels ON rooms.hotel_id = hotels.id WHERE hotels.status = 1 AND rooms.status = 1");
	$countAllRooms = $countRooms->fetch(PDO::FETCH_ASSOC);


?>
    <div class="hero-wrap js-fullheight" style="background-image: url('<?php echo APPURL; ?>/images/image_2.jpg');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-start" data-scrollax-parent="true">
          <div class="col-md-7 ftco-animate">
          	<h2 class="subheading">Welcome to Vacation Rental</h2>
          	<h1 class="mb-4">Book an Hotel for your Vacation</h1>
            <p><a href="<?php echo APPURL; ?>/about.php" class="btn btn-primary">Learn more</a> <a href="<?php echo APPURL; ?>/contact.php" class="btn btn-white">Contact us</a></p>
          </div>
        </div>
      </div>
    </div>

  
    <section class="ftco-section ftco-services">
    	<div class="container">
    		<div class="row">
				<?php foreach($allHotels as $hotel) : ?>
				<div class="col-md-4 d-flex services align-self-stretch px-4 ftco-animate">
					<div class="d-block services-wrap text-center">
						<div class="img" style="background-image: url(<?php echo HOTELSIMAGES; ?>/<?php echo $hotel->image; ?>);"></div>
						<div class="media-body py-4 px-3">
							<h3 class="heading"><?php echo $hotel->name; ?></h3>
							<p><?php echo $hotel->description; ?></p>
							<p>Location: <?php echo $hotel->location; ?>.</p>
							<p><a href="rooms.php?id=<?php echo $hotel->id; ?>" class="btn btn-primary">View rooms</a></p>
						</div>
					</div>      
				</div>
				<?php endforeach; ?>
				<div class="row no-gutters justify-content-center col-md-12"><a href="<?php echo APPURL; ?>/allhotels.php" class="btn btn-primary px-4 py-3 mt-5">Load More Hotels</a></div>
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
				<div class="row no-gutters justify-content-center col-md-12"><a href="<?php echo APPURL; ?>/allrooms.php" class="btn btn-primary px-4 py-3 mt-5">Load More Rooms</a></div>
    		</div>
		</div>
	</section>
		
		<section class="ftco-intro" style="background-image: url(images/image_2.jpg);" data-stellar-background-ratio="0.5">
			<div class="overlay"></div>
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-md-9 text-center">
						<h2>Ready to get started</h2>
						<p class="mb-4">It’s safe to book online with us! Get your dream stay in clicks or drop us a line with your questions.</p>
						<p class="mb-0"><a href="<?php echo APPURL; ?>/about.php" class="btn btn-primary px-4 py-3">Learn More</a> <a href="<?php echo APPURL; ?>/contact.php" class="btn btn-white px-4 py-3">Contact us</a></p>
					</div>
				</div>
			</div>
		</section>
<?php require "includes/footer.php" ?>