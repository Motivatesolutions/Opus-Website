<style type="text/css">
    .bg-teal{
		/*background-color: #1bd2be;*/
		color: #000;
		font-size: 16px;
    }
</style>
<section id="main-content" style="font-family: 'Coda';">
	<section class="wrapper">
		<br><br><br><br>
		<div class="row">
          	<div class="col-lg-12" >
	            <section class="panel">
		            <header class="panel-heading">
		                <h1 class="text-infos py-4 pl-3tea py-2">System Modules Information
		                </h1> 
		            </header>
	              	<div class="panel-body">
	               		<div class="table-responsive">
	               			<table id="table" class="table table-striped table-bordered table-hover" width="100%">
	               				<thead>
	               					<tr>
	               						<!-- <th class="text-center"><input type="checkbox" id="check-all"></th> -->
	               						<th>S.No</th>
	               						<th>Module Name</th>
	               						<th>Module Type</th>
	               						<th class="text-center">Action</th>
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
        <!-- add and update faculty pop-up -->
	    <div id="modal_form" class="modal fade" role="dialog">
	        <div class="modal-dialog">
	            <div class="modal-content" style="font-family: 'Coda';">
	                <div class="modal-header">
	                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">&times;</button>
	                    <h3 class="modal-title text-primary"></h3>
	                </div>
	                <div class="modal-body card-body">
	                    <form action="#" id="form" autocomplete="off">
	                    	<input type="hidden" name="module_id">
	                    	<div class="row mt-3">
		                        <div class="col-md-12">
		                            <div class="form-group">
		                                <label class="control-label col-md-12">Module Name</label>
		                                <div class="col-md-12">
		                                	<select id="role_id" name="role_id" class="form-control">
		                                		<option value="">Select Module Name</option>
		                                	</select>
		                                    <span class="help-block text-danger"></span>
		                                </div>
		                            </div>
		                        </div>
		                    </div>
	                    </form>
	                </div>
	                <div class="modal-footer card-footer">
	                    <div class="form-data mt-2 d-flex">
	                    	<button type="button" id="btnSave" onclick="save_module()" class="btn btn-primary"></button>
	                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	    <!-- view model pop-up -->
	    <div id="view_modal_form" class="modal fade" role="dialog">
	        <div class="modal-dialog">
	            <div class="modal-content" style="font-family: 'Coda';">
	                <div class="modal-header">
	                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">&times;</button>
	                    <h3 class="modal-title text-primary"></h3>
	                </div>
	                <div class="modal-body card-body bg-teal">
	                    <form action="#" id="form">
	                    	<!-- <input type="hidden" name="module_id"> -->
	                    	<div class="row mt-3">
		                        <div class="col-md-12">
		                            <div class="form-group">
		                                <label class="control-label col-md-12">Module Name</label>
		                                <div class="col-md-12">
		                                    <input name="view_module_name" class="form-control" type="text" readonly>
		                                    <span class="help-block text-danger"></span>
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
		    	$('#moduleNav').addClass('active');
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
		                    titleAttr: 'Add New Module',
		                    action: function () {
		                        add_module();
		                    }
		                },
		                /*{
		                    text: '<i class="fa fa-trash"></i> Bulk Delete',
		                    className: "btn btn-danger",
		                    titleAttr: 'Bulk Delete',
		                    action: function () {
		                        bulk_delete();
		                    }
		                },*/
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
		                    filename: 'System Modules Information',
		                    extension: '.xlsx',
		                    exportOptions: {
		                        columns: [0,1,2]
		                    },
		                },
		                {
		                    extend: 'csv',
		                    className: 'btn btn-primary',
		                    titleAttr: 'Export CSV Data',
		                    text: '<i class="fa fa-bars"></i>',
		                    filename: 'System Modules Information',
		                    extension: '.csv',
		                    exportOptions: {
		                        columns: [0,1,2]
		                    },
		                },
		                {
		                    extend: 'print',
		                    title: "<h3 class='text-center'><?=$this->systemdata->sname; ?></h3><h4 class='text-center'>System Modules Information</h4><h5 class='text-center'>Printed On <?php echo date('l, d F, Y'); ?></h5>",
		                    exportOptions: {
		                        columns: [0,1,2]
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
		                    filename: 'System Module Information'
		                },
		            ],
		            responsive: true,
		            // Load data for the table's content from an Ajax source
		            "ajax": {
		                "url": "<?php echo base_url('admin/modules/generate_module');?>",
		                "type": "POST"
		            },

		            //Set column definition initialisation properties.
		            "columnDefs": [
		                {"targets": [0], "orderable": false},{"targets": [1], "orderable": false},
		                {"targets": [3], "orderable": false},
		            ],

		        });
		        // AJAX request
		        $.ajax({
		            url: '<?=base_url('admin/roles/get_roles_info') ?>',
		            method: 'post',
		            data: {role_id: $(this).val()},   /* variable name */
		            dataType: 'json',
		            success: function (response) {
		                // Remove options
		                $('#role_id').find('option').not(':first').remove();
		                // Add options
		                $.each(response, function (index, data) {
		                  $('#role_id').append('<option value="' + data['role'] +'">' + data['name'] +'</option>');
		              });
		            }
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


			function reload_table(){
		        $('#table').DataTable().ajax.reload();
		        /* This is to uncheck the column header check box */
		        $('input[type=checkbox]').each(function ()
		        {
		            this.checked = false;
		        });
		    }

		    function add_module(){
		        save_method = 'add';
		        $('#form')[0].reset(); // reset form on modals
		        $('.form-group').removeClass('has-error'); // clear error rolerole
		        $('.help-block').empty(); // clear error string
		        $('#modal_form').modal('show'); // show bootstrap modal
		        $('.modal-title').text('Add New Module'); 
		        $('#btnSave').text('Add');
		    }

		    function update_role(id) {
		        save_method = 'update';
		        $('#form')[0].reset(); // reset form on modals
		        $('.form-group').removeClass('has-error'); // clear error rolerole
		        $('.help-block').empty(); // clear error string
		        //Ajax Load data from ajax
		        $.ajax({
		             url: "<?php echo base_url('admin/modules/get_records_by_module_id') ?>/" +id,
		             type: "GET",
		             dataType: "JSON",
		             success: function (data){
		                $('[name="module_id"]').val(data.module_id);
		                $('[name="role"]').val(data.name);
		                $('#modal_form').modal('show'); 
		                $('.modal-title').text("Update " +data.name+ " Records"); 
		                $('#btnSave').text('Update');
		            },
		            error: function (jqXHR, textStatus, errorThrown)
		            {
		                swal("Error Occured!", "Module Record couldnot be displayed Now!", "error");
		            }
		        });
		    }

		    function save_module(){
		        if (save_method == 'add') {
		            $('#btnSave').text('adding...');
		        }else{
		            $('#btnSave').text('updating...');
		        }
		       
		        $('#btnSave').attr('disabled', true); //set button disable 
		        var url;
		        if (save_method == 'add') {
		            url = "<?php echo base_url('admin/modules/add_new_module') ?>";
		        } else {
		            url = "<?php echo base_url('admin/modules/update_module_records') ?>";
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
		                    //refresh all the tables
		                    reload_table();
		                    if (save_method == 'add') {
		                        swal("Module Added!", "New Module has been added Successfully!", "success");
		                    } else {

		                        swal("Module Updated!", "Module Records Updated Successfully!", "success");
		                    }
		                }else if(data === 'module_name_exists'){
		                    swal("Sorry, Module Name Exist!", "New Module Name already added!", "error");
		                    
		                }else if (data === "access_denied") {
		                    if (save_method == 'add') {
		                        swal("Access Denied!", "You're not Authorized to add any new Module!", "error");
		                    } else {
		                        swal("Access Denied!", "You're not Authorized to update any Module!", "error");
		                    }
		                } else
		                {
		                    for (var i = 0; i < data.inputerror.length; i++)
		                    {
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
		                    swal("Error Occured!", "New Module Records couldn't be Added!", "error");
		                    $('#btnSave').text('Add'); //change button text
		                    $('#btnSave').attr('disabled', false); //set button enable  
		                }else{
		                    swal("Error Occured!", "Module Records couldn't be Update!", "error");
		                    $('#btnSave').text('Update'); //change button text
		                    $('#btnSave').attr('disabled', false); //set button enable  
		                }
		            }
		        });
		    }

		    function view_module(module_id){
		    	//Ajax Load data from ajax
		        $.ajax({
		            url: "<?php echo base_url('admin/modules/get_records_by_module_id') ?>/" + module_id,
		            type: "GET",
		            dataType: "JSON",
		            success: function (data){
		                $('[name="view_module_name"]').val(data.module_name);
		                $('#view_modal_form').modal('show');
		                $('.modal-title').text("View " +data.module_name+ " Records"); 
		            },
		            error: function (jqXHR, textStatus, errorThrown)
		            {
		                swal("Error Occured!", "Module Records couldnot be viewed Now!", "error");
		            }
		        });
		    }

		    function delete_role(module_id,role_name){
		        swal({
		            title: "Are you sure?",
		            text: "Your will not be able to recover "+role_name+" Records!",
		            type: "warning",
		            showCancelButton: true,
		            confirmButtonClass: "btn-danger",
		            confirmButtonText: "Yes, delete!",
		            cancelButtonText: "No, cancel",
		            closeOnConfirm: false
		        },
		        function(){
		            $.ajax({
		                url: "<?php echo base_url('admin/modules/delete_role_record') ?>/" + module_id,
		                type: "POST",
		                dataType: "JSON",
		                success: function (data)
		                {
		                    if (data.status) {
		                        swal("Role Deleted!", role_name+" Records deleted successfully!", "success");
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
		                        data: {module_id: list_id},
		                        url: "<?php echo site_url('admin/modules/bulk_role_delete') ?>",
		                        dataType: "JSON",
		                        success: function (data)
		                        {
		                            if (data.status)
		                            {
		                                swal("Role Deleted!", "Selected Role Records deleted successfully!", "success");
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
		                    swal("Cancelled!", "Selected Role Records are NOT deleted!", "error");
		                }
		            });
		        } else
		        {
		            swal("Sorry!", "Atleast select one record to complete this process!", "error");
		        }
		    }
		</script>