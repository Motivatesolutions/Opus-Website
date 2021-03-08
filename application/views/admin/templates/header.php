<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Opus Music">
  <meta name="author" content="motivate solusions">
  <meta name="keyword" content="opus music!">
  <title><?php echo $title ;?></title>
  <!-- Bootstrap CSS -->
  <link href="<?=base_url(); ?>assets/admin/css/bootstrap.min.css" rel="stylesheet">
  <!-- bootstrap theme -->
  <link href="<?=base_url(); ?>assets/admin/css/bootstrap-theme.css" rel="stylesheet">
  <!--external css-->
  <link rel="shortcut icon"  type=" image/png" href="<?=base_url('uploads/logo/'.$this->systemdata->sphoto); ?>">
  <!-- font icon -->
  <link href="<?=base_url(); ?>assets/admin/css/elegant-icons-style.css" rel="stylesheet" />
  <link href="<?=base_url(); ?>assets/admin/css/font-awesome.min.css" rel="stylesheet" />
  <!-- full calendar css-->
  <link href="<?=base_url(); ?>assets/admin/assets/fullcalendar/fullcalendar/bootstrap-fullcalendar.css" rel="stylesheet" />
  <link href="<?=base_url(); ?>assets/admin/assets/fullcalendar/fullcalendar/fullcalendar.css" rel="stylesheet" />
  <!-- easy pie chart-->
  <link href="<?=base_url(); ?>assets/admin/assets/jquery-easy-pie-chart/jquery.easy-pie-chart.css" rel="stylesheet" type="text/css" media="screen" />
  <!-- owl carousel -->
  <link rel="stylesheet" href="<?=base_url(); ?>assets/admin/css/owl.carousel.css" type="text/css">
  <link href="<?=base_url(); ?>assets/admin/css/jquery-jvectormap-1.2.2.css" rel="stylesheet">
  <!-- Custom styles -->
  <link rel="stylesheet" href="<?=base_url('assets/admin/css/fullcalendar.css'); ?>">
  <link href="<?=base_url(); ?>assets/admin/css/widgets.css" rel="stylesheet">
  <link href="<?=base_url(); ?>assets/admin/css/style-responsive.css" rel="stylesheet" />
  <link href="<?=base_url(); ?>assets/admin/css/xcharts.min.css" rel=" stylesheet">
  <link href="<?=base_url(); ?>assets/admin/css/jquery-ui-1.10.4.min.css" rel="stylesheet">
  <!-- Sweet Alert -->
  <link rel="stylesheet" type="text/css" href="<?=base_url('assets/admin/bootstrap/swal2/sweetalert.css'); ?>">
  <!-- Custom font-awesome -->
  <link href="<?=base_url(); ?>assets/admin/fonts/font-awesome.css " rel="stylesheet" />
  <!-- jquery -->
  <script src="<?php echo base_url(); ?>assets/admin/datatables/jquery-3.3.1.min.js"></script>
  <!-- javascript link for sidebar,scrolbar,toggle -->
  <script src="<?php echo base_url(); ?>assets/admin/js/scripts.js"></script>
  <!-- data table link start -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/datatables/buttons.dataTables.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/datatables/buttons.bootstrap4.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/datatables/jquery.dataTables.min.css" />
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/datatables/dataTables.bootstrap4.min.css" />
  <script src="<?php echo base_url('assets/admin/bootstrap/popper/popper.min.js'); ?>"></script>
  <link href="<?=base_url(); ?>assets/admin/css/style.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
  <style type="text/css">
    div.dt-buttons {  
      position: relative;
      float: right;
    }
    #table_filter{
      line-height: 26px;
      margin-right:15px;
      margin-top: -1.12em;
    }
    .wrapper{
      width: 100%;
      margin: 0 auto;
    }
    .page-header h2{
      margin-top: 0;
    }
    table tr td:last-child a{
      margin-right: 15px;
    }
    label {
      display: block;
      width: 50%;
    }
    #table_length{
      margin-top: -1.12em;
      margin: -12px;
    }
    #footer{
      margin-top: 14em;
      padding: 20px;
      color: #444;
      border-top: 1px solid #d2d6de;
    }
    .panel-heading h1{
      padding-top: 5px;
      font-size: 26px !important;
    }
    .caret{
      color: white !important;
    }
  </style>
  <script>
    function previewImage() {
      var oFReader = new FileReader();
      oFReader.readAsDataURL(document.getElementById("imglink").files[0]);
      oFReader.onload = function (oFREvent) {
        document.getElementById("uploadPreview").src = oFREvent.target.result;
      };
    };

    var baseURL = "<?=base_url(); ?>";
    var systemLogo = "<?=base_url('uploads/logo/'.$this->systemdata->sphoto); ?>";
    var systemName = "<?=$this->systemdata->sname; ?>";
    var currentDate = "<?=date('l, d F, Y'); ?>";
    
  </script>
