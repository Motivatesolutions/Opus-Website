
    <section class="home-slider owl-carousel">
      <div class="slider-item bread-item" style="background-image: url('<?php echo base_url('assets/client/images/banners/banner-1.jpg'); ?>'" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container-fluid">
          <div class="row slider-text align-items-center justify-content-center" data-scrollax-parent="true">

            <div class="col-md-8 mt-5 text-center col-sm-12 ftco-animate" data-scrollax=" properties: { translateY: '70%' }">
	            <h1 class="mb-3 h1-header" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">The Opus Way.</h1>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="ftco-section service bg-light">
      <div class="container">
        <div class="row justify-content-center mb-5 pb-5">
          <div class="col-md-7 text-center heading-section ftco-animate">
            <h2 class="mb-4 g-color--red h2">So how would we work together</h2>
            <p>Whether you have a 1,000 workers or 1 million, Opus Music Group works with you to achieve the result your copyright deserve. </p>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4 mb-5 ftco-animate">
            <div class="block-10">
              
              <img src="<?php echo base_url('uploads/work/'.$work1->photo); ?>" alt="" class="img-fluid mb-3">
              <div class="person-info mb-2">
                <span class="text-danger">Step 1</span>
                <span class="name g-color--red"><?=($work1->title)?></span>
              </div>
              
              <p><?=($work1->description)?></p>
            </div>
          </div>
          <div class="col-md-4 mt-lg-3 pt-lg-5 mb-5 ftco-animate">
            <div class="block-10">
              
              <img src="<?php echo base_url('uploads/work/'.$work2->photo); ?>" alt="" class="img-fluid mb-3">
              <div class="person-info mb-2">
                <span class="text-danger">Step 2</span>
                <span class="name g-color--red"><?=($work2->title)?></span>
              </div>
              <p><?=($work2->description)?></p>
            </div>
          </div>
          <div class="col-md-4 mt-lg-5 pt-lg-5 mb-5 ftco-animate">
            <div class="block-10 pt-lg-5">
              
              <img src="<?php echo base_url('uploads/work/'.$work3->photo); ?>" alt="" class="img-fluid mb-3">
              <div class="person-info mb-2">
                <span class="text-danger">Step 3</span>
                <span class="name g-color--red"><?=($work3->title)?></span>
              </div>
              <p><?=($work3->description)?></p>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4 mb-5 ftco-animate">
            <div class="block-10">
              
              <img src="<?php echo base_url('uploads/work/'.$work4->photo); ?>" alt="" class="img-fluid mb-3">
              <div class="person-info mb-2">
                <span class="text-danger">Step 4</span>
                <span class="name g-color--red"><?=($work4->title)?></span>
              </div>
              <p><?=($work4->description)?></p>
            </div>
          </div>
          <div class="col-md-4 mt-lg-3 pt-lg-5 mb-5 ftco-animate">
            <div class="block-10">
              
              <img src="<?php echo base_url('uploads/work/'.$work5->photo); ?>" alt="" class="img-fluid mb-3">
              <div class="person-info mb-2">
                <span class="text-danger">Step 5</span>
                <span class="name g-color--red"><?=($work5->title)?></span>
              </div>
              <p><?=($work5->description)?></p>
            </div>
          </div>
          <div class="col-md-4 mt-lg-5 pt-lg-5 mb-5 ftco-animate">
            <div class="block-10 pt-lg-5">
              
              <img src="<?php echo base_url('uploads/work/'.$work6->photo); ?>" alt="" class="img-fluid mb-3">
              <div class="person-info mb-2">
                <span class="text-danger">Step 6</span>
                <span class="name g-color--red"><?=($work6->title)?></span>
              </div>
              <p><?=($work6->description)?></p>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="ftco-services-we-do pt-lg-5" style="background-image: url('<?php echo base_url('assets/client/images/banners/bg-1.jpg'); ?>'">
      <div class="container">
        <div class="col-lg-12">
          <div class="services-wrap p-4 p-md-5">
            <div class="row justify-content-center align-items-center">
              <div class="heading-section mb-5 ftco-animate">
                <h2 class="mb-2 text-light h2">Bespoke Services</h2>
              </div>
            </div>
      				<div class="d-md-flex">
      					<div class="one-half mr-3">
                  <div class="list-services d-flex ftco-animate bg-light p-2">
                    <div class="icon d-flex justify-content-center align-items-center">
                      <span class="flaticon-cloud-computing"></span>
                    </div>
                    <div class="text pl-2 pl-sm-0 pl-md-4">
                      <h3><?=($service->title)?></h3>
                      <p><?=($service->info)?></p>
                    </div>
                  </div>
		      				<div class="list-services d-flex ftco-animate bg-light p-2">
		      					<div class="icon d-flex justify-content-center align-items-center">
		      						<span class="flaticon-bandwidth"></span>
		      					</div>
		      					<div class="text pl-2 pl-sm-0 pl-md-4">
                      <h3><?=($service2->title)?></h3>
                      <p><?=($service2->info)?></p>
		      					</div>
		      				</div>
                  <div class="list-services d-flex ftco-animate bg-light p-2">
		      					<div class="icon d-flex justify-content-center align-items-center">
		      						<span class="flaticon-settings"></span>
		      					</div>
		      					<div class="text pl-2 pl-sm-0 pl-md-4">
                      <h3><?=($service3->title)?></h3>
                      <p><?=($service3->info)?></p>
		      					</div>
                  </div>
		      				
      					</div>

      					<div class="one-half">
      						
		      				<div class="list-services d-flex ftco-animate bg-light p-2">
		      					<div class="icon d-flex justify-content-center align-items-center">
		      						<span class="flaticon-settings"></span>
		      					</div>
		      					<div class="text pl-2 pl-sm-0 pl-md-4">
                      <h3><?=($service4->title)?></h3>
                      <p><?=($service4->info)?></p>
		      					</div>
		      				</div>
		      				<div class="list-services d-flex ftco-animate bg-light p-2">
		      					<div class="icon d-flex justify-content-center align-items-center">
		      						<span class="flaticon-support"></span>
		      					</div>
		      					<div class="text pl-2 pl-sm-0 pl-md-4">
                      <h3><?=($service5->title)?></h3>
                      <p><?=($service5->info)?></p>
		      					</div>
                            </div>
                            <div class="list-services d-flex ftco-animate bg-light p-2">
		      					<div class="icon d-flex justify-content-center align-items-center">
		      						<span class="flaticon-cloud-computing"></span>
		      					</div>
		      					<div class="text pl-2 pl-sm-0 pl-md-4">
                      <h3><?=($service6->title)?></h3>
                      <p><?=($service6->info)?></p>
		      					</div>
		      				</div>
                </div>
              </div> 
      			</div>
			</div>
		</div>
    </section>