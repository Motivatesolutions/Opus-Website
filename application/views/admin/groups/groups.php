
<style type="text/css">
	#login-img3-body{
		background-image: url(<?=base_url('assets/images/image-two.jpg')?>);
		background-attachment: fixed;
		background-repeat: no-repeat;
		background-position-x:center;
		background-position-y:center;
		background-size:auto;
		background-origin:padding-box;
		background-clip:border-box;
		background-color: transparent;
		height: 400px;
	}
	.breadcrumb {
	    -webkit-border-radius: 0px;
	    -moz-border-radius: 0px;
	    border-radius: 0px;
	    height: auto;
	    position: relative;
	    margin: 0 0 19px 0;
	    overflow: hidden;
	}
	.blue-bg {
	    color: #fff;
	    border-radius: 5px;
	    height: 200px;
	    background-color: #02374c;
	}
	.brown-bg {
	    color: #fff;
	    border-radius: 5px;
	    height: 200px;
	    background-color: #1265a7;
	}
	.green-bg {
	    color: #fff;
	    border-radius: 5px;
	    height: 200px;
	    background-color: #0879d4;
	}
	.login-form {
	    max-width: 750px;
	    margin: 10px auto 0;
	    border-radius: 5px;
	    background: none;
	}
	.login-form a:hover {
	    color: #eff7f6 !important;
	}
	.btn-default {
	    color: #2b2b2b;
	    background-color: #ffffff;
	    border-color: #c7c7cc;
	    width: 200px;
	    padding: 10px;
	    border-radius: 20px;
	    margin-top: -25px;
	}
	.dropdown-menu.extended li a:hover {
	    background-color: #F7F8F9 !important;
	    color: #fff !important;
	    border-bottom: 1px solid #688a7e !important;
	}
	#img-fluid{
		width: 320px;
		height: 250px;
		border-radius: 10px;
	}
	#btn{
		background: none;
	    border: 1px solid #e6dfdfde;
	    margin-top: 10px;
	    color: #058c9a;
	    text-decoration: solid;
	}
	#p{
		font-size: 18px;
	}
	#p,p, #span{
		font-family: code;
		color: #aaa;
	}

</style>
<section id="main-content" style="font-family: 'Coda';" id="">
	<section class="wrapper">
		<br><br>
		<div class="container wrapper" id="login-img3-body">
			<form class="login-form" action="#">
		      <div class="login-wrap" >
		        <div class="input-group">
		          <span class="input-group-addon"><i class="icon_search"></i></span>
		          <input type="text" class="form-control" placeholder="Search" autofocus>
		        </div>
		      </div>
		    </form>
		</div>
        <div class="row breadcrumb">
        	<div class="text-center title" style="font-size: 30px;">Popular Groups</div>
        	<hr>
        	<?php if (count($groupResults) > 0) :
        		foreach ($groupResults as $grow) : 
        			$condition = array('group_id' => $grow['group_id'],'status'=>'joined');
        			$gmembers = $this->group->count_all_group_members($condition);
        			$checku = array('group_id'=>$grow['group_id'],'status'=>'joined',
        			'user_id'=>$this->userdata['id']);
        			$checkgU = $this->group->count_all_group_members($checku);
        			?>
	        		<div class="col-lg-4 col-md-3 col-sm-12 col-xs-12">
	        			<?php if (!$checkgU == 0 || $this->userdata['role'] == 1 || $this->userdata['role'] == 5) : ?>
	        				<a href="<?=base_url('parent/modules/content/'.$grow['group_id'].'/'.url_title(strtolower($grow['group_name']), 'dash', true));?>">
				        		<img src="<?=base_url('uploads/groups/'.$grow['image']); ?>" class="img-fluid" id="img-fluid">
				        		<p class="text-dark" style="padding-top: 10px;" id="p"><?=ucwords(strtolower($grow['group_name']));?></p>
				        	</a>
				        	<span class="lefttext-left" id="span"><i class="fa fa-group"></i> 
				        			<?=$gmembers.' member(s)';?></span>
				        	<?php else: ?>
				        		<img src="<?=base_url('uploads/groups/'.$grow['image']); ?>" class="img-fluid" id="img-fluid">
				        		<p class="text-dark" style="padding-top: 10px;" id="p"><?=ucwords(strtolower($grow['group_name']));?></p>
				        		<span class="lefttext-left" id="span"><i class="fa fa-group"></i> 
				        			<?=$gmembers.' member(s)';?></span>
			        	<?php endif;?>
		        		<?php if ($this->userdata['role'] == 3): 
		        			if ($checkgU == 0) : ?>
				        		<form action="#" id="form">
				        			<input type="hidden" name="group_id" value="<?=$grow['group_id']; ?>">
				        			<input type="hidden" name="user_id" value="<?=$this->userdata['id']; ?>">
				        			<p class="text-center" style="padding-top: 10px;"><button type="button" id="btnJoin" onclick="save_group()" class="btn btn-info btn-block">Join</button></p>
				        		</form>
				        		<?php else: ?>
				        			<p class="text-center" style="padding-top: 10px;"><button type="button" id="btnJoin"class="btn btn-primary btn-block btn-outline">You've Joined</button></p>
				        	<?php endif;?>
			        	<?php endif;?>
		        	</div>
		        <?php endforeach; ?>
		      	<br><br><br>
		    <?php else: ?>
        		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        			<h4 class="text-danger">No Group(s) Available at this moment!</h4>
        		</div>
	        <?php endif; ?>
        </div>

        <script type="text/javascript">
        	var base_url = '<?php echo base_url(); ?>';
        	function save_group(){
		        $('#btnJoin').text('joining...');
		        $('#btnJoin').attr('disabled', true);
		        var url;
		       	url = "<?php echo base_url('parent/modules/join_group') ?>";
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
		                if (data.status){
		                    swal("Group Join Successful!", "You has Joined the Group Successfully!", "success");
		                    setInterval(function() {
	                          window.location.reload();
	                        }, 3100);
		                }
		                $('#btnJoin').text('Join');
		                $('#btnJoin').attr('disabled', false);
		            },
		            error: function (jqXHR, textStatus, errorThrown)
		            {
		                swal("Error Occured!", "You couldn't Join the Group at this moment. Try Again!", "error");
		                $('#btnJoin').text('Join'); //change button text
		                $('#btnJoin').attr('disabled', false);
		            }
		        });
		    }
        </script>