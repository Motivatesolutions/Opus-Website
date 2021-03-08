
    <section class="home-slider owl-carousel">
      <div class="slider-item" style="background-image: url('<?=base_url('uploads/displays/'.$firstslide->photo); ?>'">
        <div class="overlay"></div>
      </div>

      <div class="slider-item" style="background-image: url('<?=base_url('uploads/displays/'.$nextslide->photo); ?>'">
        <div class="overlay"></div>
      </div>
    </section>
    
    <section class="ftco-short-note bg-overlay" >
    	<div class="container">
    		<div class="row d-flex">
    			<div class="col-lg-12 heading-white  mb-4 mb-sm-4 text-center ftco-animate">
    				<h2 class="g-color--red h2">We maximize value of contant owners <br> and creators.</h2>
    				<p>We enamble partners to seamlessly collect royaltics grobbaly. Our <br> network, 
            influstrature and technology maximise your income.</p>
            <p>You creat the copyrights, we're trusted to create value</p>
            <p class="pt-5"><a href="#" class="btn g-bg-color--gold pl-4 pr-4 px-xl-5 py-xl-3">LEARN MORE </a></p>
    			</div>
    		</div>
    	</div>
    </section>
  
    <section class="ftco-section services-section g-bg-color--gold text-center">
      <div class="container">
        <div class="row">
          <div class="col-md-4 align-self-stretch ftco-animate">
            <div class="media block-6  d-block">
              <div class="media-body p-2 mt-3">
                
                <p>By using sentric, we <br><b>increased rolayty revanue <br> for our clients by</b></p>
                <span><b>27%</b></span>
                <p><b>Ross Kennedy</b></p>
              </div>
            </div>      
          </div>
          <div class="col-md-4 align-self-stretch ftco-animate">
            <div class="media block-6 d-block ">
              <div class="media-body p-2 mt-3">
              <p>Working with the sentric <br> team <b>increased our net<br> profit by</b></p>
                <span><b>42%</b></span>
                <p><b>Lacey Riley</b></p>
              </div>
            </div>    
          </div>
          <div class="col-md-4 d-fle align-self-stretch ftco-animate">
            <div class="media block-6 d-block">
              <div class="media-body p-2 mt-3">
                <p>Simplified publishing <br> management <b>meant<br> overhead savings of</b></p>
                <span><b>33%</b></span>
                <p><b>Micheal Johnson</b></p>
              </div>
            </div>      
          </div>
        </div>
      </div>
    </section>

    <section class="ftco-services">
      <div class="s-promo-block-v2 js__parallax-window" style="background: url('<?php echo base_url('assets/client/images/banners/1.jpg'); ?>') 50% 0 no-repeat fixed; background-size: cover;">
          <div class="container">
              <div class="row g-hor-centered-row--md">
                  <div class="col-md-7 g-hor-centered-row__col g-padding-y-80--xs">
                    <span class="g-font-size-14--xs g-color--gold">SENTRIC CLIENT</span>
                    <h2 class="g-font-size-40--xs g-font-size-50--sm g-font-size-60--md g-color--white">ROCKSTAR</h2>
                    <p class="g-font-size-18--xs g-color--white-opacity g-margin-b-40--xs">We aim high at being focused on building relationships with our clients and community. Working together on the daily requires each individual to let the greater good of the team’s work surface above their own ego.</p>
                  </div>
                  <div class="col-md-5 g-hor-centered-row__col g-margin-b-80--xs mt-lg-5">
                      <img class="img-responsive pb-md-0" src="<?php echo base_url('assets/client/images/banners/hero-right.png'); ?>" alt="">
                  </div>
              </div>
          </div>
      </div>
    </section>
		
		<section class="ftco-services pt-lg-5 bg-light">
			<div class="container-wrap">
				<div class="row no-gutters pt-lg-5">
					<div class="col-lg-5 img services-img" style="background-image: url('<?php echo base_url('assets/client/images/banners/pexels-bryan-catota-3756766.jpg'); ?>');" data-stellar-background-ratio="0.5">
        		<a href="https://vimeo.com/45830194" class="icon popup-vimeo d-flex justify-content-center align-items-center">
	        		<span class="icon-play"></a>
	        	</a>
					</div>
					<div class="col-lg-7 bg-light">
						<div class="services-wrap p-3">
      				<div class="heading-section mb-5 ftco-animate">
		            <h2 class="mb-2 h2 text-dark">Why Opus Music?</h2>
              </div>
              <div class="d-md-flex">
      					<div class="one-half mr-4">
      						<div class="list-services d-flex ftco-animate">
		      					<div class="icon d-flex  order-md-last justify-content-center align-items-center">
		      						<span class="flaticon-cloud-computing"></span>
		      					</div>
		      					<div class="text pl-4 pl-sm-0 pr-md-4 text-md-right">
                      <h3><?=($service->title)?></h3>
                      <p><?=($service->info)?></p>
		      					</div>
		      				</div>
		      				<div class="list-services d-flex ftco-animate">
		      					<div class="icon d-flex order-md-last justify-content-center align-items-center">
		      						<span class="flaticon-bandwidth"></span>
		      					</div>
		      					<div class="text pl-4 pl-sm-0 pr-md-4 text-md-right">
                      <h3><?=($service2->title)?></h3>
                      <p><?=($service3->info)?></p>
		      					</div>
		      				</div>
		      				
      					</div>

      					<div class="one-half">
      						
		      				<div class="list-services d-flex ftco-animate">
		      					<div class="icon d-flex justify-content-center align-items-center">
		      						<span class="flaticon-settings"></span>
		      					</div>
		      					<div class="text pl-4 pl-sm-0 pl-md-4">
                      <h3><?=($service3->title)?></h3>
                      <p><?=($service3->info)?></p>
		      					</div>
		      				</div>
		      				<div class="list-services d-flex ftco-animate">
		      					<div class="icon d-flex justify-content-center align-items-center">
		      						<span class="flaticon-support"></span>
		      					</div>
		      					<div class="text pl-4 pl-sm-0 pl-md-4">
                      <h3><?=($service6->title)?></h3>
                      <p><?=($service6->info)?></p>
		      					</div>
		      				</div>
      					</div>
      				</div>
      			</div>
					</div>
				</div>
			</div>
		</section>

    <!-- latest syncs Section Begin -->
    <section class="ftco-section bg-light">
      <div class="container">
        <div class="row justify-content-center mb-5 pb-3">
          <div class="col-md-7 text-center heading-section ftco-animate">
            <h2>Take a look at our latest syncs....</h2>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <div class="latest-syncs set-bg">
              <a href=""><img src="<?php echo base_url('assets/client/images/clients/client-1.png'); ?>" alt=""></a>
            </div>
            <div class="latest-syncs set-bg">
              <img src="<?php echo base_url('assets/client/images/clients/client-2.png'); ?>" alt="">
            </div>
            <div class="latest-syncs set-bg">
              <img src="<?php echo base_url('assets/client/images/clients/client-3.png'); ?>" alt="">
            </div>
            <div class="latest-syncs set-bg">
              <img src="<?php echo base_url('assets/client/images/clients/client-4.png'); ?>" alt="">
            </div>
            <div class="latest-syncs set-bg">
              <img src="<?php echo base_url('assets/client/images/clients/client-5.png'); ?>" alt="">
            </div>
            <div class="latest-syncs set-bg">
              <img src="<?php echo base_url('assets/client/images/clients/client-1.png'); ?>" alt="">
            </div>
            <div class="latest-syncs set-bg">
              <img src="<?php echo base_url('assets/client/images/clients/client-1.png'); ?>" alt="">
            </div>
            <div class="latest-syncs set-bg">
              <img src="<?php echo base_url('assets/client/images/clients/client-1.png'); ?>" alt="">
            </div>
            <div class="latest-syncs set-bg">
              <img src="<?php echo base_url('assets/client/images/clients/client-1.png'); ?>" alt="">
            </div>
            <div class="latest-syncs set-bg">
              <img src="<?php echo base_url('assets/client/images/clients/client-1.png'); ?>" alt="">
            </div>
            <div class="latest-syncs set-bg">
              <img src="<?php echo base_url('assets/client/images/clients/client-1.png'); ?>" alt="">
            </div>
            <div class="latest-syncs set-bg">
              <img src="<?php echo base_url('assets/client/images/clients/client-1.png'); ?>" alt="">
            </div>
          </div>
          
        </div>
      </div>
    </section>
    