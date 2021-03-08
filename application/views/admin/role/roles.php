<style type="text/css">
    .bg-teal{
		/*background-color: #1bd2be;*/
		color: #000;
		font-size: 16px;
    }
</style>
<section id="main-content" >
	<section class="wrapper">
		<br><br><br><br>
		<div class="row">
          	<div class="col-lg-12" >
	            <section class="panel">
		            <header class="panel-heading">
		                <h1 class="text-infos py-4 pl-3tea py-2">Roles Information
		                </h1> 
		            </header>
	              	<div class="panel-body">
	               		<div class="table-responsive">
	               			<table id="table" class="table table-striped table-bordered table-hover" width="100%">
	               				<thead>
	               					<tr>
	               						<!-- <th class="text-center"><input type="checkbox" id="check-all"></th> -->
	               						<th>S.No</th>
	               						<th>Role Name</th>
	               						<th>Role Type</th>
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
        <!-- add and update role pop-up -->
	    <div id="modal_form" class="modal fade" role="dialog">
	        <div class="modal-dialog">
	            <div class="modal-content">
	                <div class="modal-header">
	                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">&times;</button>
	                    <h3 class="modal-title text-primary"></h3>
	                </div>
	                <div class="modal-body card-body">
	                    <form action="#" id="form">
	                    	<input type="hidden" name="roleid">
	                    	<div class="row mt-3">
		                        <div class="col-md-12">
		                            <div class="form-group">
		                                <label class="control-label col-md-12">Role Name</label>
		                                <div class="col-md-12">
		                                    <input name="role" placeholder="Role Name" class="form-control" type="text" required>
		                                    <span class="help-block text-danger"></span>
		                                </div>
		                            </div>
		                        </div>
		                    </div>
	                    </form>
	                </div>
	                <div class="modal-footer card-footer">
	                    <div class="form-data mt-2 d-flex">
	                    	<button type="button" id="btnSave" onclick="save_role()" class="btn btn-primary"></button>
	                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	    <!-- view model pop-up -->
	    <div id="view_modal_form" class="modal fade" role="dialog">
	        <div class="modal-dialog">
	            <div class="modal-content">
	                <div class="modal-header">
	                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">&times;</button>
	                    <h3 class="modal-title text-primary"></h3>
	                </div>
	                <div class="modal-body card-body bg-teal">
	                    <form action="#" id="form">
	                    	<!-- <input type="hidden" name="roleid"> -->
	                    	<div class="row mt-3">
		                        <div class="col-md-12">
		                            <div class="form-group">
		                                <label class="control-label col-md-12">Role Name</label>
		                                <div class="col-md-12">
		                                    <input name="view_role_name" class="form-control" type="text" readonly>
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
		    	$('#roleNav').addClass('active');
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
		                    titleAttr: 'Add New Role',
		                    action: function () {
		                        add_role();
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
		                    filename: 'Role Information',
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
		                    filename: 'Role Information',
		                    extension: '.csv',
		                    exportOptions: {
		                        columns: [0,1,2]
		                    },
		                },
		                {
		                    extend: 'print',
		                    title: "<h3 class='text-center'><?=$this->systemdata->sname; ?></h3><h4 class='text-center'>Role Information</h4><h5 class='text-center'>Printed On <?php echo date('l, d F, Y'); ?></h5>",
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
		                    filename: 'Role Information'
		                },
		            ],
		            responsive: true,
		            // Load data for the table's content from an Ajax source
		            "ajax": {
		                "url": "<?php echo base_url('admin/roles/generate_role');?>",
		                "type": "POST"
		            },

		            //Set column definition initialisation properties.
		            "columnDefs": [
		                {"targets": [0], "orderable": false},{"targets": [1], "orderable": false},
		                {"targets": [3], "orderable": false},
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


			function reload_table(){
		        $('#table').DataTable().ajax.reload();
		        /* This is to uncheck the column header check box */
		        $('input[type=checkbox]').each(function ()
		        {
		            this.checked = false;
		        });
		    }

		    function add_role(){
		        save_method = 'add';
		        $('#form')[0].reset(); // reset form on modals
		        $('.form-group').removeClass('has-error'); // clear error rolerole
		        $('.help-block').empty(); // clear error string
		        $('#modal_form').modal('show'); // show bootstrap modal
		        $('.modal-title').text('Add New Role'); 
		        $('#btnSave').text('Add');
		    }

		    function update_role(id) {
		        save_method = 'update';
		        $('#form')[0].reset(); // reset form on modals
		        $('.form-group').removeClass('has-error'); // clear error rolerole
		        $('.help-block').empty(); // clear error string
		        //Ajax Load data from ajax
		        $.ajax({
		             url: "<?php echo base_url('admin/roles/get_records_by_role_id') ?>/" +id,
		             type: "GET",
		             dataType: "JSON",
		             success: function (data){
		                $('[name="roleid"]').val(data.role_id);
		                $('[name="role"]').val(data.name);
		                $('#modal_form').modal('show'); 
		                $('.modal-title').text("Update " +data.name+ " Records"); 
		                $('#btnSave').text('Update');
		            },
		            error: function (jqXHR, textStatus, errorThrown)
		            {
		                swal("Error Occured!", "Role Record couldnot be displayed Now!", "error");
		            }
		        });
		    }

		    function save_role(){
		        if (save_method == 'add') {
		            $('#btnSave').text('adding...');
		        }else{
		            $('#btnSave').text('updating...');
		        }
		       
		        $('#btnSave').attr('disabled', true); //set button disable 
		        var url;
		        if (save_method == 'add') {
		            url = "<?php echo base_url('admin/roles/add_new_role') ?>";
		        } else {
		            url = "<?php echo base_url('admin/roles/update_role_records') ?>";
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
		                        swal("Role Added!", "New Role has been added Successfully!", "success");
		                    } else {

		                        swal("Role Updated!", "Role Records Updated Successfully!", "success");
		                    }
		                }else if(data === 'role_name_exists'){
		                    swal("Sorry, Role Exist!", "New Role Name already added!", "error");
		                    
		                }else if (data === "access_denied") {
		                    if (save_method == 'add') {
		                        swal("Access Denied!", "You're not Authorized to create any new Role!", "error");
		                    } else {
		                        swal("Access Denied!", "You're not Authorized to update any Role!", "error");
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
		                    swal("Error Occured!", "New Role Records couldn't be Added!", "error");
		                    $('#btnSave').text('Add'); //change button text
		                    $('#btnSave').attr('disabled', false); //set button enable  
		                }else{
		                    swal("Error Occured!", "Role Records couldn't be Update!", "error");
		                    $('#btnSave').text('Update'); //change button text
		                    $('#btnSave').attr('disabled', false); //set button enable  
		                }
		            }
		        });
		    }

		    function view_role(role_id){
		    	//Ajax Load data from ajax
		        $.ajax({
		            url: "<?php echo base_url('admin/roles/get_records_by_role_id') ?>/" + role_id,
		            type: "GET",
		            dataType: "JSON",
		            success: function (data){
		                $('[name="view_role_name"]').val(data.name);
		                $('#view_modal_form').modal('show');
		                $('.modal-title').text("View " +data.name+ " Records"); 
		            },
		            error: function (jqXHR, textStatus, errorThrown)
		            {
		                swal("Error Occured!", "Role Records couldnot be viewed Now!", "error");
		            }
		        });
		    }

		    function delete_role(roleid,role_name){
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
		                url: "<?php echo base_url('admin/roles/delete_role_record') ?>/" + roleid,
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
		                        data: {role_id: list_id},
		                        url: "<?php echo site_url('admin/roles/bulk_role_delete') ?>",
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