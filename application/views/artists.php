    <section class="ftco-services pt-lg-5 artists" style="background-image: url('<?php echo base_url('assets/client/images/banners/bg-1.jpg'); ?>'" >
        <div class="container-fluid">
            <div class="services-wrap p-4 p-md-5">
                <div class="row justify-content-center align-items-center">
                    <div class="heading-section mt-5 mb-5 text-center ftco-animate">
                        <h1 class="mb-2 text-light h1-header">Our Artists</h1>
                    </div>
                </div>
                <div class="row d-block-12 pt-5">
                    <?php if (count($artistResults) > 0) :
                    foreach ($artistResults as $artistData) : 
                    ?>
                    <div class="col-lg-6">
                        <div class="row team-2 mb-50">
                            <div class="col-xl-4 col-lg-5 col-md-4 col-sm-12 col-pad ">
                                <div class="photo">
                                    <img src="<?php echo base_url('uploads/artists/' . $artistData['photo']); ?>" alt="artist-image" class="img-fluid">
                                    <div class="social-list clearfix">
                                        <a href="#" class="facebook-bg"><i class="icon icon-facebook"></i></a>
                                        <a href="#" class="twitter-bg"><i class="icon icon-twitter"></i></a>
                                        <a href="#" class="google-bg"><i class="icon icon-youtube"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-8 col-lg-7 col-md-8 col-sm-12 col-pad align-self-center bg">
                                <div class="detail">
                                    <h4>
                                        <a href="<?=base_url('clients/singleartist/'.$artistData['artist_id'].'/'.url_title(strtolower($artistData['artist_name']), 'dash', true));?>"><?=($artistData['artist_name'])?></a>
                                    </h4>
                                    <h5>Bio</h5>
                                    <div class="contact">
                                        <p><?=($artistData['biography'])?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                    <br>
                    <?php endif; ?>
                </div>
            </div>
		</div>
    </section>