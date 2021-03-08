<style type="text/css">
	
	.modal-content,.modal-body{
        color: #000;
        width: 800px;
	}
	.img-center{
		/*background-color: #fff;*/
		height: 180px; 
		width: 180px;
	}
	.modal-header,.modal-footer{
		 width: 800px;
	}
	input[type="file"],input[type="text"],input[type="date"],select[name="department"],
	select[name="gender"],select[name="designation"],input[name="email"]{
		/*padding: 20px;*/
		height: 40px;
		border-radius: 0;
	}

</style>
<section id="main-content">
	<section class="wrapper">
		<br><br><br><br>
		<div class="row">
          	<div class="col-lg-12" >
	            <section class="panel">
		            <header class="panel-heading bg-info">
		               <h1 class="text-infos py-4 pl-3tea py-2"><?=ucwords(strtolower($genre_name)).' Artist Information';?>
		                	<a href="<?= base_url('admin/genre');?>" class="pull-right btn btn-default btm-md">Go Back</a>
		                </h1>   
		            </header>
	              	<div class="panel-body">
	               		<div class="table-responsive">
	               		   <table id="table" class="table table-striped table-bordered table-hover" 
	               		       width="100%">
	               				<thead>
	               					<tr>
	               						<th class="text-center"><input type="checkbox" id="check-all"></th>
                                        <th>S.No</th>
                                        <th>Artist Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Address</th>
	               						<th class="text-center">Actions</th>
	               					</tr>
	               				</thead>
	               				<tbody>
	               					
	               				</tbody>
	               			</table>
	               		</div>
	              	</div>
	            </section>
          	</div>
        </div>
  
		<!-- add and update popup modal -->
       <div id="modal_form" class="modal fade" role="dialog">
	        <div class="modal-dialog modal-lg">
	            <div class="modal-content">
	                <div class="modal-header">
	                    <button aria-hidden="true" data-dismiss="modal" class="close text-white" type="button">&times;</button>
	                    <h3 class="modal-title text-primary"></h3>
	                </div>
	                <div class="modal-body card-body bg-info">
	                    <form action="#" id="form">
	                    	<input type="hidden" name="artistid">
	                    	<input type="hidden" name="genre_id" value="<?=$genre_id;?>">
		                	<div class="row mt-3">
		                		<div class="col-md-12">
		                			<div class="row">
		                				<div class="col-md-4">
		                					<div class="form-group">
		                						<label class="control-label col-md-12">Artist Name</label>
				                                <div class="col-md-12">
				                                    <input name="artist_name" placeholder="Artist's name" class="form-control" type="text">
				                                    <span class="help-block text-danger"></span>
				                                </div>
		                					</div>
		                					<div class="form-group">
		                						<label class="control-label col-md-12">Emali Address</label>
				                                <div class="col-md-12">
				                                  <input type="email" name="email" class="form-control" placeholder="Email Address">
				                                  <span class="help-block text-danger"></span>
				                                </div>
		                					</div>
		                					<div class="form-group">
		                						<label class="control-label col-md-12">Gender</label>
				                                <div class="col-md-12">
				                                   <select class="form-control" name="gender">
				                                    	<option value="">select your Gender</option>
				                                    	<option value="Male">Male</option>
				                                    	<option value="Female">Female</option>
				                                    </select>
				                                    <span class="help-block text-danger"></span>
				                                </div>
		                					</div>
	                    					<div class="form-group">
	                    						<label class="control-label col-md-12">Biography</label>
				                                <div class="col-md-12">
				                                	<textarea class="form-control" name="biography" id="" placeholder="Artist Biography" cols="30" rows="5"></textarea>
				                                    <span class="help-block text-danger"></span>
				                                </div>
	                    					</div>
		                				</div>
		                				<div class="col-md-4">
											<div class="form-group">
	                    						<label class="control-label col-md-12">Designation</label>
				                                <div class="col-md-12">
				                                	<select class="form-control" name="designation">
				                                		<option value="">Select Role</option>
				                                		<?php foreach ($roleResults as $row) :?>
													      <option value="<?php echo $row->role_id;?>">
													      	<?php echo $row->name;?>
													      </option>
										      			<?php endforeach ?>
				                                    </select>
				                                    <span class="help-block text-danger"></span>
				                                </div>
	                    					</div>
	                    					<div class="form-group">
	                    						<label class="control-label col-md-12">Phone Number</label>
				                                <div class="col-md-12">
				                                  <input type="text" name="contact" class="form-control" placeholder="phone number">
				                                  <span class="help-block text-danger"></span>
				                                </div>
	                    					</div>
	                    					<div class="form-group">
	                    						<label class="control-label col-md-12">Date of Birth</label>
					                            <div class="col-md-12">
					                                <input name="dob" placeholder="Artist Birthday" class="form-control" type="date" required>
					                                <span class="help-block text-danger"></span>
					                            </div>
	                    					</div>
	                    					<div class="form-group">
	                    						<label class="control-label col-md-12">Nationality</label>
				                                <div class="col-md-12">
				                                  <input type="text" name="nationality" class="form-control" placeholder="Artist Nationality">
				                                  <span class="help-block text-danger"></span>
				                                </div>
	                    					</div>
	                    					<div class="form-group">
                    						  <label class="control-label col-md-12">Artist's Address</label>
				                                <div class="col-md-12">
				                                	<input type="text" name="address" class="form-control" placeholder="Artist Address">
				                                    <span class="help-block text-danger"></span>
				                                </div>
		                                    </div>
		                				</div>
		                				<div class="col-md-4">
	                    					<div class="form-group">
	                    						<label class="control-label col-md-12">Created Date</label>
				                                <div class="col-md-12">
				                                    <input  type="text" name="created_date" placeholder="Join Date" class="form-control" readonly value="<?php echo date('Y-m-d'); ?>">
				                                    <span class="help-block text-danger"></span>
				                                </div>
	                    					</div>
	                    					<!-- Users profile picture -->
				                    		<div class="form-group" id="show_profile">
				                               <label class="control-label col-md-12 pt-2">Profile Photo</label>
				                                <div class="col-md-12 mb-3">
		                                            <img src="<?=base_url('uploads/users/nophoto.jpg'); ?>" class="img-center" id="viewUserProfile">
				                                </div>
				                            </div>
				                    	    <div class="form-group">
				                                <label class="control-label col-md-12">Profile Picture</label>
				                                <div class="col-md-12">
				                                  <input  type="file" name="photo" onchange="previewImage();" class="form-control" accept=".jpg, .jpeg, .png" id="UserProfile">
				                                    <span class="help-block text-danger"></span>
				                                </div>
				                          </div>
            				   			</div>
	                			    </div>
	                			</div>
	                		</div>
	                    </form>
	                </div>
	                <div class="modal-footer card-footer">
	                    <div class="form-data mt-2 d-flex">
	                    	<button type="button" id="btnSave" onclick="save_artist()" class="btn btn-primary"></button>
	                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
        <!-- View model pop up -->
	      <div id="view_modal_form" class="modal fade" role="dialog">
	        <div class="modal-dialog modal-lg">
	            <div class="modal-content">
	                <div class="modal-header">
	                    <button aria-hidden="true" data-dismiss="modal" class="close text-white" type="button">&times;</button>
	                    <h3 class="modal-title text-primary"></h3>
	                </div>
	                <div class="modal-body card-body bg-info">
	                    <form action="#" id="form">
		                	<div class="row mt-3">
		                		<div class="col-md-12">
		                			<div class="row">
		                				<div class="col-md-4">
		                					<div class="form-group">
		                						<label class="control-label col-md-12">Artist Name</label>
				                                <div class="col-md-12">
				                                    <input name="v_name" readonly class="form-control" type="text">
				                                    <span class="help-block text-danger"></span>
				                                </div>
		                					</div>
		                					<div class="form-group">
		                						<label class="control-label col-md-12">Emali Address</label>
				                                <div class="col-md-12">
				                                  <input type="email" name="v_email" class="form-control" readonly>
				                                  <span class="help-block text-danger"></span>
				                                </div>
		                					</div>
		                					<div class="form-group">
		                						<label class="control-label col-md-12">Gender</label>
				                                <div class="col-md-12">
				                                    <input type="text" name="v_gender" class="form-control" readonly>
				                                    <span class="help-block text-danger"></span>
				                                </div>
		                					</div>
		                					<div class="form-group">
	                    						<label class="control-label col-md-12">Biography</label>
				                                <div class="col-md-12">
													<textarea name="v_biography" id="" cols="26" rows="7" readonly></textarea>
				                                    <span class="help-block text-danger"></span>
				                                </div>
	                    					</div>
	                    					
		                				</div>
		                				<div class="col-md-4">
											<div class="form-group">
	                    						<label class="control-label col-md-12">Designation</label>
				                                <div class="col-md-12">
													<select class="form-control" name="v_designation" readonly>
				                                		<option value="">Select Role</option>
				                                		<?php foreach ($roleResults as $row) :?>
													      <option value="<?php echo $row->role_id;?>">
													      	<?php echo $row->name;?>
													      </option>
										      			<?php endforeach ?>
				                                    </select>
				                                </div>
	                    					</div>
	                    					<div class="form-group">
	                    						<label class="control-label col-md-12">Phone Number</label>
				                                <div class="col-md-12">
				                                  <input type="text" name="v_contact" class="form-control" readonly>
				                                  <span class="help-block text-danger"></span>
				                                </div>
	                    					</div>
	                    					<div class="form-group">
	                    						<label class="control-label col-md-12">Date of Birth</label>
					                            <div class="col-md-12">
					                                <input name="v_dob" class="form-control" type="date" readonly>
					                                <span class="help-block text-danger"></span>
					                            </div>
	                    					</div>
	                    					<div class="form-group">
	                    						<label class="control-label col-md-12">Nationality</label>
				                                <div class="col-md-12">
				                                  <input type="text" name="v_nationality" class="form-control" readonly>
				                                  <span class="help-block text-danger"></span>
				                                </div>
	                    					</div>
	                    					<div class="form-group">
	                    					   <label class="control-label col-md-12">Department</label>
				                               <div class="col-md-12">
				                                  <input type="text" name="v_department" class="form-control" readonly>
				                                  <span class="help-block text-danger"></span>
				                               </div>
	                    					</div>
	                    					
		                				</div>
		                				<div class="col-md-4">
											<div class="form-group">
                    						  <label class="control-label col-md-12">Address</label>
				                                <div class="col-md-12">
				                                	<input type="text" name="v_address" class="form-control" readonly>
				                                    <span class="help-block text-danger"></span>
				                                </div>
		                                    </div>
	                    					<div class="form-group">
	                    						<label class="control-label col-md-12">Join Date</label>
				                                <div class="col-md-12">
				                                    <input  type="text" name="v_join_date" placeholder="Join Date" class="form-control" readonly value="<?php echo date('Y-m-d'); ?>">
				                                    <span class="help-block text-danger"></span>
				                                </div>
	                    					</div>
	                    					<!-- Users profile picture -->
				                    		<div class="form-group" id="show_profile">
				                               <label class="control-label col-md-12 pt-2">Profile Photo</label>
				                                <div class="col-md-12 mb-3">
		                                            <img src="<?=base_url('uploads/users/nophoto.jpg'); ?>" class="img-center" id="viewUserProfile">
				                                </div>
				                            </div>
            				   			</div>
	                			    </div>
	                			</div>
	                		</div>
	                    </form>
	                </div>
	                <div class="modal-footer card-footer">
	                    <div class="form-data mt-2 d-flex">
	                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
        <script type="text/javascript">
		    var save_method; //for save method string
		    var table;
		    var base_url = '<?php echo base_url(); ?>';
		    $(document).ready(function (){
		    	$('#genreNav').addClass('active');
		        $('#table').DataTable({
		            "processing": true,
		            "serverSide": true, 
		            "order": [], 
		            'lengthChange': true,
		            "pageLength" : 25,
		            "language": {
		                processing: "<img src='<?php echo base_url(); ?>assets/images/6.gif' height=30px width=30px>"
		            },
		            dom: 'lBfrtip',
		            buttons: [
		                {
		                    text: '<i class="fa fa-plus"></i> New',
		                    className: "btn btn-success",
		                    titleAttr: 'Add New artist',
		                    action: function () {
		                        add_artist();
		                    }
		                },
		                {
		                    text: '<i class="fa fa-trash"></i> Bulk Delete',
		                    className: "btn btn-danger",
		                    titleAttr: 'Bulk Delete',
		                    action: function () {
		                        bulk_delete();
		                    }
		                },
		                {
		                    text: '<i class="fa fa-refresh"></i>',
		                    className: "btn btn-primary",
		                    titleAttr: 'Reload Table Data',
		                    action: function () {
		                        reload_table()
		                    }
		                },
		                {
		                    extend: 'excel',
		                    className: 'btn btn-success',
		                    titleAttr: 'Export Excel Data',
		                    text: '<i class="fa fa-file-excel-o"></i>',
		                    filename: "<?=ucwords(strtolower($genre_name)).' Artist Information'; ?>",
		                    extension: '.xlsx',
		                    exportOptions: {
		                        columns: [1,2,3,4,53]
		                    },
		                },
		                {
		                    extend: 'csv',
		                    className: 'btn btn-primary',
		                    titleAttr: 'Export CSV Data',
		                    text: '<i class="fa fa-bars"></i>',
		                    filename: "<?=ucwords(strtolower($genre_name)).' Artist Information' ?>",
		                    extension: '.csv',
		                    exportOptions: {
		                        columns: [1,2,3,4,5]
		                    },
		                },
		                {
		                    extend: 'print',
		                    title: "<h3 class='text-center'><?=$this->systemdata->sname; ?></h3>"+
							" <h4 class='text-center'><?=ucwords(strtolower($genre_name)).' Artist Information';?></h4>"+
							" <h5 class='text-center'>Printed On <?php echo date('l, d F, Y'); ?></h5>",
		                    exportOptions: {
		                        columns: [1,2,3,4,5]
		                    },

		                    customize: function (win) {
		                        $(win.document.body)
		                        .css('font-size', '10pt')
		                        .prepend(
	                             '<img src="<?php echo base_url('uploads/logo/'.$this->systemdata->sphoto); ?>" style="position:absolute; top:0; left:0;width:100px;height:100px;" />'
	                            );
		                        $(win.document.body).find('table')
		                        .addClass('compact')
		                        .css('font-size', 'inherit');
		                    },

		                    className: 'btn btn-success',
		                    titleAttr: 'Print Table Data',
		                    text: '<i class="fa fa-print"></i>',
		                    filename: "<?=ucwords(strtolower($genre_name)).' Artist Information' ?>"
		                },
		            ],
		            responsive: true,
		            // Load data for the table's content from an Ajax source
		            "ajax": {
		                "url": "<?php echo base_url('admin/genre/generate_artist/'.$genre_id);?>",
		                "type": "POST"
		            },

		            //Set column definition initialisation properties.
		            "columnDefs": [
		                {"targets": [0], "orderable": false},{"targets": [1], "orderable": false},
		                {"targets": [6], "orderable": false},
		            ],

		        });

		        //set input/textarea/select event when change value, remove role error and remove text help block 
		        $("input").change(function () {
		            $(this).parent().parent().removeClass('has-error');
		            $(this).next().empty();
		        });

		        $("select").change(function () {
		            $(this).parent().parent().removeClass('has-error');
		            $(this).next().empty();
		        });

		        //check all
		        $("#check-all").click(function () {
		            $(".data-check").prop('checked', $(this).prop('checked'));
		        });

		    });

			function previewImage() {
	            var oFReader = new FileReader();
	            oFReader.readAsDataURL(document.getElementById("UserProfile").files[0]);
	            oFReader.onload = function (oFREvent) {
	            document.getElementById("viewUserProfile").src = oFREvent.target.result;
	            };
	        };

	        //previewuserProfileImage
	        function previewArtistProfileImage() {
	            var oFReader = new FileReader();
	            oFReader.readAsDataURL(document.getElementById("UserProfile").files[0]);
	            oFReader.onload = function (oFREvent) {
	            document.getElementById("viewUserProfile").src = oFREvent.target.result;
	            };
	        };

			function reload_table(){
		        $('#table').DataTable().ajax.reload();
		        /* This is to uncheck the column header check box */
		        $('input[type=checkbox]').each(function ()
		        {
		            this.checked = false;
		        });
		    }

		    function add_artist(){
		        save_method = 'add';
		        $('#form')[0].reset(); // reset form on modals
		        $('.form-group').removeClass('has-error'); // clear error rolerole
		        $('.help-block').empty(); // clear error string
		        $('#modal_form').modal('show'); // show bootstrap modal
		        $('.modal-title').text('Add New artist'); 
		        $('#btnSave').text('Add');
		    }

		    function save_artist(){
		        if (save_method == 'add') {
		            $('#btnSave').text('adding...');
		        }else{
		            $('#btnSave').text('updating...');
		        }
		       
		        $('#btnSave').attr('disabled', true); //set button disable 
		        var url;
		        if (save_method == 'add') {
		            url = "<?php echo base_url('admin/genre/add_new_artist')?>";
		        } else {
		            url = "<?php echo base_url('admin/genre/update_artist_records')?>";
		        }
		        // ajax adding data to database
		        var formData = new FormData($('#form')[0]);
		        $.ajax({
		            url: url,
		            type: "POST",
		            data: formData,
		            contentType: false,
		            processData: false,
		            dataType: "JSON",
		            success: function (data){
		                if (data.status) {
		                    $('#modal_form').modal('hide');
		                    //refresh all the tables
		                    reload_table();
		                    if (save_method == 'add') {
		                        swal("artist Added!", "New artist has been added Successfully!", "success");
		                    } else {
		                        swal("artist Updated!", "artist Records Updated Successfully!", "success");
		                    }
		                }else if(data === 'artist_name_exist'){

		                    swal("Sorry, artist Name Exist!", "artist Name already added!", "error");

		                }else if (data === "access_denied") {
		                    if (save_method == 'add'){
		                        swal("Access Denied!", "You're not Authorized to create any new artist!", "error");
		                    } else {
		                        swal("Access Denied!", "You're not Authorized to update any artist!", "error");
		                    }
		                } else{
		                    for (var i = 0; i < data.inputerror.length; i++){
		                        $('[name="' + data.inputerror[i] + '"]').parent().parent().addClass('has-error'); //select parent twice to select div form-grouprole and add has-error role
		                        $('[name="' + data.inputerror[i] + '"]').next().text(data.error_string[i]); //select span help-block roleset text error string
		                    }
		                }

		                if (save_method == 'add') {
		                    $('#btnSave').text('Add');
		                    $('#btnSave').attr('disabled', false); //set button enable 
		                }else{
		                    $('#btnSave').text('Update');
		                    $('#btnSave').attr('disabled', false); //set button enable 
		                }
		            },
		            error: function (jqXHR, textStatus, errorThrown)
		            {
		                if (save_method == 'add') {
		                    swal("Error Occured!", "New artist Records couldn't be Added!", "error");
		                    $('#btnSave').text('Add'); //change button text
		                    $('#btnSave').attr('disabled', false); //set button enable  
		                }else{
		                    swal("Error Occured!", "artist Records couldn't be Update!", "error");
		                    $('#btnSave').text('Update'); //change button text
		                    $('#btnSave').attr('disabled', false); //set button enable  
		                }
		            }
		        });
		    }

		    function update_artist(id) {
		        save_method = 'update';
		        $('#form')[0].reset(); // reset form on modals
		        $('.form-group').removeClass('has-error'); // clear error Website
		        $('.help-block').empty(); // clear error string
		        //Ajax Load data from ajax
		        $.ajax({
		             url: "<?php echo base_url('admin/genre/get_records_by_artist_id');?>/" +id,
		             type: "GET",
		             dataType: "JSON",
		             success: function (data){
		                $('[name="artistid"]').val(data.artist_id);
                        $('[name="artist_name"]').val(data.artist_name);
		                $('[name="address"]').val(data.address);
		                $('[name="email"]').val(data.email);
		                $('[name="contact"]').val(data.contact);
		                $('[name="nationality"]').val(data.nationality);
						$('[name="dob"]').val(data.dob);
		                $('[name="designation"]').val(data.designation);
		                $('[name="biography"]').val(data.biography);
		                $('[name="gender"]').val(data.gender);
		                $('#modal_form').modal('show'); 
		                $('.modal-title').text("Update " +data.artist_name+ " Records"); 
		                $('#btnSave').text('Update');
						// show-profile photo
		                if (data.photo){
		                  $('#show_profile div').html('<img src="'+base_url+'uploads/artists/'+data.photo+'" class="img-center" style="width:210px;height:210px">');
		                }else{
		                	$('#show_profile div').html('<img src="'+base_url+'/updoads/users/nophoto.jpg" class="img-center">');
		                }
		            },
		            error: function (jqXHR, textStatus, errorThrown)
		            {
		                swal("Error Occured!", "artist Record couldnot be displayed Now!", "error");
		            }
		        });
		    }

		    function view_artist(artist_id){
		    	//Ajax Load data from ajax
		        $.ajax({
		            url: "<?php echo base_url('admin/genre/get_records_by_artist_id') ?>/" + artist_id,
		            type: "GET",
		            dataType: "JSON",
		            success: function (data){
		            	$('[name="vartist_reg_no"]').val(data.reg_no);
						$('[name="v_name"]').val(data.artist_name);
		                $('[name="v_dob"]').val(data.dob);
		                $('[name="v_gender"]').val(data.gender);
		                $('[name="v_address"]').val(data.address);
		                $('[name="v_contact"]').val(data.contact)
		                $('[name="v_email"]').val(data.email);
		                $('[name="v_department"]').val(data.department);
		                $('[name="v_nationality"]').val(data.nationality);
		                $('[name="v_biography"]').val(data.biography);		
		                $('#view_modal_form').modal('show'); 
		                $('[name="v_designation"]').val(data.designation);
		                $('[name="v_created_date"]').val(data.created_date);
		                $('.modal-title').text("View " +data.artist_name+ " Records"); 
						// show-profile photo
		                if (data.photo){
		                  $('#show_profile div').html('<img src="'+base_url+'uploads/artists/'+data.photo+'" class="img-center" style="width:210px;height:210px">');
		                }else{
		                	$('#show_profile div').html('<img src="'+base_url+'/updoads/users/nophoto.jpg" class="img-center">');
		                }
		            },
		            error: function (jqXHR, textStatus, errorThrown)
		            {
		                swal("Error Occured!", "artist Records couldnot be viewed Now!", "error");
		            }
		        });
		    }


		    function delete_artist(artist_id,artist_name){
		        swal({
		            title: "Are you sure?",
		            text: "Your will not be able to recover "+artist_name+" Records!",
		            type: "warning",
		            showCancelButton: true,
		            confirmButtonClass: "btn-danger",
		            confirmButtonText: "Yes, delete!",
		            cancelButtonText: "No, cancel",
		            closeOnConfirm: false
		        },
		        function(){
		            $.ajax({
		                url: "<?php echo base_url('admin/genre/delete_artist_record');?>/" + artist_id,
		                type: "POST",
		                dataType: "JSON",
		                success: function (data){
		                    if (data.status) {
		                        swal("artist Deleted!", artist_name+" Records deleted successfully!", "success");
		                        //if success reload ajax table
		                        reload_table();
		                    }else{
		                        swal("Access Denied!", "You're not Authorized to delete any Record!", "error");
		                    }
		                },
		                error: function (jqXHR, textStatus, errorThrown)
		                {
		                    swal("Error Occured!", "Sorry, An error has Occured. Please Try Again!", "error");
		                }
		            });
		        });
		    }

		    function bulk_delete(){
		        var list_id = [];
		        $(".data-check:checked").each(function () {
		            list_id.push(this.value);
		        });
		        if (list_id.length > 0)
		        {
		            swal({
		                title: 'Are you sure, delete ' + list_id.length + ' record(s)?',
		                text: "You will not be able to recover selected record(s)!",
		                type: "warning",
		                showCancelButton: true,
		                confirmButtonClass: "btn-danger",
		                confirmButtonText: "Yes, delete",
		                cancelButtonText: "No, cancel",
		                closeOnConfirm: false,
		                closeOnCancel: false
		            },
		            function (isConfirm) {
		                if (isConfirm) {
		                    $.ajax({
		                        type: "POST",
		                        data: {artist_id: list_id},
		                        url: "<?php echo site_url('admin/genre/bulk_artist_delete');?>",
		                        dataType: "JSON",
		                        success: function (data)
		                        {
		                            if (data.status)
		                            {
		                                swal("artist Deleted!", "Selected artist Records deleted successfully!", "success");
		                                //if success reload ajax table
		                                reload_table();
		                            } else
		                            {
		                               swal("Access Denied!", "You're not Authorized to delete any Record!", "error");
		                            }
		                        },
		                        error: function (jqXHR, textStatus, errorThrown)
		                        {
		                            swal("Error Occured!", "Sorry, An error has Occured. Please Try Again!", "error");
		                        }
		                    });
		                } else {
		                    swal("Cancelled!", "Selected artist Records is safe!", "error");
		                }
		            });
		        } else
		        {
		            swal("Sorry!", "Atleast select one record to complete this process!", "error");
		        }
		    }
		</script>