
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
        	<div class="col-lg-4 col-md-3 col-sm-12 col-xs-12">
        		<img src="<?= base_url('assets/img/portfolio/portfolio-2.jpg'); ?>" class="img-fluid" id="img-fluid">
        		<p class="text-dark" style="padding-top: 10px;" id="p">Kampala Casual Drink Group</p>
        		<span class="lefttext-left" id="span"><i class="fa fa-group"></i> 400 members</span>
        		<p class="text-left" style="padding-top: 10px;">Next Activity TBD</p>
        	</div>
        	<div class="col-lg-4 col-md-3 col-sm-12 col-xs-12">
        		<img src="<?= base_url('assets/img/portfolio/portfolio-4.jpg'); ?>" class="img-fluid" id="img-fluid">
        		<p class="text-left" style="padding-top: 10px;" id="p">Kampala Casual Drink Group</p>
        		<span class="text-dark" id="span"><i class="fa fa-group"></i> 146 members</span>
        		<p class="text-left" style="padding-top: 10px;">Next Activity TBD</p>
        	</div>
        	<div class="col-lg-4 col-md-3 col-sm-12 col-xs-12">
        		<img src="<?= base_url('assets/img/portfolio/portfolio-5.jpg');?>" class="img-fluid" id="img-fluid">
        		<p class="text-left" style="padding-top: 10px;" id="p">Kampala Casual Drink Group</p>
        		<span class="text-dark" id="span"><i class="fa fa-group"></i> 300 members</span>
        		<p class="text-left" style="padding-top: 10px;">Next Activity TBD</p>
        	</div>
        	<div class="text-center">
        		<button class="btn btn-big btn-outline text-info text-center" id="btn">SHOW ALL GROUPS</button>
        	</div>
        	<br><br>
        </div>