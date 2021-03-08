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
			                <h1 class="text-infos py-4 pl-3tea py-2">
			                	<a class="btn btn-default btn-sm pull-right" href="<?=base_url('admin/blogs/blog'); ?>">Go Back</a>
			                </h1>
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
	              		<form action="<?=base_url('admin/blogs/update_blog/'.$blog_id); ?>" method="post" autocomplete="off" enctype="multipart/form-data">
		              		<div class="row">
			              		<div class="form-group">
			                        <label class="control-label col-md-12">Blog Title Name</label>
			                        <div class="col-md-12">
			                            <input name="subject" placeholder="Blog Title Name" class="form-control" type="text" required value="<?=$blogRow->blog_title; ?>">
			                        </div>
			                    </div>
			                    <div class="form-group">
	                            	<label class="control-label col-md-12">Blog Content</label>
	                            	<div class="col-md-12">
	                            		<textarea id="content" name="content" class="form-control" placeholder="Type your Blog Content" required><?=$blogRow->blog_content; ?></textarea>
						                <script>
						                    CKEDITOR.replace('content');
						                </script>
	                            	</div>
	                            </div><br>
	                            <div class="form-group">
			                        <label class="control-label col-md-12">Blog Image</label>
			                        <div class="col-md-12">
			                        	<?php if (empty($blogRow->blog_file)) : ?>
			                            	<img src="<?=base_url('uploads/users/nophoto.jpg'); ?>" class="img-responsive thumbnail">
			                            <?php else : ?>
			                            	<img src="<?=base_url('uploads/blogs/'.$blogRow->blog_file); ?>" class="img-responsive thumbnail">
			                            <?php endif; ?>
			                        </div>
			                    </div>
			                    <div class="form-group">
			                        <label class="control-label col-md-12">Change Blog Image (<span class="text-danger">800*600</span>)</label>
			                        <div class="col-md-12">
			                            <input name="file" placeholder="Change Blog Image" class="form-control" type="file">
			                        </div>
			                    </div>
			                    <div class="form-group">
			                        <label class="control-label col-md-12">Blog Created By</label>
			                        <div class="col-md-12">
			                            <input name="created_by" placeholder="Blog Created By" class="form-control" type="text" required value="Admin" value="<?=$blogRow->created_by; ?>">
			                        </div>
			                    </div>
	                            <div class="form-group">
			                        <div class="col-md-12">
			                        	<button type="submit" class="btn btn-info btn-md">
			                        	Update Blog</button>
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