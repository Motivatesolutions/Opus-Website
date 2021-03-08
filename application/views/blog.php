
    <section class="home-slider owl-carousel bg-dark">
      <div class="slider-item bread-item" style="background-image: url('<?php echo base_url('uploads/radio/banner/'.$this->systemdata->radiobgimg); ?>'" data-stellar-background-ratio="0.5">
        <!-- <div class="overlay"></div> -->
        <div class="container-fluid">
          <div class="row slider-text align-items-center justify-content-center" data-scrollax-parent="true">
            <div class="col-md-8 mt-2 text-center col-sm-12 ftco-animate" data-scrollax=" properties: { translateY: '70%' }">
              <h1 class="h1-header" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">Opus HighLights</h1>
            </div>
          </div>
        </div>
      </div>
    </section>
  
    <section class="ftco-section move-top-blog-1 bg-dark">
      <div class="container">
        <div class="row p-2">
          <?php if (count($blogResult) > 0) :
            foreach ($blogResult as $grow) : 
          ?>
            <div class="col-md-4 ftco-animate blog_img p-3">
              <div class="blog-entry">
                <a href="<?=base_url('blog/single_blog/'.$grow['blog_id'].'/'.url_title(strtolower($grow['blog_title']), 'dash', true));?>" class="block-20" style="background-image: url('<?=base_url('uploads/blogs/'.$grow['blog_file']); ?>');">
                </a>
                <div class="text d-flex py-4">
                  <div class="meta mb-3">
                    <div><a href="#"><?=($grow['created_at']);?></a></div>
                    <div><a href="#"><?=($grow['created_by']);?></a></div>
                    <!-- <div><a href="#" class="meta-chat"><span class="icon-chat"></span> 3</a></div> -->
                  </div>
                  <div class="desc pl-3">
                    <h3 class="heading"><a href="<?=base_url('blog/single_blog/'.$grow['blog_id'].'/'.url_title(strtolower($grow['blog_title']), 'dash', true));?>"><?=ucwords(strtolower($grow['blog_title']));?></a></h3>
                  </div>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
          <br>
          <?php endif; ?>
          <div class="down_bellot w-100 bg-light g-display-block--md g-display--xs">
            <div class="row d-flex down-bellot-row p-3">
              <div class="col-md-6 col-lg-6 d-flex pb-5">
                <div class="img-about img d-flex align-items-stretch">
                  <!-- <div class="overlay"></div> -->
                  <div class="img d-flex align-self-stretch align-items-center" style="background-image:url('<?php echo base_url('uploads/artists/banner/'.$this->systemdata->radiobgimg); ?>');">
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-lg-6 pl-lg-5">
                <div class="row justify-content-start">
                  <div class="col-md-12 heading-section ftco-animate">
                    <h2 class="mb-2" style="font-size: 34px; text-transform: capitalize;">New record <br> label in Town</h2>
                    <p>A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.</p>
                    <p>The copy warned the Little Blind Text, that where it came from it would have been rewritten a thousand times and everything that was left from its origin would be the word "and" and the Little Blind Text should turn around and return to its own, safe country. But nothing the copy said could convince her and so it didn’t take long until a few insidious Copy Writers ambushed her, made her drunk with Longe and Parole and dragged her into their agency, where they abused her for their.</p>
                  </div>
                </div>
              </div>
            </div>

          <div class="row d-flex down-bellot-row-2 p-3 pb-5">
            <div class="col-md-6 col-lg-6 pl-lg-5">
              <div class="row justify-content-start pb-3">
                <div class="col-md-12 heading-section ftco-animate">
                  <h2 class="mb-4" style="font-size: 34px; text-transform: capitalize;">New record <br> label in Town</h2>
                  <p>A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.</p>
                  <p>The copy warned the Little Blind Text, that where it came from it would have been rewritten a thousand times and everything that was left from its origin would be the word "and" and the Little Blind Text should turn around and return to its own, safe country. But nothing the copy said could convince her and so it didn’t take long until a few insidious Copy Writers ambushed her, made her drunk with Longe and Parole and dragged her into their agency, where they abused her for their.</p>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-lg-6 d-flex pb-5">
              <div class="img-about img d-flex align-items-stretch">
                <div class="img d-flex align-self-stretch align-items-center" style="background-image:url('<?php echo base_url('uploads/artists/banner/'.$this->systemdata->radiobgimg); ?>');">
                </div>
                <!-- <div class="overlay-2"></div> -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="ftco-section move-top-blog-1 my-0 bg-dark">
      <div class="container">
        <div class="row p-2">
          <?php if (count($blogResult) > 0) :
            foreach ($blogResult as $grow) : 
          ?>
            <div class="col-md-4 ftco-animate blog_img p-3 pt-md-0">
              <div class="blog-entry">
                <a href="<?=base_url('blog/single_blog/'.$grow['blog_id'].'/'.url_title(strtolower($grow['blog_title']), 'dash', true));?>" class="block-20" style="background-image: url('<?=base_url('uploads/blogs/'.$grow['blog_file']); ?>');">
                </a>
                <div class="text d-flex py-4">
                  <div class="meta mb-3">
                    <div><a href="#"><?=($grow['created_at']);?></a></div>
                    <div><a href="#"><?=($grow['created_by']);?></a></div>
                    <!-- <div><a href="#" class="meta-chat"><span class="icon-chat"></span> 3</a></div> -->
                  </div>
                  <div class="desc pl-3">
                    <h3 class="heading"><a href="<?=base_url('blog/single_blog/'.$grow['blog_id'].'/'.url_title(strtolower($grow['blog_title']), 'dash', true));?>"><?=ucwords(strtolower($grow['blog_title']));?></a></h3>
                  </div>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
          <br>
          <?php endif; ?>
          <div class="down_bellot w-100 bg-light g-display-block--md g-display--xs">
          <div class="row d-flex down-bellot-row p-3">
            <div class="col-md-6 col-lg-6 d-flex">
              <div class="img-about img d-flex align-items-stretch">
                <!-- <div class="overlay"></div> -->
                <div class="img d-flex align-self-stretch align-items-center" style="background-image:url('<?php echo base_url('uploads/artists/banner/'.$this->systemdata->radiobgimg); ?>');">
                </div>
              </div>
            </div>
            <div class="col-md-6 col-lg-6 pl-lg-5">
              <div class="row justify-content-start">
                <div class="col-md-12 heading-section ftco-animate">
                  <h2 class="mb-4" style="font-size: 34px; text-transform: capitalize;">New record <br> label in Town</h2>
                  <p>A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.</p>
                  <p>The copy warned the Little Blind Text, that where it came from it would have been rewritten a thousand times and everything that was left from its origin would be the word "and" and the Little Blind Text should turn around and return to its own, safe country. But nothing the copy said could convince her and so it didn’t take long until a few insidious Copy Writers ambushed her, made her drunk with Longe and Parole and dragged her into their agency, where they abused her for their.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>