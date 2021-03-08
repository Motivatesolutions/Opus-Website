
    <section class="home-slider owl-carousel">
      <div class="slider-item bread-item" style="background-image: url('<?php echo base_url('assets/client/images/banners/pexels-daniel-reche-3721941.jpg'); ?>'" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container-fluid">
          <div class="row slider-text align-items-center justify-content-center" data-scrollax-parent="true">

            <div class="col-md-6 about p-3 mt-5 text-center col-sm-12 ftco-animate " data-scrollax=" properties: { translateY: '70%' }">
	            <h1 data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">About Opus.</h1>
            </div>
          </div>
        </div>
      </div>
    </section>
  
    <section class="ftco-section bg-light about">
    	<div class="container">
        <div class="col-lg-12 mb-sm-4 text-center ftco-animate">
          <h2 class="g-color--gold h2">Over 200,000 content & catalogue owners <br> wildwide trust Opus.</h2>
          <p class="g-color--gold">You creat the copyrights, we're trusted to create value</p>
        </div>
    		<div class="row d-md-flex pt-5">
          <div class="col-md-6 d-flex align-items-center">
            <div>
              <h3 class="mb-4 g-color--gold h3">Who we are, and where we've come from & where we're going</h3>
              <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nesciunt voluptate, quibusdam sunt iste dolores consequatur</p>
              <div>
                <h3 class="mb-4 g-color--gold h3">Become an Opus Partner</h3>
                <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nesciunt voluptate, quibusdam sunt iste dolores consequatur</p>
              </div>
            </div>
          </div>
        
	    		<div class="col-md-6 ftco-animate p-md-5 p-2 about-g-bg-color--gold text-light" style="background-image: url('<?php echo base_url('assets/client/images/banners/bg-1.jpg'); ?>'">
            <div>
              <h3 class="mb-4 p-2 text-light h3">Opus Music Group</h3>
              <p class="p-2">Sub-publishing</p>
              <p class="p-2">Direct to Artists Deals</p>
              <p class="p-2">Black Rock Publishing</p>
              <p class="p-2">IQ Music Publishing</p>
              <p class="p-2">Big World Publishing</p>
              <p class="p-2">RightsApp - Publishing Platform</p>
              <p class="p-2">Sync Services</p>
            </div>
		      </div>
		    </div>
    	</div>
    </section>

    <section class="ftco-section testimony-section">
      <div class="container">
        <div class="row justify-content-center mb-5 pb-3">
          <div class="col-md-7 text-center heading-section heading-section-white ftco-animate">
           
            <h1 class="mb-4 h1-header g-color--gold">Opus Team</h1>
            <span class="subheading text-dark">BOARD & MANAGEMENT</span>
          </div>
        </div>
        <div class="row ftco-animate">
          <div class="col-md-12">
            <div class="carousel-testimony owl-carousel ftco-owl">
              <?php if (count($presentersResults) > 0) :
                foreach ($presentersResults as $teamData) : 
                  ?>
                <div class="slick-slide-item item">
                  <div class="team-1">
                      <div class="photo">
                          <a href="#">
                            <img src="<?php echo base_url('uploads/employees/' . $teamData['photo']); ?>" alt="team-1" class="img-fluid">
                          </a>
                          <div class="social-list clearfix">
                            <a href="<?=($teamData['facebook_link']); ?>" class="facebook-bg"><i class="icon-facebook"></i></a>
                            <a href="<?=($teamData['twitter_link']); ?>" class="twitter-bg"><i class="icon-twitter"></i></a>
                          </div>
                      </div>
                      <div class="details">
                          <h4><a href="team-detail.html"><?= ucwords(strtolower($teamData['emp_name'])); ?></a></h4>
                          <h5><?= ucwords(strtolower($teamData['emp_rname'])); ?></h5>
                      </div>
                  </div>
                </div>
                <?php endforeach; ?>
                <br>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
    </section>