</head>
<body>
  <!-- container section start -->
  <section id="container">
    <header class="header dark-bg">
      <!--logo start-->
      <a href="<?=base_url('admin/dashboard'); ?>" class="logo" style="color: #fff;">
        <?=$this->systemdata->sname; ?></span></a>
      <!--logo end-->
      <div class="toggle-nav " style="margin-left:30px;">
        <div class="icon-reorder tooltips" data-original-title="Toggle Navigation" data-placement="bottom"><i class="icon_menu"></i></div>
      </div>
      <div class="top-nav notification-row">
        <!-- notificatoin dropdown start-->
        <ul class="nav pull-right top-menu">
          <!-- user login dropdown start-->
          <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
              <span class="profile-ava">
                <?php if ($this->userdata['photo'] == '') : ?>
                  <img src="<?=base_url('uploads/users/nophoto.jpg');?>" style="width: 30px;height: 30px;">
                  <?php else : ?>
                    <img alt="" src="<?=base_url('uploads/users/'.$this->userdata['photo']);?>" style="width: 30px;height: 30px;">
                  <?php endif; ?>
                </span>
                <span class="username"><?=$this->userdata['name']; ?>
              </span>
                <b class="caret"></b>
            </a>
            
              <ul class="dropdown-menu extended logout">
                <div class="log-arrow-up"></div>
                <li class="eborder-top">
                  <!-- <a data-toggle="modal" data-target="editprofile"><i class="icon_profile"></i> My Profile</a> -->
                  <a href="javascript:void(0)" data-toggle="modal" data-target="#myModal"><i class="icon_profile"></i> My Profile</a>
                </li>
              <li>
                <a href="<?=base_url('logout'); ?>"><i class="icon_key_alt"></i> Log Out</a>
              </li>
            </ul>
          </li>
          <!-- user login dropdown end -->
          <li class="p-2"><a href="<?=base_url('admin/settings'); ?>"><span class="fa fa-cogs"></span></a></li>
        </ul>
        <!-- notificatoin dropdown end-->
      </div>
    </header>
    <!--header end-->
    <!--sidebar start-->
    <aside>
      <div id="sidebar" class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu" >
          <li class="sub-menu" id="logo">
            <center>
              <img class="img-center " src="<?=base_url('uploads/logo/'.$this->systemdata->sphoto); ?>" style="height:100px;width:100%;" />
            </center>
          </li>
          <!-- dashboard nav -->
          <li id="dashboardNav">
            <a class="" href="<?=base_url('admin/dashboard'); ?>">
              <i class="icon_house_alt"></i>
              <span>Dashboard</span>
            </a>
          </li>
          <?php if ($this->systemstatus == false) : ?>
            <!-- role nav -->
            <?php if ($this->userdata['role'] == 1 || $this->userdata['role'] == 5) : ?>
              <li id="roleNav">
                <a href="<?=base_url('admin/roles'); ?>">
                  <i class="fa fa-edit"></i>
                  <span>Roles</span>
                </a>
              </li>
              <li id="employeeNav" class="sub-menu">
                <a class="" href="<?=base_url('admin/employees');?>">
                  <i class="fa fa-users"></i>
                  <span>Team</span>
                </a>
              </li>
              <li id="eventsNav">
                <a href="<?=base_url('admin/events'); ?>">
                  <i class="fa fa-cubes"></i>
                  <span>Events</span>
                </a>
              </li>
              <li id="verseNav">
                <a href="<?=base_url('admin/service'); ?>">
                  <i class="fa fa-cog"></i>
                  <span>Services</span>
                </a>
              </li>
              <li id="podcastNav">
                <a href="<?=base_url('admin/blogs/blog'); ?>">
                  <i class="fa fa-folder"></i>
                  <span>Blog</span>
                </a>
              </li>
              <li id="tvNav">
                <a href="<?=base_url('admin/genre'); ?>">
                  <i class="fa fa-cube"></i>
                  <span>Genre</span>
                </a>
              </li>
              <!-- <li id="aboutNav">
                <a href="<?=base_url('admin/about'); ?>">
                  <i class="fa fa-globe"></i>
                  <span>About Us</span>
                </a>
              </li> -->
              
              <li id="emailNav">
                <a href="<?=base_url('admin/subscribers/emails'); ?>">
                  <i class="fa fa-envelope"></i>
                  <span>Email Subscribers</span>
                </a>
              </li>

              <li id="settingsNav">
                <a class="" href="<?=base_url('admin/settings'); ?>">
                  <i class="fa fa-cogs"></i>
                  <span>Settings</span>
                </a>
              </li>
            <?php endif; ?>          
            <!-- show this for customers only -->
            <?php if ($this->userdata['role'] == 5): ?>
              <!-- settings nav -->
              
              <li id="emailNav">
                <a href="<?=base_url('admin/users'); ?>">
                  <i class="fa fa-user"></i>
                  <span>Users</span>
                </a>
              </li>
            <?php endif; ?>
          </ul>
          <!-- sidebar menu end-->
         <?php endif; ?>
        </div>
      </aside>
      <!--sidebar end-->
      <!-- update profile modal -->
      <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button aria-hidden="true" data-dismiss="modal" class="close" type="button">&times;</button>
              <h4 class="modal-title text-primary">Profile Name : <?=$this->userdata['name']; ?></h4>
            </div>
            <div class="modal-body bg-info">
              <form role="form" id="update_image">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <center>
                        <label for="imglink" class="control-label col-md-12 h4">Update Profile Picture</label>
                        <?php if ($this->userdata['photo'] == '') : ?>
                          <img class="img-center img-thumbnail" id="uploadPreview" src="<?=base_url('uploads/users/nophoto.jpg');?>" style="width: 100px;height: 100px;">
                          <?php else : ?>
                            <img class="img-center img-thumbnail" id="uploadPreview" alt="" src="<?=base_url('uploads/users/'.$this->userdata['photo']);?>" style="width: 100px;height: 100px;">
                          <?php endif; ?>
                        </center>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 p-2">
                      <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" class="form-control" name="uname" placeholder="Name" value="<?=$this->userdata['name']; ?>" readonly>
                      </div>
                    </div>
                    <div class="col-md-6 p-2">
                      <div class="form-group">
                        <label for="">Role Name</label>
                        <select name="urole" class="form-control">
                          <option value="">Select Role</option>
                          <?php foreach ($uroles as $row) : ?>
                            <?php if ($this->userdata['role'] == 5) : ?>
                              <option value="<?php echo $row['role']; ?>" <?php if ($row['role'] == $this->userdata['role']) { echo "selected";} ?>><?=$row['name']; ?></option>
                                <?php else: 
                                if ($row['role'] == $this->userdata['role']): ?>
                                  <option value="<?php echo $row['role']; ?>" <?php if ($row['role'] == $this->userdata['role']) { echo "selected";} ?>><?=$row['name']; ?></option>
                                <?php endif; ?>
                            <?php endif; ?>
                          <?php endforeach; ?>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12 p-2">
                      <div class="form-group">
                        <?php if ($this->userdata['role'] == 1 || $this->userdata['role'] == 3 || $this->userdata['role'] == 5) : ?>
                          <label for="">Email Address</label>
                          <input type="text" name="uemail" class="form-control" placeholder="Login Email ID"
                          value="<?=$this->userdata['email']; ?>" readonly>
                        <?php elseif ($this->userdata['role'] == 2): ?>
                          <label for="">Employee ID</label>
                          <input type="text" name="uemployee_id" class="form-control" placeholder="Login Employee ID"
                          value="<?=$this->userdata['employee_id']; ?>" readonly>
                        <?php else : ?>
                          <label for="">Customer ID</label>
                          <input type="text" name="ucustomer_id" class="form-control" placeholder="Login Customer ID"
                          value="<?=$this->userdata['customer_id']; ?>" readonly>
                        <?php endif; ?>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12 p-2">
                      <div class="form-group">
                        <label for="">Browse Profile Photo</label>
                        <input type="file" name="imglink" id="imglink" accept=".jpg, .jpeg, .png" onchange="previewImage();" class="text-center m-2 form-control" value="">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12 p-2">
                      <div class="form-data">
                        <button type="button" class="btn btn-info btn-sm mt-3" id="update" onclick="update_profile()"><i class="icon_profile"></i> Update Profile</button>
                      </div>
                    </div>
                  </div>
                </form>
                <br>
                <form action="#" id="updatepass">
                  <div class="row mt-3">
                    <div class="col-md-6 p-2 mt-3">
                      <div class="form-group">
                        <label for="" class="mt-3">New Password</label>
                        <input type="password" id="password" name="password" class="form-control" placeholder="New Password">
                        <span class="help-block text-danger"></span>
                      </div>
                    </div>
                    <div class="col-md-6 p-2">
                      <div class="form-group">
                        <label for="" class="mt-3">Confirm Password</label>
                        <input type="password" id="confirm_password" name="confirm_password" class="form-control" placeholder="Confirm Password">
                        <span class="help-block text-danger"></span>
                      </div>
                    </div>
                  </div> 
                </div>
                <div class="modal-footer">
                  <div class="form-data mt-2 d-flex" align="right">
                    <button type="button" id="change" name="submit" class="btn btn-info" onclick="update_password()"><i class="fa fa-key"></i> Change Password</button>
                    <a href="#" class="btn btn-danger" data-dismiss="modal">Close</a>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>

        <script type="text/javascript">
          $(document).ready(function() {
            $("input").change(function () {
              $(this).parent().parent().removeClass('has-error');
              $(this).next().empty();
            });
            $("select").change(function () {
              $(this).parent().parent().removeClass('has-error');
              $(this).next().empty();
            });
          });

        // function to show system logo preview
        function previewImage() {
          var oFReader = new FileReader();
          oFReader.readAsDataURL(document.getElementById("imglink").files[0]);
          oFReader.onload = function (oFREvent) {
            document.getElementById("uploadPreview").src = oFREvent.target.result;
          };
        };

        function update_profile(){
            $('#update').text('updating...'); //change button text
            $('#update').attr('disabled', true); //set button disable 
            var url;
            url = "<?php echo base_url('admin/dashboard/update_profile') ?>";

            var formData = new FormData($('#update_image')[0]);
            $.ajax({
              url: url,
              type: "POST",
              data: formData,
              contentType: false,
              processData: false,
              dataType: "JSON",
              success: function (data)
              {
                    if (data.status) //if success close modal and reload ajax table
                    {
                      $('#myModal').modal('hide');
                      swal("Profile Updated!", "Your Profile has been Updated Successfully!", "success");
                          //window.location.reload();
                          setInterval(function() {
                            window.location.reload();
                          }, 3100);
                        } else
                        {
                          for (var i = 0; i < data.inputerror.length; i++)
                          {
                            $('[name="' + data.inputerror[i] + '"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                            $('[name="' + data.inputerror[i] + '"]').next().text(data.error_string[i]); //select span help-block class set text error string
                          }
                        }
                    $('#update').text('Update'); //change button text
                    $('#update').attr('disabled', false); //set button enable 
                  },
                  error: function (jqXHR, textStatus, errorThrown)
                  {
                    swal("Sorry!", "Your Profile couldn't be Updated. Try again!", "error");
                    $('#update').text('Update'); //change button text
                    $('#update').attr('disabled', false); //set button enable 

                  }
                });
          }

          function update_password(){
              $('#change').text('changing...'); //change button text
              $('#change').attr('disabled',true); //set button disable 
              var url;

              url = "<?php echo base_url('admin/dashboard/update_account_password')?>";
              // ajax adding data to database
              var formData = new FormData($('#updatepass')[0]);
              $.ajax({
                  url : url,
                  type: "POST",
                  data: formData,
                  contentType: false,
                  processData: false,
                  dataType: "JSON",
                  success: function(data)
                  {

                      if(data.status) //if success close modal and reload ajax table
                      {
                        $('#myModal').modal('hide');
                        swal("Password Updated!", "Your Password is changed successfully!", "success");
                        //Reset the input and textarea boxes after sending SMS
                        $('#updatepass')[0].reset();
                      }else if (data === "password_mismatch") {
                        swal("Password Missmatch","Confirm Password Missmatch. Please Try Again","error");
                        $('#password').val('');
                        $('#confirm_password').val('');
                      }else if (data === "password_short") {
                        swal("Password Length is Short!","Password Must be 8 character long!","error");
                        $('#password').val('');
                        $('#confirm_password').val('');
                      }
                      else
                      {
                          for (var i = 0; i < data.inputerror.length; i++) 
                          {
                              $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                              $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                          }
                      }
                      $('#change').text('Change Password'); //change button text
                      $('#change').attr('disabled',false); //set button enable 
                  },
                  error: function (jqXHR, textStatus, errorThrown)
                  {
                      swal("Error Occured!", "Sorry, error has Occured. Please Try again!", "error");
                      //Reset the input and textarea boxes after sending SMS
                      //$('#updatepass')[0].reset();
                      $('#change').text('Change Password'); //change button text
                      $('#change').attr('disabled',false); //set button enable 

                  }
              });
          }
        </script>