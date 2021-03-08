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
	select[name="sex"],select[name="gender"],select[name="designation"],input[name="email"]{
		/*padding: 20px;*/
		height: 40px;
		border-radius: 0;
	}

</style>
<section id="main-content">
	<section class="wrapper"><br><br><br><br>
		<div class="row">
          	<div class="col-lg-12" >
	            <section class="panel">
		            <header class="panel-heading bg-info">
		                <h1 class="text-infos py-4 pl-3tea py-2">
		                	<?='Tracks for '.ucwords(strtolower($artist_name)); ?>
		                	<a href="<?=base_url('admin/genre/artist/'.$genre_id.'/'.url_title(strtolower($genre_name), 'dash', true));?>" class="pull-right btn btn-default btm-md">Go Back</a>
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
	               						<th>Photo</th>
	               						<th>Track Name</th>
	               						<th>Release Year</th>
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
	        <div class="modal-dialog">
	            <div class="modal-content">
	                <div class="modal-header">
	                    <button aria-hidden="true" data-dismiss="modal" class="close text-white" type="button">&times;</button>
	                    <h3 class="modal-title text-primary"></h3>
	                </div>
	                <div class="modal-body card-body bg-info">
	                    <form action="#" id="form">
	                    	<input type="hidden" name="trackid">
	                    	<input type="hidden" name="genre_id" value="<?=$genre_id?>">
	                    	<input type="hidden" name="artist_id" value="<?=$artist_id?>">
		                	<div class="row mt-3">
		                		<div class="col-md-12">
		                			<div class="row">
		                				<div class="col-md-6">
		                					<div class="form-group">
		                						<label class="control-label col-md-12">Track Name</label>
				                                <div class="col-md-12">
				                                    <input name="track_title" placeholder="track's name" class="form-control" type="text">
				                                    <span class="help-block text-danger"></span>
				                                </div>
		                					</div>
		                					<div class="form-group">
		                						<label class="control-label col-md-12">Release Year</label>
				                                <div class="col-md-12">
				                                  <input type="text" name="release_year" class="form-control" placeholder="Release Year">
				                                  <span class="help-block text-danger"></span>
				                                </div>
		                					</div>
	                    					<div class="form-group">
	                    						<label class="control-label col-md-12">Artist Name</label>
				                                <div class="col-md-12">
				                                	<select class="form-control" name="artist_id">
				                                		<option value="">Select Artist</option>
				                                		<?php foreach ($artistResults as $row) :?>
													      <option value="<?php echo $row->artist_id;?>">
													      	<?php echo $row->artist_name;?>
													      </option>
										      			<?php endforeach ?>
				                                    </select>
				                                    <span class="help-block text-danger"></span>
				                                </div>
	                    					</div>
											<div class="form-group">
	                    						<label class="control-label col-md-12">Genre</label>
				                                <div class="col-md-12">
				                                	<select class="form-control" name="genre_id">
				                                		<option value="">Select Genre</option>
				                                		<?php foreach ($genreResults as $row) :?>
													      <option value="<?php echo $row->genre_id;?>">
													      	<?php echo $row->genre_name;?>
													      </option>
										      			<?php endforeach ?>
				                                    </select>
				                                    <span class="help-block text-danger"></span>
				                                </div>
	                    					</div>
											<div class="form-group">
		                						<label class="control-label col-md-12">Track Audio</label>
				                                <div class="col-md-12">
				                                  <input type="file" name="track" class="form-control" placeholder="Track">
				                                  <span class="help-block text-danger"></span>
				                                </div>
		                					</div>
		                				</div>
		                				<div class="col-md-6">
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
	                    	<button type="button" id="btnSave" onclick="save_track()" class="btn btn-primary"></button>
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
		                				<div class="col-md-6">
		                					<div class="form-group">
		                						<label class="control-label col-md-12">Track Name</label>
				                                <div class="col-md-12">
				                                    <input name="v_track_title" readonly placeholder="track's name" class="form-control" type="text">
				                                    <span class="help-block text-danger"></span>
				                                </div>
		                					</div>
		                					<div class="form-group">
		                						<label class="control-label col-md-12">Release Year</label>
				                                <div class="col-md-12">
				                                  <input type="text" name="v_release_year" readonly class="form-control" placeholder="Release Year">
				                                  <span class="help-block text-danger"></span>
				                                </div>
		                					</div>
	                    					<div class="form-group">
	                    						<label class="control-label col-md-12">Artist Name</label>
				                                <div class="col-md-12">
				                                	<select class="form-control" name="v_artist_id" readonly>
				                                		<option value="">Select Artist</option>
				                                		<?php foreach ($roleResults as $row) :?>
													      <option value="<?php echo $row->artist_id;?>">
													      	<?php echo $row->artist_name;?>
													      </option>
										      			<?php endforeach ?>
				                                    </select>
				                                    <span class="help-block text-danger"></span>
				                                </div>
	                    					</div>
											<div class="form-group">
	                    						<label class="control-label col-md-12">Genre</label>
				                                <div class="col-md-12">
				                                	<select class="form-control" name="v_genre_id" readonly>
				                                		<option value="">Select Genre</option>
				                                		<?php foreach ($roleResults as $row) :?>
													      <option value="<?php echo $row->genre_id;?>">
													      	<?php echo $row->genre_name;?>
													      </option>
										      			<?php endforeach ?>
				                                    </select>
				                                    <span class="help-block text-danger"></span>
				                                </div>
	                    					</div>
		                				</div>
		                				<div class="col-md-6">
	                    					<div class="form-group">
	                    						<label class="control-label col-md-12">Added On</label>
				                                <div class="col-md-12">
				                                    <input  type="text" name="v_created_date" placeholder="added on" class="form-control" readonly >
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
		    	$('#sectionNav').addClass('active');
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
		                    titleAttr: 'Add New Staff',
		                    action: function () {
		                        add_track();
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
		                    filename:  "<?='track for '.ucwords(strtolower($artist_name)); ?>",
		                    extension: '.xlsx',
		                    exportOptions: {
		                        columns: [1,2,3]
		                    },
		                },
		                {
		                    extend: 'csv',
		                    className: 'btn btn-primary',
		                    titleAttr: 'Export CSV Data',
		                    text: '<i class="fa fa-bars"></i>',
		                    filename:  "<?='track for '.ucwords(strtolower($artist_name)); ?>",
		                    extension: '.csv',
		                    exportOptions: {
		                        columns: [1,2,3]
		                    },
		                },
		                {
		                    extend: 'print',
		                    title: "<h3 class='text-center'><?=$this->systemdata->sname; ?></h3><h4 class='text-center'> <?='track for '.ucwords(strtolower($artist_name)); ?></h4><h5 class='text-center'>Printed On <?php echo date('l, d F, Y'); ?></h5>",
		                    exportOptions: {
		                        columns: [1,2,3]
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
		                    filename:  "<?='track for '.ucwords(strtolower($artist_name)); ?>"
		                },
		            ],
		            responsive: true,
		            // Load data for the table's content from an Ajax source
		            "ajax": {
		                "url": "<?php echo base_url('admin/artist/track/generate_track/'.$artist_id);?>",
		                "type": "POST"
		            },

		            //Set column definition initialisation properties.
		            "columnDefs": [
		                {"targets": [0], "orderable": false},{"targets": [1], "orderable": false},
		                {"targets": [4], "orderable": false},
		            ],

		        });

		        //set input/textarea/select event when change value, remove program error and remove text help block 
		        $("input").change(function () {
		            $(this).parent().parent().removeClass('has-error');
		            $(this).next().empty();
		        });

		        $("select").change(function(){
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
	        function previewtrackProfileImage() {
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

		    function add_track(){
		        save_method = 'add';
		        $('#form')[0].reset(); // reset form on modals
		        $('.form-group').removeClass('has-error'); // clear error program
		        $('.help-block').empty(); // clear error string
		        $('#modal_form').modal('show'); // show bootstrap modal
		        $('.modal-title').text('Add New Track'); 
		        $('#btnSave').text('Add');
		    }

		    function update_track(id) {
		        save_method = 'update';
		        $('#form')[0].reset(); // reset form on modals
		        $('.form-group').removeClass('has-error'); // clear error program
		        $('.help-block').empty(); // clear error string
		        //Ajax Load data from ajax
		        $.ajax({
		             url: "<?php echo base_url('admin/artist/track/get_records_by_techer_id');?>/" + id,
		             type: "GET",
		             dataType: "JSON",
		             success: function (data){
		                $('[name="trackid"]').val(data.track_id);
		                $('[name="track_title"]').val(data.track_title);
		                $('[name="artist_id"]').val(data.artist_id);
		                $('[name="release_year"]').val(data.release_year);
		                $('[name="genre_id"]').val(data.genre_id);		
		                $('#modal_form').modal('show');
		                $('.modal-title').text("Update " +data.track_title+ " Records"); 
		                $('#btnSave').text('Update');
		                // show-profile photo
		                if (data.photo){
		                  $('#show_profile div').html('<img src="'+base_url+'uploads/tracks/'+data.photo+'" class="img-center" style="width:210px;height:210px">');
		                }else{
		                	$('#show_profile div').html('<img src="'+base_url+'/updoads/users/nophoto.jpg" class="img-center">');
		                }
		            },
		            error: function (jqXHR, textStatus, errorThrown)
		            {
		                swal("Error Occured!", "track Record couldnot be displayed Now!", "error");
		            }
		        });
		    }

		    function save_track(){
		        if (save_method == 'add') {
		            $('#btnSave').text('adding...');
		        }else{
		            $('#btnSave').text('updating...');
		        }
		       
		        $('#btnSave').attr('disabled', true); //set button disable 
		        var url;
		        if (save_method == 'add') {
		            url = "<?php echo base_url('admin/artist/track/add_new_track');?>";
		        } else {
		            url = "<?php echo base_url('admin/artist/track/update_track_records');?>";
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

		                if (data.status){
		                    $('#modal_form').modal('hide');
		                    //refresh all the table
		                    reload_table();
		                    if (save_method == 'add') {
		                        swal("track Added!", "New track has been added Successfully!", "success");
		                    } else {

		                        swal("track Updated!", "track Records Updated Successfully!", "success");
		                    }
		                }
		                else if(data === 'track_name_exists'){
		                    swal("Sorry, track Name Exist!", "New track Name already Taken!", "error");   
		                }
		                else if(data === 'contact_exists'){
		                	swal("Sorry, Number Exist!", "Phone nuber is already taken, Try another Please!", "error");
		                }
		                else if(data === 'email_exists'){
		                	swal("Sorry,Email Exist!", "This Email Address already Exist,Please try with another name!", "error");
		                }else if (data === "access_denied") {
		                    if (save_method == 'add') {
		                        swal("Access Denied!", "You're not Authorized to create any new track!", "error");
		                    } else {
		                        swal("Access Denied!", "You're not Authorized to update any track!", "error");
		                    }
		                } else
		                {
		                    for (var i = 0; i < data.inputerror.length; i++)
		                    {
		                        $('[name="' + data.inputerror[i] + '"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group faculty and add has-error faculty
		                        $('[name="' + data.inputerror[i] + '"]').next().text(data.error_string[i]); //select span help-block faculty set text error string
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
		                    swal("Error Occured!", "New track Records couldn't be Added!", "error");
		                    $('#btnSave').text('Add'); //change button text
		                    $('#btnSave').attr('disabled', false); //set button enable  
		                }else{
		                    swal("Error Occured!", "track Records couldn't be Update!", "error");
		                    $('#btnSave').text('Update'); //change button text
		                    $('#btnSave').attr('disabled', false); //set button enable  
		                }
		            }
		        });
		    }

		    function view_track(track_id) {
		    	//Ajax Load data from ajax
		        $.ajax({
		            url: "<?php echo base_url('admin/artist/track/get_records_by_techer_id') ?>/" + track_id,
		            type: "GET",
		            dataType: "JSON",
		            success: function (data){
		                $('[name="v_track_title"]').val(data.track_title);
		                $('[name="v_artist_id"]').val(data.artist_id);
		                $('[name="v_release_year"]').val(data.release_year);
		                $('[name="v_genre_id"]').val(data.genre_id);		
		                $('#view_modal_form').modal('show');
		                $('[name="v_created_date"]').val(data.created_date);
		                $('.modal-title').text("View " +data.track_title+ " Records");
		                // show-profile photo
		                if (data.photo){
		                  $('#show_profile div').html('<img src="'+base_url+'uploads/tracks/'+data.photo+'" class="img-center" style="width:210px;height:210px">');
		                }else{
		                	$('#show_profile div').html('<img src="'+base_url+'/updoads/users/nophoto.jpg" class="img-center">');
		                }
		            },
		            error: function (jqXHR, textStatus, errorThrown)
		            {
		                swal("Error Occured!", "track Records couldnot be viewed Now!", "error");
		            }
		        });
		    }

		    function delete_track(trackid,name){
		        swal({
		            title: "Are you sure?",
		            text: "Your will not be able to recover "+name+" Records!",
		            type: "warning",
		            showCancelButton: true,
		            confirmButtonClass: "btn-danger",
		            confirmButtonText: "Yes, delete!",
		            cancelButtonText: "No, cancel",
		            closeOnConfirm: false
		        },
		        function(){
		            $.ajax({
		                url: "<?php echo base_url('admin/artist/track/delete_track_record') ?>/" + trackid,
		                type: "POST",
		                dataType: "JSON",
		                success: function (data)
		                {
		                    if (data.status) {
		                        swal("track Deleted!",name+" Records deleted successfully!", "success");
		                        //if success reload ajax table
		                        reload_table();
		                    }else{
		                        swal("Access Denied!", "You're not Authorized to delete any Record!", "error");
		                    }
		                },
		                error: function (jqXHR, textStatus, errorThrown){
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
		                        data: {id: list_id},
		                        url: "<?php echo site_url('admin/artist/track/bulk_track_delete');?>",
		                        dataType: "JSON",
		                        success: function (data){
		                            if (data.status)
		                            {
		                                swal("track Deleted!", "Selected track Records deleted successfully!", "success");
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
		                    swal("Cancelled!", "Selected track Records are NOT deleted!", "error");
		                }
		            });
		        } else
		        {
		            swal("Sorry!", "Atleast select one record to complete this process!", "error");
		        }
		    }
		</script>
