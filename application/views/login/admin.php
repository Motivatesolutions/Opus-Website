<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $title ;?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=on">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/bootstrap/css/bootstrap.css" media="screen" title="no title" charset="utf-8">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/bootstrap/css/bootstrap-rest.css" media="screen" title="no title" charset="utf-8">
    <link rel="shortcut icon"  type=" image/png" href="<?=base_url('uploads/logo/'.$this->systemdata->sphoto); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/admin/bootstrap/css/mdb.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/bootstrap/css/style.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/bootstrap/font-awsome/css/font-awesome.css" media="screen" title="no title" charset="utf-8">
    <script src="<?php echo base_url(); ?>assets/admin/bootstrap/js/jquery-3.3.1.min.js" charset="utf-8"></script>
    <script src="<?php echo base_url(); ?>assets/admin/bootstrap/popper/popper.min.js" charset="utf-8"></script>
    <script src="<?php echo base_url(); ?>assets/admin/bootstrap/js/bootstrap.js" charset="utf-8"></script>
    <style>
        body{
            background-image: linear-gradient(rgba(0, 0, 0, 0.9), rgba(0, 0, 0, 0.5)), url('<?php echo base_url('uploads/logo/'.$this->systemdata->sbackgphoto); ?>');
        }
    </style>
</head>
<body>
    <section>
        <div class="row animated slideInUp ">
            <div class="col-lg-4 col-md-3 col-sm-2 "></div>
            <div class="col-lg-4 col-md-6 col-sm-8 ">
                <div class="box">
                    <form name="loginForm" id="login" class="form-border bg-white  mt-5" autocomplete="off">
                        <div class="row animated">
                            <div class="col-12">
<!--                                 <div class="pt-4 h4 text-capitalize text-dark text-center ">
                                    <?=strtoupper($this->systemdata->sapp_name); ?>
                                </div> -->
                            </div>
                        </div>
                        <div class="form-body px-3 pb-3 pt-2  ">
                            <div class="row justify-content-center pt-4 pb-4">
                                <center>
                                    <img src="<?php echo base_url('uploads/logo/'.$this->systemdata->sphoto); ?>" class="pb-2" alt="" style="width: auto;; height: 100px;">
                                    <div class="h3 text-success lead"><?=ucwords(strtolower($this->systemdata->sname)); ?></div>
                                    <div class="h4 text-dark lead">(<?=$login_name ?>)</div>
                                    <!-- login messages -->
                                    <span style="color: red;font-size:16px;" class="text-center" id="ers">
                                        <?php if(isset($error)){ foreach($error as $e){ echo $e; }} ?>
                                    </span>
                                    <!-- display flash data message-->
                                    <?php if($this->session->flashdata('success')): ?>
                                        <span style="color: red;font-size:16px;" class="text-center" id="ers">
                                            <?php echo $this->session->flashdata('error'); ?>
                                        </span>
                                    <?php elseif($this->session->flashdata('error')): ?>
                                        <span style="color: red;">
                                            <?php echo $this->session->flashdata('error'); ?>
                                        </span>
                                    <?php endif; ?>
                                    <!--// display flash data message-->
                                </center>
                            </div>
                            <div class="row">
                                <div class="form-group col-lg-12 pt-2 inputBox">
                                    <input type="email"  class="form-control" id="email" name="email" required>
                                    <label for="email" style="margin-left:40px;">Email</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-lg-12 pt-2 inputBox">
                                    <input type="password"  class="form-control" id="password" name="password" required="" >
                                    <label for="password" style="margin-left:40px;">Password</label>
                                </div>
                            </div>
                        <div>
                        <input type="checkbox" class="checkbox" name="remember" id="remember">
                        <label for="remember" class="remember-label">Remember me</label>
                        <div class="row loginbtn">
                            <div class="form-group col-lg-12 pt-1">
                                <input type="submit"  class="form-control btn-success" value="Login">
                                <center><span style="font-size: 14px;">Didn't work? Try | <a href="<?=base_url(); ?>">Back to Website</a></span></center>
                            </div>
                        </div>            
                    </form> 
                </div>               
            </div>
            <div class="col-lg-4 col-md-3 col-sm-2 "></div>
        </div>
    </section>
    <!-- Custom JS -->
    <script src="<?=base_url('assets/admin/bootstrap/js/jquery-3.3.1.min.js');?>"></script>
    <script src="<?=base_url('assets/admin/bootstrap/js/jquery.cookie.min.js');?>"></script>
    <script type="text/javascript" src="<?=base_url('assets/admin/login/admin.min.js');?>"></script>
    <!-- Innitialize base url -->
    <script type="text/javascript"> 
        var base_url = "<?=base_url(); ?>";
    </script>
</body>
</html>