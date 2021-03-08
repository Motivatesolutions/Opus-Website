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
	select[name="about"]{
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
		                	About Us Information
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
	               						<th>About</th>
	               						<th>Mission</th>
	               						<th>Vision</th>
										<th>What we Do</th>
										<th>More about PDN</th>
										<th>existence</th>
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
	            <div class="modal-content" style="font-family: 'Coda';">
	                <div class="modal-header">
	                    <button aria-hidden="true" data-dismiss="modal" class="close text-white" type="button">&times;</button>
	                    <h3 class="modal-title text-primary"></h3>
	                </div>
	                <div class="modal-body card-body bg-info">
	                    <form action="#" id="form">
	                    	<input type="hidden" name="aboutid">
		                	<div class="row mt-3">
		                		<div class="col-md-12">
		                			<div class="row">
		                				<div class="col-md-12">
		                					<div class="form-group">
		                						<label class="control-label col-md-12">About</label>
				                                <div class="col-md-12">
												<textarea name="about" id="about" cols="45" class="form-control" placeholder="about......"></textarea>
				                                    <span class="help-block text-danger"></span>
				                                </div>
		                					</div>
                                            <div class="form-group">
                                                <label class="control-label col-md-12">Mission</label>
                                                <div class="col-md-12">
                                                    <textarea name="mission" id="mission" cols="45" class="form-control" placeholder="mission......."></textarea>
                                                    <span class="help-block text-danger"></span>
                                                </div>
											</div>
											<div class="form-group">
		                						<label class="control-label col-md-12">Vision</label>
				                                <div class="col-md-12">
												<textarea name="vision" id="vision" cols="45" class="form-control" placeholder="vision......"></textarea>
				                                    <span class="help-block text-danger"></span>
				                                </div>
		                					</div>
											<div class="form-group">
		                						<label class="control-label col-md-12">Services</label>
				                                <div class="col-md-12">
												<textarea name="services" id="services" cols="45" class="form-control" placeholder="services......"></textarea>
				                                    <span class="help-block text-danger"></span>
				                                </div>
		                					</div>
                                            <div class="form-group">
                                                <label class="control-label col-md-12">More about PDN</label>
                                                <div class="col-md-12">
                                                    <textarea name="more" id="more" cols="45" placeholder="more......." class="form-control"></textarea>
                                                    <span class="help-block text-danger"></span>
                                                </div>
											</div>
											<div class="form-group">
                                                <label class="control-label col-md-12">PDN existence</label>
                                                <div class="col-md-12">
                                                    <textarea name="existence" id="existence" cols="45" placeholder="existence in years ......" class="form-control"></textarea>
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
											<!-- About Image -->
											<div class="form-group" id="show_Image">
												<label class="control-label col-md-12 pt-2">About Image </label>
												<div class="col-md-6 mb-3">
													<img src="<?=base_url('uploads/users/nophoto.jpg'); ?>" class="img-center" id="viewAboutImage">
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-12">About Image (1000x1053)</label>
												<div class="col-md-6">
													<input  type="file" name="aboutimage" onchange="previewAboutImage();" class="form-control" accept=".jpg, .jpeg, .png" required id="aboutImage">
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
	                    	<button type="button" id="btnSave" onclick="save_about()" class="btn btn-primary"></button>
	                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
       <!-- view pop up modal -->
       <div id="view_modal_form" class="modal fade" role="dialog">
	        <div class="modal-dialog modal-lg">
	            <div class="modal-content" style="font-family: 'Coda';">
	                <div class="modal-header">
	                    <button aria-hidden="true" data-dismiss="modal" class="close text-white" type="button">&times;</button>
	                    <h3 class="modal-title text-primary"></h3>
	                </div>
	                <div class="modal-body card-body bg-info">
	                    <form action="#">
	                    	<input type="hidden" name="aboutid">
		                	<div class="row mt-3">
		                		<div class="col-md-12">
		                			<div class="row">
		                				<div class="col-md-12">
		                					<div class="form-group">
		                						<label class="control-label col-md-12">About</label>
				                                <div class="col-md-12">
												<textarea name="view_about" id="" 			class="form-control" cols="30" readonly></textarea>
				                                    <span class="help-block text-danger"></span>
				                                </div>
		                					</div>
                                            <div class="form-group">
                                                <label class="control-label col-md-12">mission</label>
                                                <div class="col-md-12">
                                                    <textarea name="view_mission" id="" class="form-control" cols="30" readonly></textarea>
                                                    <span class="help-block text-danger"></span>
                                                </div>
											</div>
											<div class="form-group">
                                                <label class="control-label col-md-12">Vision</label>
                                                <div class="col-md-12">
                                                    <textarea name="view_vision" id="" class="form-control" cols="30" readonly></textarea>
                                                    <span class="help-block text-danger"></span>
                                                </div>
											</div>
											<div class="form-group">
                                                <label class="control-label col-md-12">What we Do</label>
                                                <div class="col-md-12">
                                                    <textarea name="view_services" id="" class="form-control" cols="30" readonly></textarea>
                                                    <span class="help-block text-danger"></span>
                                                </div>
											</div>
											<div class="form-group">
                                                <label class="control-label col-md-12">More about PDN</label>
                                                <div class="col-md-12">
                                                    <textarea name="view_more" id="" class="form-control" cols="30" readonly></textarea>
                                                    <span class="help-block text-danger"></span>
                                                </div>
											</div>
											<div class="form-group">
                                                <label class="control-label col-md-12">PDN existence</label>
                                                <div class="col-md-12">
                                                    <textarea name="view_existence" id="" class="form-control" cols="30" readonly></textarea>
                                                    <span class="help-block text-danger"></span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-12">Created Date</label>
                                                <div class="col-md-12">
                                                    <input type="text" name="view_created_date" class="form-control" readonly>
                                                    <span class="help-block text-danger"></span>
                                                </div>
											</div>
											<!-- About Image -->
											<div class="form-group" id="show_Image">
												<label class="control-label col-md-12 pt-2">About Image</label>
												<div class="col-md-12 mb-3">
													<img src="<?=base_url('uploads/users/nophoto.jpg'); ?>" class="img-center" id="viewAboutImage">
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
		    	$('#aboutNav').addClass('active');
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
		                    titleAttr: 'Add About Us',
		                    action: function () {
		                        add_about();
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
		                    filename: 'about Information',
		                    extension: '.xlsx',
		                    exportOptions: {
		                        columns: [1,2,3,4,5,6,7]
		                    },
		                },
		                {
		                    extend: 'csv',
		                    className: 'btn btn-primary',
		                    titleAttr: 'Export CSV Data',
		                    text: '<i class="fa fa-bars"></i>',
		                    filename: 'about Information',
		                    extension: '.csv',
		                    exportOptions: {
		                        columns: [1,2,3,4,5,6,7]
		                    },
		                },
		                {
		                    extend: 'print',
		                    title: "<h3 class='text-center'><?=$this->systemdata->sname; ?></h3><h4 class='text-center'>about Information</h4><h5 class='text-center'>Printed On <?php echo date('l, d F, Y'); ?></h5>",
		                    exportOptions: {
		                        columns: [1,2,3,4,5,6,7]
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
		                    filename: 'about Information'
		                },
		            ],
		            responsive: true,
		            // Load data for the table's content from an Ajax source
		            "ajax": {
		                "url": "<?php echo base_url('admin/about/generate_about');?>",
		                "type": "POST"
		            },

		            //Set column definition initialisation properties.
		            "columnDefs": [
		                {"targets": [0], "orderable": false},{"targets": [1], "orderable": false},
		                {"targets": [8], "orderable": false},
		            ],

		        });

		        //set input/textarea/select about when change value, remove about error and remove text help block 
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
			
			function previewaboutImage() {
	            var oFReader = new FileReader();
	            oFReader.readAsDataURL(document.getElementById("aboutImage").files[0]);
	            oFReader.onload = function (oFRabout) {
	            document.getElementById("viewaboutImage").src = oFRabout.target.result;
	            };
	        };

	        //previewImage
	        function previewaboutImage() {
	            var oFReader = new FileReader();
	            oFReader.readAsDataURL(document.getElementById("aboutImage").files[0]);
	            oFReader.onload = function (oFRabout) {
	            document.getElementById("viewaboutImage").src = oFRabout.target.result;
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

		    function add_about(){
		        save_method = 'add';
		        $('#form')[0].reset(); // reset form on modals
		        $('.form-group').removeClass('has-error'); // clear error about
		        $('.help-block').empty(); // clear error string
		        $('#modal_form').modal('show'); // show bootstrap modal
		        $('.modal-title').text('Add About Us'); 
		        $('#btnSave').text('Add');
		    }

		    function save_about(){
		        if (save_method == 'add') {
		            $('#btnSave').text('adding...');
		        }else{
		            $('#btnSave').text('updating...');
		        }
		       
		        $('#btnSave').attr('disabled', true); //set button disable 
		        var url;
		        if (save_method == 'add') {
		            url = "<?php echo base_url('admin/about/add_new_about');?>";
		        } else {
		            url = "<?php echo base_url('admin/about/update_about_records');?>";
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
		                        swal("about Added!", "New about added Successfully!", "success");
		                    } else {

		                        swal("about Updated!", "about Records Updated Successfully!", "success");
		                    }
		                }else if (data === 'about_exist'){
		                	swal("Sorry, about Exist!", "about already taken.  Try another name!", "error");
		                }else if (data === "access_denied"){
		                    if (save_method == 'add') {
		                        swal("Access Denied!", "You're not Authorized to create any new about!", "error");
		                    } else {
		                        swal("Access Denied!", "You're not Authorized to update any about!", "error");
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
		                    swal("Error Occured!", "New about Records couldn't be Added!", "error");
		                    $('#btnSave').text('Add'); //change button text
		                    $('#btnSave').attr('disabled', false); //set button enable  
		                }else{
		                    swal("Error Occured!", "about Records couldn't be Update!", "error");
		                    $('#btnSave').text('Update'); //change button text
		                    $('#btnSave').attr('disabled', false); //set button enable  
		                }
		            }
		        });
		    }


		    function update_about(id) {
		        save_method = 'update';
		        $('#form')[0].reset(); // reset form on modals
		        $('.form-group').removeClass('has-error'); // clear error about
		        $('.help-block').empty(); // clear error string
		        //Ajax Load data from ajax
		        $.ajax({
		             url: "<?php echo base_url('admin/about/get_records_by_about_id');?>/" + id,
		             type: "GET",
		             dataType: "JSON",
		             success: function (data){
		                $('[name="aboutid"]').val(data.id);
		                $('[name="about"]').val(data.about);
						$('[name="mission"]').val(data.mission);
						$('[name="vision"]').val(data.vision);
		                $('[name="services"]').val(data.services);
						$('[name="more"]').val(data.more);
						$('[name="existence"]').val(data.existence);
		                $('#modal_form').modal('show'); 
		                $('[name="created_date"]').val(data.created_date);
		                $('.modal-title').text("Update " +data.about+ " Records"); 
		                $('#btnSave').text('Update');
		                // show-Image photo 
		                if (data.photo){
		                  $('#show_Image div').html('<img src="'+base_url+'uploads/about/'+data.aboutimage+'" class="img-center" style="width:210px;height:200px">');
		                }else{
		                	$('#show_Image div').html('<img src="'+base_url+'/updoads/users/nophoto.jpg" class="img-center">');
		                }
		            },
		            error: function (jqXHR, textStatus, errorThrown){
		                swal("Error Occured!", "Role Record couldnot be displayed Now!", "error");
		            }
		        });
		    }


		    function view_about(id) {
		    	//Ajax Load data from ajax
		        $.ajax({
		            url: "<?php echo base_url('admin/about/get_records_by_about_id') ?>/" + id,
		            type: "GET",
		            dataType: "JSON",
		            success: function (data){
		                $('[name="view_about"]').val(data.about);
						$('[name="view_mission"]').val(data.mission);
						$('[name="view_vision"]').val(data.vision);
						$('[name="view_services"]').val(data.services);
						$('[name="view_more"]').val(data.more);
						$('[name="view_existence"]').val(data.existence);
		                $('#view_modal_form').modal('show'); 
		                $('[name="view_created_date"]').val(data.created_date);
		                $('.modal-title').text("View " +data.about+ " Records"); 
		                // show-Image photo
		                if (data.photo){
		                  $('#show_Image div').html('<img src="'+base_url+'uploads/about/'+data.aboutimage+'" class="img-center" style="width:210px;height:200px">');
		                }else{
		                	$('#show_Image div').html('<img src="'+base_url+'/updoads/users/nophoto.jpg" class="img-center">');
		                }
		            },
		            error: function (jqXHR, textStatus, errorThrown)
		            {
		                swal("Error Occured!", "about Records couldnot be viewed Now!", "error");
		            }
		        });
		    }

		    function delete_about(id,about){
		        swal({
		            title: "Are you sure?",
		            text: "Your will not be able to recover "+about+" Records!",
		            type: "warning",
		            showCancelButton: true,
		            confirmButtonClass: "btn-danger",
		            confirmButtonText: "Yes, delete!",
		            cancelButtonText: "No, cancel",
		            closeOnConfirm: false
		        },
		        function(){
		            $.ajax({
		                url: "<?php echo base_url('admin/about/delete_about_record')?>/" + id,
		                type: "POST",
		                dataType: "JSON",
		                success: function (data)
		                {
		                    if (data.status) {
		                        swal("about Deleted!",about+" Records deleted successfully!", "success");
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
		                        url: "<?php echo site_url('admin/about/bulk_about_delete');?>",
		                        dataType: "JSON",
		                        success: function (data){
		                            if (data.status)
		                            {
		                                swal("about  Deleted!", "Selected about Records deleted successfully!", "success");
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
		                    swal("Cancelled!", "Selected about Records are NOT deleted!", "error");
		                }
		            });
		        } else
		        {
		            swal("Sorry!", "Atleast select one record to complete this process!", "error");
		        }
		    }
		</script>
