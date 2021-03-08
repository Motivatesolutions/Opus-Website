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
	  
    <!--  -->
    <section class="home-slider owl-carousel">
      <div class="slider-item bread-item single_blog" style="background-image: url('<?php echo base_url('assets/client/images/banners/bg2.jpg'); ?>'" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container-fluid">
          <div class="row slider-text align-items-center justify-content-center" data-scrollax-parent="true">

            <div class="col-md-8 mt-5 text-center col-sm-12 ftco-animate" data-scrollax=" properties: { translateY: '70%' }">
	            <h1 class="mb-3 bread" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">Blog Details</h1>
            <p class="breadcrumbs" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"><span class="mr-2"><a href="<?= base_url()?>">Home</a></span> <span class="mr-2"><a href="<?= base_url('blog')?>">Blog</a></span> <span>Blog Details</span></p>
            </div>
          </div>
        </div>
      </div>
    </section>
  
    <section class="ftco-section">
      <div class="container">
        <div class="row">
          <div class="col-md-8 ftco-animate">
            
            <h2 class="mb-3"><?=ucwords(strtolower($blogRow->blog_title));?></h2>
            
            <p>
              <img src="<?=base_url('uploads/blogs/'.$blogRow->blog_file); ?>" alt="" class="img-fluid">
            </p>
            <p><?=($blogRow->blog_content);?></p>
            

          </div> <!-- .col-md-8 -->
          <div class="col-md-4 sidebar ftco-animate">

            <div class="sidebar-box ftco-animate">
              <h3>Recent Blog</h3>
              <?php if (count($blogResult) > 0) :
                foreach ($blogResult as $grow) : 
              ?>
                <div class="block-21 mb-4 d-flex">
                  <a class="blog-img mr-4" style="background-image: url('<?=base_url('uploads/blogs/'.$grow['blog_file']); ?>');"></a>
                  <div class="text">
                    <h3 class="heading"><a href="<?=base_url('blog/single_blog/'.$grow['blog_id'].'/'.url_title(strtolower($grow['blog_title']), 'dash', true));?>"><?=ucwords(strtolower($grow['blog_title']));?></a></h3>
                    <div class="meta">
                      <div><a href="#"><span class="icon-calendar"></span>&nbsp <?=date('d M, Y', strtotime($grow['created_at']));?></a></div>
                      <div><a href="#"><span class="icon-person"></span> <?=($grow['created_by']);?></a></div>
                      <!-- <div><a href="#"><span class="icon-chat"></span> 19</a></div> -->
                    </div>
                  </div>
                </div>
              <?php endforeach; ?>
              <br>
              <?php endif; ?>
            </div>

        </div>
      </div>
    </section> <!-- .section -->

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