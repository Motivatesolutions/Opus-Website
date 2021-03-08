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
		            	<?php if ($topic_id == 0) : ?>
			                <h1 class="text-infos py-4 pl-3tea py-2"><?='Create New Blog for '.
			                	ucwords(strtolower($groupName));?>
			                	<a class="btn btn-default btn-sm pull-right" href="<?=base_url('admin/modules/blogs/'.$group_id.'/'.url_title(strtolower($groupName), 'dash', true)); ?>">Go Back</a>
			                </h1>
			            <?php else: ?>
			            	<h1 class="text-infos py-4 pl-3tea py-2"><?='Create New Blog for '.
			                	ucwords(strtolower($topicName));?>
			                	<a class="btn btn-default btn-sm pull-right" href="<?=base_url('admin/modules/challengesblogs/'.$topic_id.'/'.url_title(strtolower($groupName), 'dash', true).'/'.url_title(strtolower($topicName), 'dash', true)); ?>">Go Back</a>
			                </h1>
			            <?php endif; ?>
		            </header>
		            <!-- display flash data message-->
                    <?php if($this->session->flashdata('success')): ?>
                    	<div class="panel-body">
	                        <span style="color: green;font-family:'Coda';font-size:16px;" class="text-center" id="ers">
	                            <?php echo $this->session->flashdata('success'); ?>
	                        </span>
	                    </div>
                    <?php elseif($this->session->flashdata('error')): ?>
                    	<div class="panel-body">
	                        <span style="color: red; font-family: 'Coda';">
	                            <?php echo $this->session->flashdata('error'); ?>
	                        </span>
	                    </div>
                    <?php endif; ?>
	                <!--// display flash data message-->
	              	<div class="panel-body">
	              		<form action="<?=base_url('admin/blogs/create_new_blog/'.$role.'/'.$group_id.'/'.$topic_id); ?>" method="post" autocomplete="off" enctype="multipart/form-data">
		              		<div class="row">
			              		<div class="form-group">
			                        <label class="control-label col-md-12">Blog Title Name</label>
			                        <div class="col-md-12">
			                            <input name="subject" placeholder="Blog Title Name" class="form-control" type="text" required>
			                        </div>
			                    </div>
			                    <div class="form-group">
	                            	<label class="control-label col-md-12">Blog Content</label>
	                            	<div class="col-md-12">
	                            		<textarea id="content" name="content" class="form-control" placeholder="Type your Blog Content" required></textarea>
						                <script>
						                    CKEDITOR.replace('content');
						                </script>
	                            	</div>
	                            </div>
	                            <div class="form-group">
			                        <label class="control-label col-md-12">Blog Image(<span class="text-danger">800*600</span>)</label>
			                        <div class="col-md-12">
			                            <input name="file" placeholder="Blog Image" class="form-control" type="file" required>
			                        </div>
			                    </div>
			                    <div class="form-group">
			                        <label class="control-label col-md-12">Blog Created By</label>
			                        <div class="col-md-12">
			                            <input name="created_by" placeholder="Blog Created By" class="form-control" type="text" required value="Admin">
			                        </div>
			                    </div>
	                            <div class="form-group">
			                        <div class="col-md-12">
			                        	<button type="submit" name="add" class="btn btn-info btn-md">
			                        	Create New Blog</button>
			                        </div>
			                    </div>
			                </div>
			            </form>
	              	</div>
	            </section>
          	</div>
        </div>
	    <script type="text/javascript">
		    var base_url = '<?php echo base_url(); ?>';
		    $(document).ready(function (){
		    	$('#moduleNav').addClass('active');
		    });
		</script>