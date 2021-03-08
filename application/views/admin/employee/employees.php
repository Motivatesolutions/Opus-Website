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
	input[type="file"],input[type="text"],input[type="date"],input[name="emp_id" ],
	select[name="gender"],select[name="emp_type"],select[name="branch_id"],input[type="email"]{
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
		                	Employee Information
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
	               						<th>Employee Name</th>
	               						<th>Phone</th>
	               						<th>Email</th>
	               						<th>Address</th>
	               						<th>Role Name</th>
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
	                    	<input type="hidden" name="employeeid">
		                	<div class="row mt-3">
		                		<div class="col-md-12">
		                			<div class="row">
		                				<div class="col-md-4">
		                					<div class="form-group">
		                						<label class="control-label col-md-12">Employee Name</label>
				                                <div class="col-md-12">
				                                    <input name="emp_name" placeholder="Employee Name" class="form-control" type="text">
				                                    <span class="help-block text-danger"></span>
				                                </div>
		                					</div>
		                					<div class="form-group">
		                						<label class="control-label col-md-12">Next of Kin Name</label>
				                                <div class="col-md-12">
				                                	<input type="text" name="nok_name" class="form-control" placeholder="Next of kin Name">
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
                    						  <label class="control-label col-md-12">Email Address</label>
				                                <div class="col-md-12">
				                                	<input type="email" name="email" class="form-control" placeholder="Employee Email Address">
				                                    <span class="help-block text-danger"></span>
				                                </div>
		                                    </div>
		                                    <div class="form-group">
                    						  <label class="control-label col-md-12">Employee Role</label>
				                                <div class="col-md-12">
				                                	<select name="emp_role" class="form-control">
				                                		<option value="">Select Employee Role</option>
				                                		<?php if (count($roleResults) > 0): 
				                                			foreach ($roleResults as $row) : ?>
				                                				<option value="<?=$row->role; ?>"><?=$row->name; ?></option>
				                                			<?php endforeach; ?>
				                                		<?php else : ?>
				                                			<option value="">No Role Found</option>
				                                		<?php endif ?>
				                                	</select>
				                                    <span class="help-block text-danger"></span>
				                                </div>
											</div>	
											<div class="form-group">
												<label class="control-label col-md-12">Phone Number</label>
												<div class="col-md-12">
													<input type="text" name="contact" class="form-control" placeholder="Phone Number" min="0" minlength="10">
													<span class="help-block text-danger"></span>
												</div>
											</div>
		                				</div>
		                				<div class="col-md-4">
											<div class="form-group">
												<label class="control-label col-md-12">Date of Birth</label>
												<div class="col-md-12">
													<input name="birthday" placeholder="Employee Date Of Birthday" class="form-control" type="date" required>
													<span class="help-block text-danger"></span>
												</div>
											</div>
		                    					<div class="form-group">
		                    						<label class="control-label col-md-12">Nationality</label>
					                                <div class="col-md-12">
					                                  <input type="text" name="nationality" class="form-control" placeholder="Employee Nationality">
					                                  <span class="help-block text-danger"></span>
					                                </div>
		                    					</div>
		                    					<div class="form-group">
		                    						<label class="control-label col-md-12">Next of kin Contact</label>
					                                <div class="col-md-12">
					                                	<input type="text" name="nok_contact" class="form-control" placeholder="Next of kin Contact Number" min="0" minlength="10">
					                                    <span class="help-block text-danger"></span>
					                                </div>
	                    					    </div>
		                    					<div class="form-group">
	                    						  <label class="control-label col-md-12">Address</label>
					                                <div class="col-md-12">
					                                	<input type="text" name="address" class="form-control" placeholder="Employee Address">
					                                    <span class="help-block text-danger"></span>
					                                </div>
												</div>
												<div class="form-group">
		                    						<label class="control-label col-md-12">faceook link</label>
					                                <div class="col-md-12">
					                                  <input type="link" name="facebook_link" class="form-control" placeholder="facebook link">
					                                  <span class="help-block text-danger"></span>
					                                </div>
												</div>
												<div class="form-group">
		                    						<label class="control-label col-md-12">twitter link</label>
					                                <div class="col-md-12">
					                                  <input type="text" name="twitter_link" class="form-control" placeholder="twitter link">
					                                  <span class="help-block text-danger"></span>
					                                </div>
												</div>
																	
											</div>
											<div class="col-md-4">
												
												<div class="form-group">
		                    						<label class="control-label col-md-12">youtube link</label>
					                                <div class="col-md-12">
					                                  <input type="text" name="youtube_link" class="form-control" placeholder="youtube link">
					                                  <span class="help-block text-danger"></span>
					                                </div>
												</div>
		                    					<div class="form-group">
		                    						 <label class="control-label col-md-12">Join Date</label>
					                                <div class="col-md-12">
					                                    <input  type="text" name="join_date" placeholder="Join Date" class="form-control" readonly value="<?php echo date('Y-m-d'); ?>">
					                                    <span class="help-block text-danger"></span>
					                                </div>
		                    					</div>
		                    					<!-- Users profile picture -->
					                    		<div class="form-group" id="show_profile">
					                               <label class="control-label col-md-12 pt-2">Profile Photo (600x600)</label>
					                                <div class="col-md-12 mb-3">
			                                            <img src="<?=base_url('uploads/users/nophoto.jpg'); ?>" class="img-center" id="viewEmployeeProfile">
					                                </div>
					                            </div>
					                    	    <div class="form-group">
					                                <label class="control-label col-md-12">Profile Picture</label>
					                                <div class="col-md-12">
					                                   <input  type="file" name="photo" onchange="previewEmployeeImage();" class="form-control" accept=".jpg, .jpeg, .png" required id="EmployeeProfile">
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
	                    	<button type="button" id="btnSave" onclick="save_employee()" class="btn btn-primary"></button>
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
	                    	<input type="hidden" name="employeeid">
		                	<div class="row mt-3">
		                		<div class="col-md-12">
		                			<div class="row">
		                				<div class="col-md-4">
		                					<div class="form-group">
		                						<label class="control-label col-md-12">Employee Name</label>
				                                <div class="col-md-12">
				                                    <input name="view_emp_name" class="form-control" type="text" readonly>
				                                    <span class="help-block text-danger"></span>
				                                </div>
		                					</div>
		                					<div class="form-group">
		                						<label class="control-label col-md-12">Next of Kin Name</label>
				                                <div class="col-md-12">
				                                	<input type="text" name="view_nok_name" class="form-control" readonly>
				                                    <span class="help-block text-danger"></span>
				                                </div>
		                					</div>
		                					<div class="form-group">
		                						<label class="control-label col-md-12">Gender</label>
				                                <div class="col-md-12">
				                                    <input type="text" name="view_gender" class="form-control" readonly>
				                                    <span class="help-block text-danger"></span>
				                                </div>
		                					</div>
		                					<div class="form-group">
                    						  <label class="control-label col-md-12">Email Address</label>
				                                <div class="col-md-12">
				                                	<input type="email" name="view_email" class="form-control" readonly>
				                                    <span class="help-block text-danger"></span>
				                                </div>
		                                    </div>	
		                                    <div class="form-group">
                    						  <label class="control-label col-md-12">Employee Role</label>
				                                <div class="col-md-12">
				                                	<input type="email" name="view_erole" class="form-control" readonly>
				                                    <span class="help-block text-danger"></span>
				                                </div>
											</div>
											<div class="form-group">
		                    						<label class="control-label col-md-12">Phone Number</label>
					                                <div class="col-md-12">
					                                  <input type="text" name="view_contact" class="form-control" readonly min="0" minlength="10">
					                                  <span class="help-block text-danger"></span>
					                                </div>
		                    					</div>
		                    					
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label class="control-label col-md-12">Date of Birth</label>
												<div class="col-md-12">
													<input name="view_birthday" class="form-control" type="date" readonly>
													<span class="help-block text-danger"></span>
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-12">Nationality</label>
												<div class="col-md-12">
													<input type="text" name="view_nationality" class="form-control" readonly>
													<span class="help-block text-danger"></span>
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-12">Next of kin Contact</label>
												<div class="col-md-12">
													<input type="text" name="view_nok_contact" class="form-control" readonly>
													<span class="help-block text-danger"></span>
												</div>
											</div>	
											<div class="form-group">
												<label class="control-label col-md-12">facebook link</label>
												<div class="col-md-12">
													<input type="text" name="view_facebook_link" class="form-control" readonly>
													<span class="help-block text-danger"></span>
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-12">twitter link</label>
												<div class="col-md-12">
													<input type="text" name="view_twitter_link" class="form-control" readonly>
													<span class="help-block text-danger"></span>
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-12">youtube link</label>
												<div class="col-md-12">
													<input type="text" name="view_youtube_link" class="form-control" readonly>
													<span class="help-block text-danger"></span>
												</div>
											</div>             					
										</div>
		                				<div class="col-md-4">
			                                    <div class="form-group">
	                    						  <label class="control-label col-md-12">Join Date</label>
					                                <div class="col-md-12">
					                                	<input type="text" name="view_join_date" class="form-control" readonly>
					                                    <span class="help-block text-danger"></span>
					                                </div>
			                                    </div>
		                    					<div class="form-group">
	                    						  <label class="control-label col-md-12">Address</label>
					                                <div class="col-md-12">
					                                	<input type="text" name="view_address" class="form-control" readonly>
					                                    <span class="help-block text-danger"></span>
					                                </div>
			                                    </div>
		                    					<div class="form-group">
		                    						 <label class="control-label col-md-12">Current Date</label>
					                                <div class="col-md-12">
					                                    <input  type="text" placeholder="Join Date" class="form-control" readonly value="<?php echo date('Y-m-d'); ?>">
					                                    <span class="help-block text-danger"></span>
					                                </div>
		                    					</div>
		                    					<!-- Users profile picture -->
					                    		<div class="form-group" id="show_profile">
					                               <label class="control-label col-md-12 pt-2">Profile Photo</label>
					                                <div class="col-md-12 mb-3">
			                                            <img src="<?=base_url('uploads/users/nophoto.jpg'); ?>" class="img-center" id="viewEmployeeProfile">
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
		    	$('#employeeNav').addClass('active');
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
		                    titleAttr: 'Add New Employee',
		                    action: function () {
		                        add_employee();
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
		                    filename: 'Employee Information',
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
		                    filename: 'Employee Information',
		                    extension: '.csv',
		                    exportOptions: {
		                        columns: [1,2,3,4,5,6,7]
		                    },
		                },
		                {
		                    extend: 'print',
		                    title: "<h3 class='text-center'><?=$this->systemdata->sname; ?></h3><h4 class='text-center'>Employee Information</h4><h5 class='text-center'>Printed On <?php echo date('l, d F, Y'); ?></h5>",
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
		                    filename: 'Employee Information'
		                },
		            ],
		            responsive: true,
		            // Load data for the table's content from an Ajax source
		            "ajax": {
		                "url": "<?php echo base_url('admin/employees/generate_employee');?>",
		                "type": "POST"
		            },

		            //Set column definition initialisation properties.
		            "columnDefs": [
		                {"targets": [0], "orderable": false},{"targets": [1], "orderable": false},
		                {"targets": [8], "orderable": false},
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
			
			function previewEmployeeImage() {
	            var oFReader = new FileReader();
	            oFReader.readAsDataURL(document.getElementById("EmployeeProfile").files[0]);
	            oFReader.onload = function (oFREvent) {
	            document.getElementById("viewEmployeeProfile").src = oFREvent.target.result;
	            };
	        };

	        //previewuserProfileImage
	        function previewEmployeeProfileImage() {
	            var oFReader = new FileReader();
	            oFReader.readAsDataURL(document.getElementById("EmployeeProfile").files[0]);
	            oFReader.onload = function (oFREvent) {
	            document.getElementById("viewEmployeeProfile").src = oFREvent.target.result;
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

		    function add_employee(){
		        save_method = 'add';
		        $('#form')[0].reset(); // reset form on modals
		        $('.form-group').removeClass('has-error'); // clear error program
		        $('.help-block').empty(); // clear error string
		        $('#modal_form').modal('show'); // show bootstrap modal
		        $('.modal-title').text('Add New Employee'); 
		        $('#btnSave').text('Add');
		    }

		    function save_employee(){
		        if (save_method == 'add') {
		            $('#btnSave').text('adding...');
		        }else{
		            $('#btnSave').text('updating...');
		        }
		       
		        $('#btnSave').attr('disabled', true); //set button disable 
		        var url;
		        if (save_method == 'add') {
		            url = "<?php echo base_url('admin/employees/add_new_employee');?>";
		        } else {
		            url = "<?php echo base_url('admin/employees/update_employee_records');?>";
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
		                        swal("Employee Added!", "New Employee added Successfully!", "success");
		                    } else {

		                        swal("Employee Updated!", "Employee Records Updated Successfully!", "success");
		                    }
		                }else if(data === 'employee_id_exists'){
		                    swal("Sorry, Employee ID Exist!", "Employee ID already Taken!", "error");
		                    
		                }else if(data === 'contact_exists'){
		                	swal("Sorry, Number Exist!", "Phone number is already taken, Try another Please!", "error");
		                }else if(data === 'username_exist'){
		                	swal("Sorry, Username Exist!", "Username already taken.  Try another username!", "error");
		                }else if (data === 'employee_name_exist'){
		                	swal("Sorry, Employee Exist!", "Employee already taken.  Try another name!", "error");
		                }else if (data === 'email_exist'){
		                	swal("Sorry, Email Exist!", "Email already taken.  Try Another One!", "error");
		                }else if (data === "access_denied"){
		                    if (save_method == 'add') {
		                        swal("Access Denied!", "You're not Authorized to create any new Employee!", "error");
		                    } else {
		                        swal("Access Denied!", "You're not Authorized to update any Employee!", "error");
		                    }
		                }else if (data === "not_sent") {
		                	swal("Message Not Sent","Login Credential was not sent to Employee may be due to Internet!","error");
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
		                    swal("Error Occured!", "New Employee Records couldn't be Added!", "error");
		                    $('#btnSave').text('Add'); //change button text
		                    $('#btnSave').attr('disabled', false); //set button enable  
		                }else{
		                    swal("Error Occured!", "Employee Records couldn't be Update!", "error");
		                    $('#btnSave').text('Update'); //change button text
		                    $('#btnSave').attr('disabled', false); //set button enable  
		                }
		            }
		        });
		    }


		    function update_employee(id) {
		        save_method = 'update';
		        $('#form')[0].reset(); // reset form on modals
		        $('.form-group').removeClass('has-error'); // clear error employee
		        $('.help-block').empty(); // clear error string
		        //Ajax Load data from ajax
		        $.ajax({
		             url: "<?php echo base_url('admin/employees/get_records_by_empoyeee_id');?>/" + id,
		             type: "GET",
		             dataType: "JSON",
		             success: function (data){
		                $('[name="employeeid"]').val(data.id);
		                $('[name="emp_role"]').val(data.emp_role);
		                $('[name="emp_name"]').val(data.emp_name);
		                $('[name="birthday"]').val(data.dob);
		                $('[name="gender"]').val(data.gender);
		                $('[name="address"]').val(data.address);
		                $('[name="email"]').val(data.email);
		                $('[name="contact"]').val(data.contact);
		                $('[name="nok_name"]').val(data.nok_name);
		                $('[name="nationality"]').val(data.nationality);
		                $('[name="nok_contact"]').val(data.nok_contact);
		                $('#modal_form').modal('show'); 
						$('[name="facebook_link"]').val(data.facebook_link);
		                $('[name="twitter_link"]').val(data.twitter_link);
		                $('[name="youtube_link"]').val(data.youtube_link);
		                $('[name="branch_id"]').val(data.branch_id);
		                $('[name="join_date"]').val(data.reg_date);
		                $('.modal-title').text("Update " +data.emp_name+ " Records"); 
		                $('#btnSave').text('Update');
		                // show-profile photo 
		                if (data.photo){
		                  $('#show_profile div').html('<img src="'+base_url+'uploads/employees/'+data.photo+'" class="img-center" style="width:210px;height:200px">');
		                }else{
		                	$('#show_profile div').html('<img src="'+base_url+'/updoads/users/nophoto.jpg" class="img-center">');
		                }
		            },
		            error: function (jqXHR, textStatus, errorThrown){
		                swal("Error Occured!", "Role Record couldnot be displayed Now!", "error");
		            }
		        });
		    }


		    function view_employee(employee_id) {
		    	//Ajax Load data from ajax
		        $.ajax({
		            url: "<?php echo base_url('admin/employees/get_records_by_empoyeee_id') ?>/" + employee_id,
		            type: "GET",
		            dataType: "JSON",
		            success: function (data){
		            	$('[name="view_erole"]').val(data.emp_rname);
		                $('[name="view_emp_name"]').val(data.emp_name);
		                $('[name="view_birthday"]').val(data.dob);
		                $('[name="view_gender"]').val(data.gender);
		                $('[name="view_address"]').val(data.address);
		                $('[name="view_email"]').val(data.email);
		                $('[name="view_contact"]').val(data.contact);
		                $('[name="view_nok_name"]').val(data.nok_name);
		                $('[name="view_nationality"]').val(data.nationality);
		                $('[name="view_nok_contact"]').val(data.nok_contact);
		                $('#view_modal_form').modal('show'); 
						$('[name="view_faceook_link"]').val(data.faceook_link);
		                $('[name="view_twitter_link"]').val(data.twitter_link);
		                $('[name="view_youtube_link"]').val(data.youtube_link);
		                $('[name="view_join_date"]').val(data.reg_date);
		                $('.modal-title').text("View " +data.emp_name+ " Records"); 
		                // show-profile photo
		                if (data.photo){
		                  $('#show_profile div').html('<img src="'+base_url+'uploads/employees/'+data.photo+'" class="img-center" style="width:210px;height:200px">');
		                }else{
		                	$('#show_profile div').html('<img src="'+base_url+'/updoads/users/nophoto.jpg" class="img-center">');
		                }
		            },
		            error: function (jqXHR, textStatus, errorThrown)
		            {
		                swal("Error Occured!", "Employee Records couldnot be viewed Now!", "error");
		            }
		        });
		    }

		    function delete_employee(id,emp_name){
		        swal({
		            title: "Are you sure?",
		            text: "Your will not be able to recover "+emp_name+" Records!",
		            type: "warning",
		            showCancelButton: true,
		            confirmButtonClass: "btn-danger",
		            confirmButtonText: "Yes, delete!",
		            cancelButtonText: "No, cancel",
		            closeOnConfirm: false
		        },
		        function(){
		            $.ajax({
		                url: "<?php echo base_url('admin/employees/delete_employee_record')?>/" + id,
		                type: "POST",
		                dataType: "JSON",
		                success: function (data)
		                {
		                    if (data.status) {
		                        swal("Employee Deleted!",emp_name+" Records deleted successfully!", "success");
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
		                        url: "<?php echo site_url('admin/employees/bulk_employee_delete');?>",
		                        dataType: "JSON",
		                        success: function (data){
		                            if (data.status)
		                            {
		                                swal("Employee  Deleted!", "Selected Employee Records deleted successfully!", "success");
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
		                    swal("Cancelled!", "Selected Employee Records are NOT deleted!", "error");
		                }
		            });
		        } else
		        {
		            swal("Sorry!", "Atleast select one record to complete this process!", "error");
		        }
		    }
		</script>
