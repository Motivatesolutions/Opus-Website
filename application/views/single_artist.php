<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Opus Music</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:300,400,,500,600,700" rel="stylesheet">
    <link rel="shortcut icon"  type=" image/png" href="<?=base_url('uploads/logo/'.$this->systemdata->sphoto); ?>">
    <link rel="stylesheet" href="<?=base_url('assets/client/css/open-iconic-bootstrap.min.css');?>">
    <link rel="stylesheet" href="<?=base_url('assets/client/css/animate.css');?>">
    
    <link rel="stylesheet" href="<?=base_url('assets/client/css/owl.carousel.min.css');?>">
    <link rel="stylesheet" href="<?=base_url('assets/client/css/owl.theme.default.min.css');?>">
    <link rel="stylesheet" href="<?=base_url('assets/client/css/magnific-popup.css');?>">

    <link rel="stylesheet" href="<?=base_url('assets/client/css/aos.css');?>">

    <link rel="stylesheet" href="<?=base_url('assets/client/css/ionicons.min.css');?>">

    <link rel="stylesheet" href="<?=base_url('assets/client/css/bootstrap-datepicker.css');?>">
    <link rel="stylesheet" href="<?=base_url('assets/client/css/jquery.timepicker.css');?>">

    
    <link rel="stylesheet" href="<?=base_url('assets/client/css/flaticon.css');?>">
    <link rel="stylesheet" href="<?=base_url('assets/client/css/icomoon.css');?>">
    <link rel="stylesheet" href="<?=base_url('assets/client/css/globle.css');?>">
    <link rel="stylesheet" href="<?=base_url('assets/client/css/style.css');?>">
  </head>
  <body>
	  
    <section class="ftco-services single_artist" style="background-image: url('<?php echo base_url('assets/client/images/banners/single_artist_bg.jpg'); ?>'" >
        <div class="container-fluid">
            <div class="services-wrap p-md-5">
                <div class="row justify-content-center align-items-center">
                    <div class="heading-section mt-3 mb-2 text-center ftco-animate">
                        <h1 class="text-light h1-header"><?=($artistRow->artist_name)?></h1>
                    </div>
                </div>
                <div class="row d-block-12 pt-3">
                    <div class="col-lg-12">
                        <div class="row team-2 mb-50">
                            <div class="col-xl-4 col-lg-5 col-md-4 col-sm-12 col-pad ">
                                <div class="photo">
                                    <img src="<?php echo base_url('uploads/artists/' . ($artistRow->photo)); ?>" alt="artist-image" class="img-fluid">
                                   
                                    <div class="songs">
                                    <h4 class="text-light p-2">Songs</h4>
                                    <div id="ubaplayer"></div>
                                    <ul class="ubaplayer-controls p-2">
                                        <?php foreach ($this->trackData as $trackData) {?>
                                            <?php if ($artistRow->artist_id == $trackData->artist_id) : ?>
                                                <li><a class="ubaplayer-button" href="<?php echo base_url('uploads/tracks/audio/' . $trackData->track); ?>"><?=($trackData->track_title)?></a></li>
                                            <?php endif;?>
                                        <?php }?>
                                    </ul>
                                </div>
                                </div><br>
                                
                            </div>
                            <div class="col-xl-8 col-lg-7 col-md-8 col-sm-12 col-pad align-self-center bg">
                                <div class="detail">
                                    <h4>
                                        <a>Biography</a>
                                    </h4>
                                    <div class="contact">
                                        <p><?=($artistRow->biography)?></p>
                                    </div>
                                     <h4>
                                        <a>Album</a>
                                    </h4>
                                    <div class="contact">
                                        <p> Opus music <span> ~ 24 <i>Songs</i></span></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="social-list d-block">
                                    <a href="#" class="facebook-bg p-2"><i class="icon icon-facebook"></i></a>
                                    <a href="#" class="twitter-bg p-2"><i class="icon icon-twitter"></i></a>
                                    <a href="#" class="google-bg p-2"><i class="icon icon-youtube"></i></a>
                                    
                                    <a href="<?= base_url('artists')?>" class="float-md-right btn btn-default btm-md">Go Back</a>
                                   
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
		</div>
    </section>
       <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>


  <script src="<?=base_url('assets/client/js/jquery.min.js');?>"></script>
  <script src="<?=base_url('assets/client/js/jquery-migrate-3.0.1.min.js');?>"></script>
  <script src="<?=base_url('assets/client/js/popper.min.js');?>"></script>
  <script src="<?=base_url('assets/client/js/bootstrap.min.js');?>"></script>
  <script src="<?=base_url('assets/client/js/jquery.easing.1.3.js');?>"></script>
  <script src="<?=base_url('assets/client/js/jquery.waypoints.min.js');?>"></script>
  <script src="<?=base_url('assets/client/js/jquery.stellar.min.js');?>"></script>
  <script src="<?=base_url('assets/client/js/owl.carousel.min.js');?>"></script>
  <script src="<?=base_url('assets/client/js/jquery.magnific-popup.min.js');?>"></script>
  <script src="<?=base_url('assets/client/js/aos.js');?>"></script>
  <script src="<?=base_url('assets/client/js/jquery.animateNumber.min.js');?>"></script>
  <script src="<?=base_url('assets/client/js/bootstrap-datepicker.js');?>"></script>
  <script src="<?=base_url('assets/client/js/jquery.timepicker.min.js');?>"></script>
  <script src="<?=base_url('assets/client/js/scrollax.min.js');?>"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
  <script src="<?=base_url('assets/client/js/google-map.js');?>"></script>
  <script src="<?=base_url('assets/client/js/main.js');?>"></script>
  <script src="<?=base_url('assets/client/js/jquery.ubaplayer.js');?>"></script>
  <script>
    $(function(){
      $("#ubaplayer").ubaPlayer({
      codecs: [{name:"MP3,MP4", codec: 'uploads/tracks/audio;'}]
      });
    });
  </script>
  </body>
</html>