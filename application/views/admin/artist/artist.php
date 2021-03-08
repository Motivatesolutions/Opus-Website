<style type="text/css">
	
	.modal-content,.modal-body{
        color: #000;
        width: 800px;
	}
	.img-center{
		/*background-color: #fff;*/
		height: 150px; 
		width: 100%;
	}
	.modal-header,.modal-footer{
		 width: 800px;
	}
	input[type="file"],input[type="text"],input[type="date"],
	select[name="artist"]{
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
		                <h1 class="text-infos py-4 pl-3tea py-2">
							Artists Information
							<a class="btn btn-default btn-sm pull-right" href="<?=base_url('admin/genre'); ?>">Add Genre</a>
							<a class="btn btn-default btn-sm pull-right" href="<?=base_url('admin/album'); ?>">Add Album</a>
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
	               						<th>Artist Name</th>
                                        <th>Biography</th>
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
		                	<div class="row mt-3">
		                		<div class="col-md-12">
		                			<div class="row">
		                				<div class="col-md-4">
		                					<div class="form-group">
                                                <label class="control-label col-md-12">Artist Name</label>
                                                <div class="col-md-12">
                                                    <input  type="text" name="artist" placeholder="Enter artist" class="form-control">
                                                    <span class="help-block text-danger"></span>
                                                </div>
		                					</div>
                                            <div class="form-group">
                                                <label class="control-label col-md-12">Biography</label>
                                                <div class="col-md-12">
                                                    <textarea name="biography" id="biography" cols="26" rows="12" placeholder="Enter biography"></textarea>
                                                    <span class="help-block text-danger"></span>
                                                </div>
			                                </div>
                                        </div>
										<div class="col-md-4">
											<div class="form-group">
                                                <label class="control-label col-md-12">Songs</label>
                                                <div class="col-md-12">
                                                    <textarea name="songs" id="songs" cols="26" rows="12" placeholder="Enter songs"></textarea>
                                                    <span class="help-block text-danger"></span>
                                                </div>
			                                </div>
											<div class="form-group">
                                                <label class="control-label col-md-12">Created Date</label>
                                                <div class="col-md-12">
                                                    <input  type="text" name="created_date" placeholder="created date" class="form-control" readonly value="<?php echo date('Y-m-d'); ?>">
                                                    <span class="help-block text-danger"></span>
                                                </div>
                                            </div>
										</div>
                                        <div class="col-md-4">
                                            
                                            <!-- Users profile picture -->
                                            <div class="form-group" id="show_profile">
                                                <label class="control-label col-md-12">Artist Image View</label>
                                                <div class="col-md-12 mb-1">
                                                    <img src="<?=base_url('uploads/users/nophoto.jpg'); ?>" class="img-center" id="viewartistProfile">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-12">Artist Image</label>
                                                <div class="col-md-12">
                                                    <input  type="file" name="photo" onchange="previewartistImage();" class="form-control" required id="artistProfile">
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
       <!-- view pop up modal -->
       <div id="view_modal_form" class="modal fade" role="dialog">
	        <div class="modal-dialog modal-lg">
	            <div class="modal-content">
	                <div class="modal-header">
	                    <button aria-hidden="true" data-dismiss="modal" class="close text-white" type="button">&times;</button>
	                    <h3 class="modal-title text-primary"></h3>
	                </div>
	                <div class="modal-body card-body bg-info">
	                    <form action="#">
	                    	<input type="hidden" name="artistid">
		                	<div class="row mt-3">
		                		<div class="col-md-12">
		                			<div class="row">
		                				<div class="col-md-4">
		                					<div class="form-group">
		                						<label class="control-label col-md-12">Artist Name</label>
				                                <div class="col-md-12">
				                                    <input name="view_artist" class="form-control" type="text" readonly>
				                                    <span class="help-block text-danger"></span>
				                                </div>
		                					</div>
                                            <div class="form-group">
                                                <label class="control-label col-md-12">Biography</label>
                                                <div class="col-md-12">
                                                    <textarea name="view_biography" id="" class="form-control" cols="30" rows="9" readonly></textarea>
                                                    <span class="help-block text-danger"></span>
                                                </div>
                                            </div>
                                        </div>
										<div class="col-md-4">
											<div class="form-group">
                                                <label class="control-label col-md-12">Songs</label>
                                                <div class="col-md-12">
                                                    <textarea name="view_songs" id="" class="form-control" cols="30" rows="9" readonly></textarea>
                                                    <span class="help-block text-danger"></span>
                                                </div>
                                            </div>
										</div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label col-md-12">Created Date</label>
                                                <div class="col-md-12">
                                                    <input type="text" name="view_created_date" class="form-control" readonly>
                                                    <span class="help-block text-danger"></span>
                                                </div>
                                            </div>
                                            <!-- Users profile picture -->
                                            <div class="form-group" id="show_profile">
                                                <label class="control-label col-md-12 pt-2">Profile Photo</label>
                                                <div class="col-md-12 mb-3">
                                                    <img src="<?=base_url('uploads/users/nophoto.jpg'); ?>" class="img-center" id="viewartistProfile">
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
		    	$('#rpNav').addClass('active');
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
		                    filename: 'artist Information',
		                    extension: '.xlsx',
		                    exportOptions: {
		                        columns: [1,2,3,4]
		                    },
		                },
		                {
		                    extend: 'csv',
		                    className: 'btn btn-primary',
		                    titleAttr: 'Export CSV Data',
		                    text: '<i class="fa fa-bars"></i>',
		                    filename: 'artist Information',
		                    extension: '.csv',
		                    exportOptions: {
		                        columns: [1,2,3,4]
		                    },
		                },
		                {
		                    extend: 'print',
		                    title: "<h3 class='text-center'><?=$this->systemdata->sname; ?></h3><h4 class='text-center'>artist Information</h4><h5 class='text-center'>Printed On <?php echo date('l, d F, Y'); ?></h5>",
		                    exportOptions: {
		                        columns: [1,2,3,4]
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
		                    filename: 'artist Information'
		                },
		            ],
		            responsive: true,
		            // Load data for the table's content from an Ajax source
		            "ajax": {
		                "url": "<?php echo base_url('admin/artist/artists/generate_artist');?>",
		                "type": "POST"
		            },

		            //Set column definition initialisation properties.
		            "columnDefs": [
		                {"targets": [0], "orderable": false},{"targets": [1], "orderable": false},
		                {"targets": [5], "orderable": false},
		            ],

		        });

		        //set input/textarea/select event when change value, remove artist error and remove text help block 
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
			
			function previewartistImage() {
	            var oFReader = new FileReader();
	            oFReader.readAsDataURL(document.getElementById("artistProfile").files[0]);
	            oFReader.onload = function (oFREvent) {
	            document.getElementById("viewartistProfile").src = oFREvent.target.result;
	            };
	        };

	        //previewuserProfileImage
	        function previewartistProfileImage() {
	            var oFReader = new FileReader();
	            oFReader.readAsDataURL(document.getElementById("artistProfile").files[0]);
	            oFReader.onload = function (oFREvent) {
	            document.getElementById("viewartistProfile").src = oFREvent.target.result;
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
		        $('.form-group').removeClass('has-error'); // clear error artist
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
		            url = "<?php echo base_url('admin/artist/artists/add_new_artist');?>";
		        } else {
		            url = "<?php echo base_url('admin/artist/artists/update_artist_records');?>";
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
		            success: function (data)
		            {

		                if (data.status)
		                {
		                    $('#modal_form').modal('hide');
		                    //refresh all the table
		                    reload_table();
		                    if (save_method == 'add') {
		                        swal("artist Added!", "New artist added Successfully!", "success");
		                    } else {

		                        swal("artist Updated!", "artist Records Updated Successfully!", "success");
		                    }
		                }else if (data === 'artist_exist'){
		                	swal("Sorry, artist Exist!", "artist already taken.  Try another name!", "error");
		                }else if (data === "access_denied"){
		                    if (save_method == 'add') {
		                        swal("Access Denied!", "You're not Authorized to create any new artist!", "error");
		                    } else {
		                        swal("Access Denied!", "You're not Authorized to update any artist!", "error");
		                    }
		                }else if (data === "not_sent") {
		                	swal("Message Not Sent","Login Credential was not sent to artist may be due to Internet!","error");
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
		        $('.form-group').removeClass('has-error'); // clear error artist
		        $('.help-block').empty(); // clear error string
		        //Ajax Load data from ajax
		        $.ajax({
		             url: "<?php echo base_url('admin/artist/artists/get_records_by_artist_id');?>/" + id,
		             type: "GET",
		             dataType: "JSON",
		             success: function (data){
		                $('[name="artistid"]').val(data.artist_id);
		                $('[name="artist"]').val(data.artist);
		                $('[name="biography"]').val(data.biography);
						$('[name="songs"]').val(data.songs);
		                $('#modal_form').modal('show'); 
		                $('[name="created_date"]').val(data.created_date);
		                $('.modal-title').text("Update " +data.artist+ " Records"); 
		                $('#btnSave').text('Update');
		                // show-profile photo 
		                if (data.photo){
		                  $('#show_profile div').html('<img src="'+base_url+'uploads/artist/artists/'+data.photo+'" class="img-center" style="width:210px;height:200px">');
		                }else{
		                	$('#show_profile div').html('<img src="'+base_url+'/updoads/users/nophoto.jpg" class="img-center">');
		                }
		            },
		            error: function (jqXHR, textStatus, errorThrown){
		                swal("Error Occured!", "Role Record couldnot be displayed Now!", "error");
		            }
		        });
		    }


		    function view_artist(artist_id) {
		    	//Ajax Load data from ajax
		        $.ajax({
		            url: "<?php echo base_url('admin/artist/artists/get_records_by_artist_id') ?>/" + artist_id,
		            type: "GET",
		            dataType: "JSON",
		            success: function (data){
		                $('[name="view_artist"]').val(data.artist);
		                $('[name="view_biography"]').val(data.biography);
		                $('[name="view_songs"]').val(data.songs);
		                $('#view_modal_form').modal('show'); 
		                $('[name="view_created_date"]').val(data.created_date);
		                $('.modal-title').text("View " +data.artist+ " Records"); 
		                // show-artist photo
		                if (data.photo){
		                  $('#show_profile div').html('<img src="'+base_url+'uploads/artist/artists/'+data.photo+'" class="img-center" style="width:210px;height:200px">');
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

		    function delete_artist(artist_id,artist){
		        swal({
		            title: "Are you sure?",
		            text: "Your will not be able to recover "+artist+" Records!",
		            type: "warning",
		            showCancelButton: true,
		            confirmButtonClass: "btn-danger",
		            confirmButtonText: "Yes, delete!",
		            cancelButtonText: "No, cancel",
		            closeOnConfirm: false
		        },
		        function(){
		            $.ajax({
		                url: "<?php echo base_url('admin/artist/artists/delete_artist_record')?>/" + artist_id,
		                type: "POST",
		                dataType: "JSON",
		                success: function (data)
		                {
		                    if (data.status) {
		                        swal("artist Deleted!",artist+" Records deleted successfully!", "success");
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
		                        data: {artist_id: list_id},
		                        url: "<?php echo site_url('admin/artist/artists/bulk_artist_delete');?>",
		                        dataType: "JSON",
		                        success: function (data){
		                            if (data.status)
		                            {
		                                swal("artist  Deleted!", "Selected artist Records deleted successfully!", "success");
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
		                    swal("Cancelled!", "Selected artist Records are NOT deleted!", "error");
		                }
		            });
		        } else
		        {
		            swal("Sorry!", "Atleast select one record to complete this process!", "error");
		        }
		    }
		</script>
