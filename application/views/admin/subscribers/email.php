<style type="text/css">
    .bg-teal{
		/*background-color: #1bd2be;*/
		color: #000;
		font-size: 16px;
    }
</style>
<section id="main-content">
	<section class="wrapper">
		<br><br><br><br>
		<div class="row">
          	<div class="col-lg-12" >
	            <section class="panel">
		            <header class="panel-heading">
		                <h1 class="text-infos py-4 pl-3tea py-2">Email Subscribers Information
		                </h1> 
		            </header>
		            <!-- display flash data message-->
                    <?php if($this->session->flashdata('success')): ?>
                    	<div class="panel-body">
	                        <span style="color: green;font-size:16px;" class="text-center" id="ers">
	                            <?php echo $this->session->flashdata('success'); ?>
	                        </span>
	                    </div>
                    <?php elseif($this->session->flashdata('error')): ?>
                    	<div class="panel-body">
	                        <span style="color: red; ">
	                            <?php echo $this->session->flashdata('error'); ?>
	                        </span>
	                    </div>
                    <?php endif; ?>
	                <!--// display flash data message-->
	              	<div class="panel-body">
	              		<form action="<?=base_url('admin/subscribers/send_bulk_email'); ?>" method="post"  autocomplete="off">
		              		<div class="row">
			              		<div class="form-group">
			                        <label class="control-label col-md-12">Subject of Email</label>
			                        <div class="col-md-12">
			                            <input name="subject" placeholder="Subject of Email" class="form-control" type="text" required>
			                        </div>
			                    </div>
			                    <div class="form-group">
	                            	<label class="control-label col-md-12">Message</label>
	                            	<div class="col-md-12">
	                            		<textarea id="content" name="content" class="form-control" placeholder="Type your Message" required></textarea>
						                <script>
						                    CKEDITOR.replace('content');
						                </script>
	                            	</div>
	                            </div>
			                </div>
		               		<div class="table-responsive">
		               			<table id="table" class="table table-striped table-bordered table-hover" width="100%">
		               				<thead>
		               					<tr>
		               						<th class="text-center"><input type="checkbox" id="check-all"></th>
		               						<th>S.No</th>
		               						<th>Email</th>
		               						<th>Subscribed Date</th>
		               						<th>Status</th>
		               						<th>Message</th>
		               						<!-- <th class="text-center">Action</th> -->
		               					</tr>
		               				</thead>
		               				<tbody>
		               					
		               				</tbody>
		               			</table>
		               		</div><br>
		               		<div class="row">
		               			<p style="margin-left: 20px;">Please select alteast one email from the above table to send Join Newsletter emails</p><br>
			               		<div class="form-group">
			                        <div class="col-md-12">
			                        	<button type="submit" name="add" class="btn btn-info btn-md">
			                        	Send Message</button>
			                        </div>
			                    </div>
			                </div>
			            </form>
	              	</div>
	            </section>
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
	                    <form action="#" id="viewform">
	                    	<div class="row mt-3">
		                        <div class="col-md-12">
		                            <div class="form-group">
		                                <label class="control-label col-md-12">Subscriber Email Address</label>
		                                <div class="col-md-12">
		                                    <input name="view_email" class="form-control" type="text" readonly placeholder="Subscriber Email Address">
		                                    <span class="help-block text-danger"></span>
		                                </div>
		                            </div>
		                        </div>
		                        <div class="col-md-12">
		                            <div class="form-group">
		                                <label class="control-label col-md-12">Subscriber Date</label>
		                                <div class="col-md-12">
		                                    <input name="view_date" class="form-control" type="text" readonly placeholder="Subscriber Date">
		                                    <span class="help-block text-danger"></span>
		                                </div>
		                            </div>
		                        </div>
		                        <div class="col-md-12">
		                            <div class="form-group">
		                                <label class="control-label col-md-12">Subscriber Status</label>
		                                <div class="col-md-12">
		                                    <input name="view_status" class="form-control" type="text" readonly placeholder="Subscriber Status">
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
		    	$('#emailNav').addClass('active');
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
		                    text: '<i class="fa fa-trash"></i> Bulk Delete',
		                    className: "btn btn-danger",
		                    titleAttr: 'Bulk Delete',
		                    action: function () {
		                        bulk_delete();
		                    }
		                },
		                {
		                    text: '<i class="fa fa-eraser"></i> Reset Sent Message',
		                    className: "btn btn-info",
		                    titleAttr: 'Reset Sent Message',
		                    action: function () {
		                        reset_send();
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
		                    filename: 'Email Subscribers Information',
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
		                    filename: 'Email Subscribers Information',
		                    extension: '.csv',
		                    exportOptions: {
		                        columns: [1,2,3,4,5]
		                    },
		                },
		                {
		                    extend: 'print',
		                    title: "<h3 class='text-center'><?=$this->systemdata->sname; ?></h3><h4 class='text-center'>Email Subscribers Information</h4><h5 class='text-center'>Printed On <?php echo date('l, d F, Y'); ?></h5>",
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
		                    filename: 'Email Subscribers Information'
		                },
		            ],
		            responsive: true,
		            // Load data for the table's content from an Ajax source
		            "ajax": {
		                "url": "<?php echo base_url('admin/subscribers/generate_subscribers');?>",
		                "type": "POST"
		            },

		            //Set column definition initialisation properties.
		            "columnDefs": [
		                {"targets": [0], "orderable": false},{"targets": [1], "orderable": false},
		                {"targets": [5], "orderable": false},
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

		    function view_email(id){
		    	//Ajax Load data from ajax
		        $.ajax({
		            url: "<?php echo base_url('admin/subscribers/get_records_by_id') ?>/" + id,
		            type: "GET",
		            dataType: "JSON",
		            success: function (data){
		                $('[name="view_email"]').val(data.email);
		                $('[name="view_date"]').val(data.subscribe_date);
		                $('[name="view_status"]').val(data.status);
		                $('#view_modal_form').modal('show');
		                $('.modal-title').text("View " +data.email+ " Records"); 
		            },
		            error: function (jqXHR, textStatus, errorThrown)
		            {
		                swal("Error Occured!", "Subscriber Records couldnot be viewed Now!", "error");
		            }
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
		                        url: "<?php echo site_url('admin/subscribers/bulk_email_delete') ?>",
		                        dataType: "JSON",
		                        success: function (data)
		                        {
		                            if (data.status)
		                            {
		                                swal("Email Subscription Deleted!", "Selected Email Records deleted successfully!", "success");
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
		                    swal("Cancelled!", "Selected Email Records are NOT deleted!", "error");
		                }
		            });
		        } else
		        {
		            swal("Sorry!", "Atleast select one record to complete this process!", "error");
		        }
		    }

		    function reset_send(){
		        var list_id = [];
		        $(".data-check:checked").each(function () {
		            list_id.push(this.value);
		        });
		        if (list_id.length > 0)
		        {
		            swal({
		                title: 'Are you sure, reset ' + list_id.length + ' record(s)?',
		                text: "You will be able to reset the selected record(s)!",
		                type: "warning",
		                showCancelButton: true,
		                confirmButtonClass: "btn-primary",
		                confirmButtonText: "Yes, reset",
		                cancelButtonText: "No, cancel",
		                closeOnConfirm: false,
		                closeOnCancel: false
		            },
		            function (isConfirm) {
		                if (isConfirm) {
		                    $.ajax({
		                        type: "POST",
		                        data: {id: list_id},
		                        url: "<?php echo site_url('admin/subscribers/reset_sent_email') ?>",
		                        dataType: "JSON",
		                        success: function (data)
		                        {
		                            if (data.status)
		                            {
		                                swal("Email Sent Message Reset!", "Selected Sent Email Records reset successfully!", "success");
		                                //if success reload ajax table
		                                reload_table();
		                            } else
		                            {
		                               swal("Access Denied!", "You're not Authorized to reset Sent Email Record!", "error");
		                            }
		                        },
		                        error: function (jqXHR, textStatus, errorThrown)
		                        {
		                            swal("Error Occured!", "Sorry, An error has Occured. Please Try Again!", "error");
		                        }
		                    });
		                } else {
		                    swal("Cancelled!", "Selected Sent Email Records are NOT Reset!", "error");
		                }
		            });
		        } else
		        {
		            swal("Sorry!", "Atleast select one record to complete this process!", "error");
		        }
		    }
		</script>