<section id="main-content">
	<section class="wrapper">
		<br><br><br><br>
		<div class="row">
			<div class="col-lg-12">
				<section class="panel">
					<header class="panel-heading">
						<h1 class="text-infos py-4  pl-3tea py-2">Opus Music Subcription Information</h1> 
					</header>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12" >
                                <form action="#" id="setttings_form">
                                    <div class="row">
					                    <div class="col-md-4">
					                        <div class="form-group">
					                            <label class="control-label col-md-12">Email Address</label>
					                            <div class="col-md-12">
					                                <input name="email" placeholder="Email Address" class="form-control" type="email">
					                                <span class="help-block text-danger"></span>
					                            </div>
					                        </div>
					                    </div>
					                    <div class="col-md-4">
					                        <div class="form-group">
					                            <label class="control-label col-md-12">Amount Paid</label>
					                            <div class="col-md-12">
					                                <input name="amount" placeholder="Amount Paid" class="form-control" type="number" min="0">
					                                <span class="help-block text-danger"></span>
					                            </div>
					                        </div>
					                    </div>
					                    <div class="col-md-4">
					                        <div class="form-group">
					                            <label class="control-label col-md-12">Subscription Date</label>
					                            <div class="col-md-12">
					                                <input name="sdate" placeholder="Date" class="form-control" type="date">
					                                <span class="help-block text-danger"></span>
					                            </div>
					                        </div>
					                    </div>
					                </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <button type="button" id="subscribe" onclick="subscribe_now()" class="btn btn-primary">Subcribe</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6"></div>
                                    </div>
                                </form>
                            </div>
                        </div>
	                </div>
				</section>
			</div>
		</div>
		<script type="text/javascript">
		    $(document).ready(function() {
		        $("input").change(function () {
		            $(this).parent().parent().removeClass('has-error');
		            $(this).next().empty();
		        });

		        $("select").change(function () {
		            $(this).parent().parent().removeClass('has-error');
		            $(this).next().empty();
		        });
		    });

		    function subscribe_now(){
		        $('#subscribe').text('subcribing...'); //change button text
		        $('#subscribe').attr('disabled', true); //set button disable 
		        var url;
		            url = "<?php echo base_url('admin/dashboard/system_subscription') ?>";

		        var formData = new FormData($('#setttings_form')[0]);
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
		                    swal("System Subscription!", "System Subscription has been done Successfully!", "success");
		                    //window.location.reload();
		                    setInterval(function() {
		                      window.location.reload();
		                    }, 3100);
		                } else if (data === "access_denied") {
		                    swal("Access Denied!", "You're not Authorized to make any Subscription!", "error");       
		                }else if (data === "incorrect_email") {
		                    swal("Wrong Email!","Please, enter a correct Email Address!","error");
		                } else
		                {
		                    for (var i = 0; i < data.inputerror.length; i++)
		                    {
		                        $('[name="' + data.inputerror[i] + '"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
		                        $('[name="' + data.inputerror[i] + '"]').next().text(data.error_string[i]); //select span help-block class set text error string
		                    }
		                }
		                $('#subscribe').text('Subcribe'); //change button text
		                $('#subscribe').attr('disabled', false); //set button enable 
		            },
		            error: function (jqXHR, textStatus, errorThrown)
		            {
		                swal("Error Occured!", "Sorry, an error has occured. Try again!", "error");
		                $('#subscribe').text('Subcribe'); //change button text
		                $('#subscribe').attr('disabled', false); //set button enable 

		            }
		        });
		    }
		    $('#settingsNav').addClass('active');
		</script>