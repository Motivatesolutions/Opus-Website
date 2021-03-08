
<style type="text/css">
	#login-img3-body{
		background-image: url(<?=base_url('uploads/blogs/'.$blogRow->blog_file)?>);
		background-attachment: fixed;
		background-repeat: no-repeat;
		background-position-x:center;
		background-position-y:center;
		background-size:auto;
		background-origin:padding-box;
		background-clip:border-box;
		background-color: transparent;
		height: 400px;
		width: 100%;
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
	.rown-bg {
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
			<a class="btn btn-info btn-sm pull-right" href="<?=base_url('parent/modules/content/'.$group_id.'/'.url_title(strtolower($groupName), 'dash', true)); ?>">Go Back</a>
		</div>
		<div class="row breadcrumb">
        	<div class="text-center title" style="font-size: 30px;">
        		<?=ucwords(strtolower($blogRow->blog_title)); ?>
        	</div>
        	<hr>
        	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        		<?=$blogRow->blog_content; ?>
        	</div>
        	<br><br>
        </div>

        <div class="row breadcrumb">
        	<div class="text-center title" style="font-size: 30px;">Popular Blogs</div>
        	<hr>
        	<?php if (count($blogResults) > 0) :
        		foreach ($blogResults as $row) : ?>
        			<div class="col-lg-4 col-md-3 col-sm-12 col-xs-12">
		        		<a href="<?=base_url('parent/modules/blog/'.$row['blog_id'].'/'.url_title(strtolower($groupName), 'dash', true).'/'.url_title(strtolower($row['blog_title']), 'dash', true));?>">
			        		<img src="<?=base_url('uploads/blogs/'.$row['blog_file']); ?>" class="img-fluid" id="img-fluid">
			        		<p class="text-dark" style="padding-top: 10px;" id="p">
			        			<?=ucwords(strtolower($row['blog_title']));?></p>
			        	</a>
			        	<!-- <p class="text-left" style="padding-top: 10px;"><?=$row['blog_content'];?></p> -->
		        	</div>
        		<?php endforeach; ?>
        	<?php else: ?>
        		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        			<h4 class="text-danger"><?='No Blog(s) Available for '.ucwords(strtolower($groupName)).' at this moment!'; ?></h4>
        		</div>
        	<?php endif; ?>
        </div>