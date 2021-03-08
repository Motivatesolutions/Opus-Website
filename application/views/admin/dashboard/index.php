
<style type="text/css">
	#login-img3-body img{
		background-attachment: fixed;
		background-repeat: no-repeat;
		background-position-x:center;
		background-position-y:center;
		background-size:auto;
		background-origin:padding-box;
		background-clip:border-box;
		background-color: transparent;
		height: 400px;
	}

	#main-content{
		padding-top:50px;
	}
	.breadcrumb {
	    -webkit-border-radius: 0px;
	    -moz-border-radius: 0px;
	    border-radius: 0px;
	    height: auto;
	    position: relative;
	    margin: 0 0 19px 0;
	    overflow: hidden;
	}
	.blue-bg {
	    color: #fff;
	    border-radius: 5px;
	    height: 200px;
	    background-color: #02374c;
	}
	.brown-bg {
	    color: #fff;
	    border-radius: 5px;
	    height: 200px;
	    background-color: #1265a7;
	}
	.green-bg {
	    color: #fff;
	    border-radius: 5px;
	    height: 200px;
	    background-color: #0879d4;
	}
	.login-form {
	    max-width: 650px;
	    margin: 10px auto 0;
	    border-radius: 5px;
		background: none;
		position: absolute;
		z-index:999;
		top:30%;
		left:30%;
	}
	.login-form a:hover {
	    color: #eff7f6 !important;
	}
	.btn-default2 {
	    color: #2b2b2b;
	    background-color: #ffffff;
	    border-color: #c7c7cc;
	    width: 200px;
	    padding: 10px;
	    border-radius: 20px;
	    margin-top: -25px;
	}
	.dropdown-menu.extended li a:hover {
	    background-color: #F7F8F9 !important;
	    color: #fff !important;
	    border-bottom: 1px solid #688a7e !important;
	}
	#img-fluid{
		width: 320px;
		height: 250px;
		border-radius: 10px;
	}
	#btn{
		background: none;
	    border: 1px solid #e6dfdfde;
	    margin-top: 10px;
	    color: #058c9a;
	    text-decoration: solid;
	}
	#p{
		font-size: 18px;
	}
	
	#myCarousel .social {
	position: absolute;
	top: -50px;
	left: 0;
	height:35px;
	transition: left ease-in-out 0.3s;
	text-align: center;
	}
	

	#myCarousel .social button {
	transition: color 0.6s;
	display: block;
	color: #000;
	margin-top: 10px;
	}

	#myCarousel .social button:hover {
	color: #98e633;
	}

	#myCarousel .social i {
	font-size: 18px;
	}
	#myCarousel:hover .social {
	top: 0;
	transition: top ease-in-out 0.6s;
	}
	.img-center{
		height: 100px; 
		width: 100px;
	}

