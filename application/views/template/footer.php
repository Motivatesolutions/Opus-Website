<footer class="ftco-footer ftco-bg-dark ftco-section">
      <div class="container">
        <div class="row">
          <div class="logo g-width-100--xs g-height-auto--xs">
            <img src="<?php echo base_url('assets/client/images/banners/Opus Music Logo.png'); ?>" alt="">
          </div>
        </div>
        <div class="row mb-5 bg-dark p-4">
          <div class="col-md">
            <div class="ftco-footer-widget mb-4">
              <h2 class="ftco-heading-2">About Opus</h2>
              <p>Our accounting team identify rewarding <br> outcomes for your catalogue. <br> Whether <br> resolving rights management issues or <br> seeking creative opportunities,<br> we're</p>
              
            </div>
          </div>
          <i class="border border-light g-display-block--md g-display-none--xs"></i>
          <div class="col-md">
            <div class="ftco-footer-widget mb-4 ml-md-5">
              <h2 class="ftco-heading-2">Links</h2>
              <ul class="list-unstyled">
                <li><a href="<?= base_url()?>" class="d-block">Home</a></li>
                <li><a href="<?= base_url('about')?>" class="d-block">About</a></li>
                <li><a href="<?= base_url('what_we_do')?>" class="d-block">What we do</a></li>
                <li><a href="<?= base_url('clients/artists')?>" class="d-block">Clients / Artists</a></li>
                <li><a href="<?= base_url('blog')?>" class="d-block">Blog</a></li>
                <li><a href="<?= base_url('contact')?>" class="d-block">Contact</a></li>
              </ul>
            </div>
          </div>
          <i class="border border-light g-display-block--md g-display-none--xs"></i>
          <div class="col-md">
            <div class="ftco-footer-widget mb-4">
            	<h2 class="ftco-heading-2">Office</h2>
            	<div class="block-23 mb-2">
	              <ul>
	                <li><span class="icon icon-map-marker"></span><span class="text"><?=($this->systemdata->ug_address); ?></span></li>
	                <li><a href="#"><span class="icon icon-phone"></span><span class="text"><?=($this->systemdata->ug_contact); ?></span></a></li>
	                <li><a href="mailto:<?=($this->systemdata->semail); ?>"><span class="icon icon-envelope"></span><span class="text"><?=($this->systemdata->semail); ?></span></a></li>
                </ul>
              </div>
              <ul class="ftco-footer-social list-unstyled float-md-left float-lft">
                  <li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
                  <li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
                  <li class="ftco-animate"><a href="#"><span class="icon-youtube"></span></a></li>
                  <li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
                </ul>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 text-center">

            <p>
              <span class="float-md-left">Copyright &copy;<script>document.write(new Date().getFullYear());</script> <?=($this->systemdata->sname); ?>.</span>
              <span class="float-md-right">made with <i class="icon-heart" aria-hidden="true"></i> by <a href="#" target="_blank">Motivate Solutions</a></span>
            </p>
          </div>
        </div>
      </div>
    </footer>
    
  

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