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
	input[type="file"],input[type="text"],input[type="date"],
	select[name="event"]{
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
							Events Information
							
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
	               						<th>Event Name</th>
	               						<th>Description</th>
	               						<th>Date</th>
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
	                    	<input type="hidden" name="eventid">
		                	<div class="row mt-3">
		                		<div class="col-md-12">
		                			<div class="row">
		                				<div class="col-md-6">
		                					<div class="form-group">
		                						<label class="control-label col-md-12">Event Name </label>
				                                <div class="col-md-12">
                                                    <input  type="text" name="e_name" placeholder="Event name" class="form-control" >
				                                    <span class="help-block text-danger"></span>
				                                </div>
		                					</div>
                                            <div class="form-group">
                                                <label class="control-label col-md-12">Description</label>
                                                <div class="col-md-12">
                                                    <textarea name="description" id="description" cols="45" rows="11" placeholder="description......."></textarea>
                                                    <span class="help-block text-danger"></span>
                                                </div>
											</div>
											<div class="form-group">
		                						<label class="control-label col-md-12">Youtube Link </label>
				                                <div class="col-md-12">
                                                    <input  type="text" name="youtube" placeholder="youtube link" class="form-control" >
				                                    <span class="help-block text-danger"></span>
				                                </div>
		                					</div>
		                				</div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                    <label class="control-label col-md-12">Event Date</label>
                                                <div class="col-md-12">
                                                    <input  type="date" name="event_date" placeholder="created date" class="form-control" value="<?php echo date('Y-m-d'); ?>">
                                                    <span class="help-block text-danger"></span>
                                                </div>
                                            </div>
                                            <!-- Users profile picture -->
                                            <div class="form-group" id="show_profile">
                                                <label class="control-label col-md-12 pt-2">Event Photo</label>
                                                <div class="col-md-12 mb-3">
                                                    <img src="<?=base_url('uploads/users/nophoto.jpg'); ?>" class="img-center" id="vieweventProfile">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-12">Event Picture (800X600)</label>
                                                <div class="col-md-12">
                                                    <input  type="file" name="photo" onchange="previeweventImage();" class="form-control" accept=".jpg, .jpeg, .png" required id="eventProfile">
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
	                    	<button type="button" id="btnSave" onclick="save_event()" class="btn btn-primary"></button>
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
	                    	<input type="hidden" name="eventid">
		                	<div class="row mt-3">
		                		<div class="col-md-12">
		                			<div class="row">
		                				<div class="col-md-6">
		                					<div class="form-group">
		                						<label class="control-label col-md-12">Event Name</label>
				                                <div class="col-md-12">
				                                    <input name="view_e_name" class="form-control" type="text" readonly>
				                                    <span class="help-block text-danger"></span>
				                                </div>
		                					</div>
                                            <div class="form-group">
                                                <label class="control-label col-md-12">Description</label>
                                                <div class="col-md-12">
                                                    <textarea name="view_description" id="" class="form-control" cols="30" rows="5" readonly></textarea>
                                                    <span class="help-block text-danger"></span>
                                                </div>
											</div>
											<div class="form-group">
		                						<label class="control-label col-md-12">Youtube Link</label>
				                                <div class="col-md-12">
				                                    <input name="view_youtube" class="form-control" type="text" readonly>
				                                    <span class="help-block text-danger"></span>
				                                </div>
		                					</div>
		                				</div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label col-md-12">Event Date</label>
                                                <div class="col-md-12">
                                                    <input type="text" name="view_event_date" class="form-control" readonly>
                                                    <span class="help-block text-danger"></span>
                                                </div>
                                            </div>
                                            <!-- Users profile picture -->
                                            <div class="form-group" id="show_profile">
                                                <label class="control-label col-md-12 pt-2">Event Photo</label>
                                                <div class="col-md-12 mb-3">
                                                    <img src="<?=base_url('uploads/users/nophoto.jpg'); ?>" class="img-center" id="vieweventProfile">
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
		    	$('#eventsNav').addClass('active');
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
		                    titleAttr: 'Add New event',
		                    action: function () {
		                        add_event();
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
		                    filename: 'event Information',
		                    extension: '.xlsx',
		                    exportOptions: {
		                        columns: [1,2,3,4,5]
		                    },
		                },
		                {
		                    extend: 'csv',
		                    className: 'btn btn-primary',
		                    titleAttr: 'Export CSV Data',
		                    text: '<i class="fa fa-bars"></i>',
		                    filename: 'event Information',
		                    extension: '.csv',
		                    exportOptions: {
		                        columns: [1,2,3,4,5]
		                    },
		                },
		                {
		                    extend: 'print',
		                    title: "<h3 class='text-center'><?=$this->systemdata->sname; ?></h3><h4 class='text-center'>event Information</h4><h5 class='text-center'>Printed On <?php echo date('l, d F, Y'); ?></h5>",
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
		                    filename: 'event Information'
		                },
		            ],
		            responsive: true,
		            // Load data for the table's content from an Ajax source
		            "ajax": {
		                "url": "<?php echo base_url('admin/events/generate_event');?>",
		                "type": "POST"
		            },

		            //Set column definition initialisation properties.
		            "columnDefs": [
		                {"targets": [0], "orderable": false},{"targets": [1], "orderable": false},
		                {"targets": [6], "orderable": false},
		            ],

		        });

		        //set input/textarea/select event when change value, remove event error and remove text help block 
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
			
			function previeweventImage() {
	            var oFReader = new FileReader();
	            oFReader.readAsDataURL(document.getElementById("eventProfile").files[0]);
	            oFReader.onload = function (oFREvent) {
	            document.getElementById("vieweventProfile").src = oFREvent.target.result;
	            };
	        };

	        //previewuserProfileImage
	        function previeweventProfileImage() {
	            var oFReader = new FileReader();
	            oFReader.readAsDataURL(document.getElementById("eventProfile").files[0]);
	            oFReader.onload = function (oFREvent) {
	            document.getElementById("vieweventProfile").src = oFREvent.target.result;
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

		    function add_event(){
		        save_method = 'add';
		        $('#form')[0].reset(); // reset form on modals
		        $('.form-group').removeClass('has-error'); // clear error event
		        $('.help-block').empty(); // clear error string
		        $('#modal_form').modal('show'); // show bootstrap modal
		        $('.modal-title').text('Add New event'); 
		        $('#btnSave').text('Add');
		    }

		    function save_event(){
		        if (save_method == 'add') {
		            $('#btnSave').text('adding...');
		        }else{
		            $('#btnSave').text('updating...');
		        }
		       
		        $('#btnSave').attr('disabled', true); //set button disable 
		        var url;
		        if (save_method == 'add') {
		            url = "<?php echo base_url('admin/events/add_new_event');?>";
		        } else {
		            url = "<?php echo base_url('admin/events/update_event_records');?>";
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
		                        swal("event Added!", "New event added Successfully!", "success");
		                    } else {

		                        swal("event Updated!", "event Records Updated Successfully!", "success");
		                    }
		                }else if (data === 'event_exist'){
		                	swal("Sorry, event Exist!", "event already taken.  Try another name!", "error");
		                }else if (data === "access_denied"){
		                    if (save_method == 'add') {
		                        swal("Access Denied!", "You're not Authorized to create any new event!", "error");
		                    } else {
		                        swal("Access Denied!", "You're not Authorized to update any event!", "error");
		                    }
		                }else
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
		                    swal("Error Occured!", "New event Records couldn't be Added!", "error");
		                    $('#btnSave').text('Add'); //change button text
		                    $('#btnSave').attr('disabled', false); //set button enable  
		                }else{
		                    swal("Error Occured!", "Event Records couldn't be Update!", "error");
		                    $('#btnSave').text('Update'); //change button text
		                    $('#btnSave').attr('disabled', false); //set button enable  
		                }
		            }
		        });
		    }


		    function update_event(id) {
		        save_method = 'update';
		        $('#form')[0].reset(); // reset form on modals
		        $('.form-group').removeClass('has-error'); // clear error event
		        $('.help-block').empty(); // clear error string
		        //Ajax Load data from ajax
		        $.ajax({
		             url: "<?php echo base_url('admin/events/get_records_by_prog_id');?>/" + id,
		             type: "GET",
		             dataType: "JSON",
		             success: function (data){
		                $('[name="eventid"]').val(data.e_id);
		                $('[name="e_name"]').val(data.e_name);
						$('[name="youtube"]').val(data.youtube);
		                $('[name="description"]').val(data.description);
		                $('#modal_form').modal('show'); 
		                $('[name="event_date"]').val(data.event_date);
		                $('.modal-title').text("Update " +data.event+ " Records"); 
		                $('#btnSave').text('Update');
		                // show-profile photo 
		                if (data.photo){
		                  $('#show_profile div').html('<img src="'+base_url+'uploads/events/'+data.photo+'" class="img-center" style="width:210px;height:200px">');
		                }else{
		                	$('#show_profile div').html('<img src="'+base_url+'/updoads/users/nophoto.jpg" class="img-center">');
		                }
		            },
		            error: function (jqXHR, textStatus, errorThrown){
		                swal("Error Occured!", "Role Record couldnot be displayed Now!", "error");
		            }
		        });
		    }


		    function view_event(e_id) {
		    	//Ajax Load data from ajax
		        $.ajax({
		            url: "<?php echo base_url('admin/events/get_records_by_prog_id') ?>/" + e_id,
		            type: "GET",
		            dataType: "JSON",
		            success: function (data){
		                $('[name="view_e_name"]').val(data.e_name);
						$('[name="view_youtube"]').val(data.youtube);
		                $('[name="view_description"]').val(data.description);
		                $('#view_modal_form').modal('show'); 
		                $('[name="view_event_date"]').val(data.event_date);
		                $('.modal-title').text("View " +data.e_name+ " Records"); 
		                // show-profile photo
		                if (data.photo){
		                  $('#show_profile div').html('<img src="'+base_url+'uploads/events/'+data.photo+'" class="img-center" style="width:210px;height:200px">');
		                }else{
		                	$('#show_profile div').html('<img src="'+base_url+'/updoads/users/nophoto.jpg" class="img-center">');
		                }
		            },
		            error: function (jqXHR, textStatus, errorThrown)
		            {
		                swal("Error Occured!", "event Records couldnot be viewed Now!", "error");
		            }
		        });
		    }

		    function delete_event(e_id,e_name){
		        swal({
		            title: "Are you sure?",
		            text: "Your will not be able to recover "+e_name+" Records!",
		            type: "warning",
		            showCancelButton: true,
		            confirmButtonClass: "btn-danger",
		            confirmButtonText: "Yes, delete!",
		            cancelButtonText: "No, cancel",
		            closeOnConfirm: false
		        },
		        function(){
		            $.ajax({
		                url: "<?php echo base_url('admin/events/delete_event_record')?>/" + e_id,
		                type: "POST",
		                dataType: "JSON",
		                success: function (data)
		                {
		                    if (data.status) {
		                        swal("event Deleted!",event+" Records deleted successfully!", "success");
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
		                        data: {e_id: list_id},
		                        url: "<?php echo site_url('admin/events/bulk_event_delete');?>",
		                        dataType: "JSON",
		                        success: function (data){
		                            if (data.status)
		                            {
		                                swal("event  Deleted!", "Selected event Records deleted successfully!", "success");
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
		                    swal("Cancelled!", "Selected event Records are NOT deleted!", "error");
		                }
		            });
		        } else
		        {
		            swal("Sorry!", "Atleast select one record to complete this process!", "error");
		        }
		    }
		</script>