</style>
<section id="main-content">
	<section class="wrapper">
		<div class="row breadcrumb">
          <div class="col-lg-4 col-md-3 col-sm-12 col-xs-12">
            <div class="info-box blue-bg">
            	<br><br><br>
              <i class="fa fa-cloud"></i>
              <div class="title">Today</div>
              <div class="count"><?=date('F d'); ?></div> 
            </div>
          </div>
          <div class="col-lg-4 col-md-3 col-sm-12 col-xs-12">
            <div class="info-box brown-bg">
            	<br><br><br>
              <i class="fa fa-clock-o"></i>
              <div class="title">Tomorrow</div>
              <div class="count"><?=date('F d', strtotime('tomorrow')); ?></div>
            </div>
          </div>
          <div class="col-lg-4 col-md-3 col-sm-12 col-xs-12">
			  <a href="<?=base_url('admin/employees'); ?>">
					<div class="info-box green-bg">
						<br><br><br>
					<i class="fa fa-users"></i>
					<div class="title">Team Members</div>
					<div class="count"><?=$employee_count ?></div>
					</div>
			  </a>
          </div>
		  <div class="col-lg-4 col-md-3 col-sm-12 col-xs-12">
			  <a href="<?=base_url('admin/blogs/blog'); ?>">
			  		<div class="info-box green-bg">
						<br><br><br>
						<i class="fa fa-cubes"></i>
						<div class="title">Posts</div>
						<div class="count"><?=$blog_count ?></div>
            		</div>
			  </a>
          </div>

		  <div class="col-lg-4 col-md-3 col-sm-12 col-xs-12">
			  <a href="<?=base_url('admin/subscribers/emails'); ?>">
					<div class="info-box green-bg">
						<br><br><br>
						<i class="fa fa-envelope"></i>
						<div class="title">Email Subscribers</div>
						<div class="count"><?=$subscriber_count ?></div>
					</div>
			  </a>
          </div>

		  <div class="col-lg-4 col-md-3 col-sm-12 col-xs-12">
			  	<a href="<?=base_url('admin/settings'); ?>">
					<div class="info-box green-bg">
						<br><br><br>
						<i class="fa fa-cogs"></i>
						<div class="title">Settings</div>
						<div class="count">3</div>
					</div>
				</a>
          </div>
        </div>
        <!--/.row-->
        <div class="row breadcrumb">
        	<div class="text-center title" style="font-size: 30px;">Our Best Artists</div>
        	<hr>
        	<?php if (count($ArtistResults) > 0) :
        		foreach ($ArtistResults as $grow) : 
        			$condition = array('artist_id' => $grow['artist_id']);
        			$gmembers = $this->artist->count_all_artist($condition);
        			
        			?>
	        		<div class="col-lg-4 col-md-3 col-sm-12 col-xs-12">
	        			<?php if ($this->userdata['role'] == 1 || $this->userdata['role'] == 5) : ?>
	        				<a>
				        		<img src="<?=base_url('uploads/artists/'.$grow['photo']); ?>" class="img-fluid" id="img-fluid">
				        		<p class="text-dark" style="padding-top: 10px;" id="p"><?=ucwords(strtolower($grow['artist_name']));?></p>
				        	</a>
				        		
			        	<?php endif;?>
		        	</div>
		        <?php endforeach; ?>
	        <?php endif; ?>
        </div>


		
        <script type="text/javascript">
        	var base_url = '<?php echo base_url(); ?>';
			$(document).ready(function (){
		    	$('#dashboardNav').addClass('active');

			});	
			function save_artist(){
				$('#btnJoin').text('joining...');
				$('#btnJoin').attr('disabled', true);
				var url;
				url = "<?php echo base_url('parent/modules/join_artist') ?>";
				// ajax adding data to database
				var formData = new FormData($('#form')[0]);
				$.ajax({
					url: url,
					type: "POST",
					data: formData,
					contentType: false,
					processData: false,
					dataType: "JSON",
					success: function (data)
					{
						if (data.status){
							swal("artist Join Successful!", "You has Joined the artist Successfully!", "success");
							setInterval(function() {
							window.location.reload();
							}, 3100);
						}
						$('#btnJoin').text('Join');
						$('#btnJoin').attr('disabled', false);
					},
					error: function (jqXHR, textStatus, errorThrown)
					{
						swal("Error Occured!", "You couldn't Join the artist at this moment. Try Again!", "error");
						$('#btnJoin').text('Join'); //change button text
						$('#btnJoin').attr('disabled', false);
					}
				});
			}
			
			function previewdisplayImage() {
				var oFReader = new FileReader();
				oFReader.readAsDataURL(document.getElementById("displayProfile").files[0]);
				oFReader.onload = function (oFREvent) {
				document.getElementById("viewdisplayProfile").src = oFREvent.target.result;
				};
			};

			//previewuserProfileImage
			function previewdisplayProfileImage() {
				var oFReader = new FileReader();
				oFReader.readAsDataURL(document.getElementById("displayProfile").files[0]);
				oFReader.onload = function (oFREvent) {
				document.getElementById("viewdisplayProfile").src = oFREvent.target.result;
				};
			};


			function update_display(){
				$('#update').text('updating...'); //change button text
				$('#update').attr('disabled', true); //set button disable 
				var url;
					url = "<?php echo base_url('admin/display/update_display') ?>";

				// var formData = new FormData($('#settings_form')[0]);
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
							swal("System Updated!", "System Settings Updated successfully!", "success");
							//window.location.reload();
							setInterval(function() {
							window.location.reload();
							}, 3100);
						}else if (data === "access_denied") {
							swal("Access Denied!","You're not Authorized to Update any System Settings!","error");
						} else
						{
							for (var i = 0; i < data.inputerror.length; i++)
							{
								$('[name="' + data.inputerror[i] + '"]').parent().parent().addClass('has-error'); //select parent twice to select div form-artist class and add has-error class
								$('[name="' + data.inputerror[i] + '"]').next().text(data.error_string[i]); //select span help-block class set text error string
							}
						}
						$('#update').text('Update'); //change button text
						$('#update').attr('disabled', false); //set button enable 
					},
					error: function (jqXHR, textStatus, errorThrown)
					{
						swal("Sorry!", "System Settings couldn't be Updated. Try again!", "error");
						$('#update').text('Update'); //change button text
						$('#update').attr('disabled', false); //set button enable 

					}
				});
			}
			function update_display(id) {
				save_method = 'update';
				$('#form')[0].reset(); // reset form on modals
				$('.form-group').removeClass('has-error'); // clear error display
				$('.help-block').empty(); // clear error string
				//Ajax Load data from ajax
				$.ajax({
					url: "<?php echo base_url('admin/dashboard/get_records_by_prog_id');?>" + id,
					type: "GET",
					dataType: "JSON",
					success: function (data){
						$('[name="displayid"]').val(data.id);
						$('[name="display"]').val(data.display);
						$('[name="message"]').val(data.message);
						$('#modal_form').modal('show'); 
						$('[name="created_date"]').val(data.created_date);
						$('.modal-title').text("Update " +data.display+ " Records"); 
						$('#btnSave').text('Update');
						// show-profile photo 
						if (data.photo){
						$('#show_profile div').html('<img src="'+base_url+'uploads/displays/'+data.photo+'" class="img-center" style="width:210px;height:200px">');
						}else{
							$('#show_profile div').html('<img src="'+base_url+'/updoads/users/nophoto.jpg" class="img-center">');
						}
					},
					error: function (jqXHR, textStatus, errorThrown){
						swal("Error Occured!", "Role Record couldnot be displayed Now!", "error");
					}
				});
			}
		</script>