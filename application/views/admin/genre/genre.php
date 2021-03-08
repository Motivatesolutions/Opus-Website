<section id="main-content">
	<section class="wrapper">
		<br><br><br><br>
		<div class="row">
          	<div class="col-lg-12" >
	            <section class="panel">
		            <header class="panel-heading bg-info">
		                <h1 class="text-infos py-4 pl-3tea py-2">Genre Information</h1> 
		            </header>
	              	<div class="panel-body">
	               		<div class="table-responsive">
	               		   <table id="table" class="table table-striped table-bordered table-hover" 
	               		       width="100%">
	               				<thead>
	               					<tr>
	               						<!-- <th class="text-center"><input type="checkbox" id="check-all"></th> -->
                                        <th>S.No</th>
                                        <th>Genre Name</th>
                                        <th>Genre Type</th>
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
         <!-- Add & update pop up modal  -->
	    <div id="modal_form" class="modal fade" role="dialog">
	        <div class="modal-dialog">
	            <div class="modal-content">
	                <div class="modal-header">
	                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">&times;</button>
	                    <h3 class="modal-title text-primary"></h3>
	                </div>
	                <div class="modal-body card-body bg-teal">
	                    <form action="#" id="form">
	                    	<input type="hidden" name="genreid">
	                    	<div class="row mt-3">
		                        <div class="col-md-12">
		                        	<div class="form-group">
		                                <label class="control-label col-md-12">genre Name</label>
		                                <div class="col-md-12">
                                            <input type="text" name="genre_name" class="form-control"
                                             placeholder="genre name">
		                                    <span class="help-block text-danger"></span>
		                                </div>
		                            </div>
		                        </div>
		                    </div>
	                    </form>
	                </div>
	                <div class="modal-footer card-footer">
	                    <div class="form-data mt-2 d-flex">
	                       <button type="button" id="btnSave" onclick="save_genre()" class="btn btn-primary"></button>
	                       <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
	                    </div>
	                </div>
	            </div>
	        </div>
        </div>
        <!-- view modal-->
        <div id="view_modal_form" class="modal fade" role="dialog">
	        <div class="modal-dialog">
	            <div class="modal-content" style="font-family: 'Coda';">
	                <div class="modal-header">
	                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">&times;</button>
	                    <h3 class="modal-title text-primary"></h3>
	                </div>
	                <div class="modal-body card-body bg-teal">
	                    <form action="#" id="form">
	                    	<input type="hidden" name="class_id">
	                    	<div class="row mt-3">
		                        <div class="col-md-12">
		                            <div class="form-group">
		                                <label class="control-label col-md-12">genre Name</label>
		                                <div class="col-md-12">
                                            <input type="text" name="view_genre_name" class="form-control" readonly>
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
		                    titleAttr: 'Add New Genre',
		                    action: function () {
		                        add_genre();
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
		                    filename: 'Genre Information',
		                    extension: '.xlsx',
		                    exportOptions: {
		                        columns: [0,1,2,3]
		                    },
		                },
		                {
		                    extend: 'csv',
		                    className: 'btn btn-primary',
		                    titleAttr: 'Export CSV Data',
		                    text: '<i class="fa fa-bars"></i>',
		                    filename: 'Genre Information',
		                    extension: '.csv',
		                    exportOptions: {
		                        columns: [0,1,2,3]
		                    },
		                },
		                {
		                    extend: 'print',
		                    title: "<h3 class='text-center'><?=$this->systemdata->sname; ?></h3>"+
							" <h4 class='text-center'>Genre Information</h4>"+
							" <h5 class='text-center'>Printed On <?php echo date('l, d F, Y'); ?></h5>",
		                    exportOptions: {
		                        columns: [0,1,2,3]
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
		                    filename: 'Genre Information'
		                },
		            ],
		            responsive: true,
		            // Load data for the table's content from an Ajax source
		            "ajax": {
		                "url": "<?php echo base_url('admin/genre/generate_genre');?>",
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

		    function add_genre(){
		        save_method = 'add';
		        $('#form')[0].reset(); // reset form on modals
		        $('.form-group').removeClass('has-error'); // clear error rolerole
		        $('.help-block').empty(); // clear error string
		        $('#modal_form').modal('show'); // show bootstrap modal
		        $('.modal-title').text('Add New Genre'); 
		        $('#btnSave').text('Add');
		    }

		    function save_genre(){
		        if (save_method == 'add') {
		            $('#btnSave').text('adding...');
		        }else{
		            $('#btnSave').text('updating...');
		        }
		       
		        $('#btnSave').attr('disabled', true); //set button disable 
		        var url;
		        if (save_method == 'add') {
		            url = "<?php echo base_url('admin/genre/add_new_genre')?>";
		        } else {
		            url = "<?php echo base_url('admin/genre/update_genre_records')?>";
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
		                        swal("Genre Added!", "New genre has been added Successfully!", "success");
		                    } else {
		                        swal("Genre Updated!", "genre Records Updated Successfully!", "success");
		                    }
		                }else if(data === 'genre_name_exist'){

		                    swal("Sorry, genre Name Exist!", "genre Name already added!", "error");

		                }else if (data === "access_denied") {
		                    if (save_method == 'add'){
		                        swal("Access Denied!", "You're not Authorized to create any new genre!", "error");
		                    } else {
		                        swal("Access Denied!", "You're not Authorized to update any genre!", "error");
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
		                    swal("Error Occured!", "New Setion Records couldn't be Added!", "error");
		                    $('#btnSave').text('Add'); //change button text
		                    $('#btnSave').attr('disabled', false); //set button enable  
		                }else{
		                    swal("Error Occured!", "Setion Records couldn't be Update!", "error");
		                    $('#btnSave').text('Update'); //change button text
		                    $('#btnSave').attr('disabled', false); //set button enable  
		                }
		            }
		        });
		    }

		    function update_genre(id) {
		        save_method = 'update';
		        $('#form')[0].reset(); // reset form on modals
		        $('.form-group').removeClass('has-error'); // clear error Class
		        $('.help-block').empty(); // clear error string
		        //Ajax Load data from ajax
		        $.ajax({
		             url: "<?php echo base_url('admin/genre/get_records_by_genre_id') ?>/" +id,
		             type: "GET",
		             dataType: "JSON",
		             success: function (data){
		                $('[name="genreid"]').val(data.genre_id);
                        $('[name="genre_name"]').val(data.genre_name);
		                $('#modal_form').modal('show'); 
		                $('.modal-title').text("Update " +data.genre_name+ " Records"); 
		                $('#btnSave').text('Update');
		            },
		            error: function (jqXHR, textStatus, errorThrown)
		            {
		                swal("Error Occured!", "Role Record couldnot be displayed Now!", "error");
		            }
		        });
		    }

		    function view_genre(genre_id){
		    	//Ajax Load data from ajax
		        $.ajax({
		            url: "<?php echo base_url('admin/genre/get_records_by_genre_id') ?>/" + genre_id,
		            type: "GET",
		            dataType: "JSON",
		            success: function (data){
						$('[name="view_genre_name"]').val(data.genre_name);
		                $('#view_modal_form').modal('show');
		                $('.modal-title').text("View " +data.genre_name+ " Records"); 
		            },
		            error: function (jqXHR, textStatus, errorThrown)
		            {
		                swal("Error Occured!", "Role Records couldnot be viewed Now!", "error");
		            }
		        });
		    }


		    function delete_genre(genre_id,genre_name){
		        swal({
		            title: "Are you sure?",
		            text: "Your will not be able to recover "+genre_name+" Records!",
		            type: "warning",
		            showCancelButton: true,
		            confirmButtonClass: "btn-danger",
		            confirmButtonText: "Yes, delete!",
		            cancelButtonText: "No, cancel",
		            closeOnConfirm: false
		        },
		        function(){
		            $.ajax({
		                url: "<?php echo base_url('admin/genre/delete_genre_record') ?>/" + genre_id,
		                type: "POST",
		                dataType: "JSON",
		                success: function (data){
		                    if (data.status) {
		                        swal("genre Deleted!", genre_name+" Records deleted successfully!", "success");
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
		                        data: {genre_id: list_id},
		                        url: "<?php echo site_url('admin/genre/bulk_genre_delete') ?>",
		                        dataType: "JSON",
		                        success: function (data)
		                        {
		                            if (data.status)
		                            {
		                                swal("genre Deleted!", "Selected genre Records deleted successfully!", "success");
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
		                    swal("Cancelled!", "Selected genre Records is safe!", "error");
		                }
		            });
		        } else
		        {
		            swal("Sorry!", "Atleast select one record to complete this process!", "error");
		        }
		    }
		</script>