
    <section class="home-slider owl-carousel">
      <div class="slider-item bread-item" style="background-image: url('<?php echo base_url('uploads/artists/banner/'.$this->systemdata->radiobgimg); ?>'" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container-fluid">
          <div class="row slider-text align-items-center justify-content-center" data-scrollax-parent="true">

            <div class="col-md-8 mt-5 text-center col-sm-12 ftco-animate" data-scrollax=" properties: { translateY: '70%' }">
              
              <h1 class="mb-3 bread" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">GET IN TOUCH</h1>
              <p class="breadcrumbs" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"><span class="mr-2"><a href="mailto:<?=($this->systemdata->semail); ?>"><i class="icon icon-envelope"></i><?=($this->systemdata->semail); ?></a></span> <span><a href="tel:<?=($this->systemdata->ug_contact); ?>"><i class="icon icon-phone"></i><?=($this->systemdata->ug_contact); ?></a></span></p>
            </div>
          </div>
        </div>
      </div>
    </section>
  
    <section class="ftco-section contact-section ftco-degree-bg">
      <div class="container p-5 pt-lg-2 pb-lg-2">
        <div class="row d-flex contact-info bg-dark">
          <div class="col-md-7 contact-img p-md-5" style="background-image: url('<?php echo base_url('assets/client/images/banners/pexels-budgeron-bach-5158825.jpg'); ?>'">
            <h2 class="d-block text-center p-5"><?=($this->systemdata->saddress); ?></h2>
          </div>
          <div class="col-md-5 p-5 text-light">
            <p><span class="icon icon-map-marker"></span> <?=($this->systemdata->ug_address); ?></p>
            <p><span class="icon icon-phone"></span> <a href="tel:<?=($this->systemdata->ug_contact); ?>" class="text-light"><?=($this->systemdata->ug_contact); ?></a></p>
            <p><span class="icon icon-envelope"></span> <a href="mailto:<?=($this->systemdata->semail); ?>" class="text-light"><?=($this->systemdata->semail); ?></a></p>
          </div>
        </div>
      </div>
    </div>
    <section class="ftco-section contact-section ftco-degree-bg">
      <div class="container">
        <div class="row form-row align-items-center justify-content-center ">
          <div class="col-md-12 p-md-5 text-center">
            <h2>GET IN TOUCH TODAY.</h2>
          </div>
          <div class="col-md-6 p-md-5 form-row">
            <form action="<?=base_url('message');?>" method="post" role="form">
              <div class="form-group">
                <input type="text" name="name" class="form-control" placeholder="Your Name">
              </div>
              <div class="form-group">
                <input type="text" name="email" class="form-control" placeholder="Your Email" required>
              </div>
              <div class="form-group">
                <input type="text" name="subject" class="form-control" placeholder="Subject">
              </div>
              <div class="form-group">
                <textarea name="message" id="" cols="30" rows="7" class="form-control" placeholder="Message" required></textarea>
              </div>
              <div class="form-check">
                <input type="checkbox" class="form-check-input" name="check" id=""><label class="form-check-label" for="checkbox">Do you agree to Sectric contacting you about this requist</label>
              </div>
              <div class="form-group">
                <input type="submit" value="SEND MESSAGE" class="btn g-bg-color--red text-light py-3 px-5">
              </div>
              <!-- display flash data message-->
              <?php if($this->session->flashdata('success')): ?>
                <div class="panel-body">
                    <span style="color: green;font-family:'Coda';font-size:16px;" class="text-center" id="ers">
                        <?php echo $this->session->flashdata('success'); ?>
                    </span>
                </div>
              <?php elseif($this->session->flashdata('error')): ?>
                <div class="panel-body">
                    <span style="color: red; font-family: 'Coda';">
                        <?php echo $this->session->flashdata('error'); ?>
                    </span>
                </div>
              <?php endif; ?>
            </form>
          </div>
        </div>
      </div>
    </section>