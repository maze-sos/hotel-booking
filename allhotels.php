<?php require "includes/header.php" ?>
<?php require "config/config.php" ?>
<?php 


    $hotels = $conn->query("SELECT * FROM hotels WHERE status = 1 ORDER BY created_at DESC");
    $hotels->execute();

    $allHotels = $hotels->fetchAll(PDO::FETCH_OBJ);

    $hotelsCount = $conn->query("SELECT COUNT(*) AS count_hotels FROM hotels WHERE status = 1");
    $hotelsCount->execute();

    $allHotelsCount = $hotelsCount->fetch(PDO::FETCH_OBJ);



?>

    <section class="hero-wrap hero-wrap-2" style="background-image: url('images/image_2.jpg');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-9 ftco-animate text-center">
          	<p class="breadcrumbs mb-2"><span class="mr-2"><a href="index.php">Home <i class="fa fa-chevron-right"></i></a></span> <span><?php if ($allHotelsCount->count_hotels <= 1) { ?> <?php echo 'Hotel';?><?php } else { ?><?php echo 'All Hotels';?><?php }?><i class="fa fa-chevron-right"></i></span></p>
            <h1 class="mb-0 bread"><?php if ($allHotelsCount->count_hotels <= 1) { ?> <?php echo 'Hotel';?><?php } else { ?><?php echo 'All Hotels';?><?php }?></h1>
          </div>
        </div>
      </div>
    </section>
   
            <section class="ftco-section ftco-services">
                <div class="container">
                    <div class="row">
                        <?php foreach($allHotels as $hotel) : ?>
                        <div class="col-md-4 d-flex services align-self-stretch px-4 ftco-animate mb-5">
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
                    </div>
                </div>
            </section>

		
<?php require "includes/footer.php" ?>