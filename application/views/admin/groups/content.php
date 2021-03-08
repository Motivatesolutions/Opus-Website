
<style type="text/css">
	#login-img3-body{
		background-image: url(<?=base_url('uploads/groups/'.$groupFile)?>);
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

	@media (min-width: 520px){
	    #img-fluid {
	      	width: 320px;
	      	height: 300px;
	      	margin: 5px;
	      	overflow: hidden;
	      	justify-content: center;
	      	text-align: center;
	    }
	    #bottom-right{
	      	padding: 14px; 
	    } 
	}

	#bottom-right{
    border-right: 2px solid lightgrey;
    line-height: 20px;
    padding: 10px;
    margin-bottom: 5px;  
  }
  #link{
    color: #1bd0b3ed;
  }
  #yrs{
    color: #1bd0b3ed;
  }
  #fa-user{
    color: #000;
    font-size: 30px;
  }
  #fa-question{
    color: #1bd0b3ed;
    font-size: 38px;
    margin: 0;
  }
  /* image banner*/
  .main-banner{
    margin-top: 0px;
    margin-bottom: 2px;
    width: 8000px;
    height: 430px;
    background-color: #fff;
    overflow: hidden;
    position: relative;
  }

  .main-banner .imgban{
    width: 80%;
    height: 100%;
    position: absolute;
    top: 0px;
    transition: all ease-in-out 500ms;
    -webkit-transition: all ease-in-out 500ms;
    -moz-transition: all ease-in-out 500ms;
    -o-transition: all ease-in-out 500ms;
  }
  /*first image*/
  .main-banner #imgban2{
   
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
  }
  /*second image*/
  .main-banner #imgban1{
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
  }

</style>
<section id="main-content" style="font-family: 'Coda';" id="">
	<section class="wrapper">
		<br><br>
		<div class="container wrapper" id="login-img3-body">
			<a class="btn btn-info btn-sm pull-right" href="<?=base_url('parent/modules/groups'); ?>">Go Back</a>
			<form class="login-form" action="#">
		      <div class="login-wrap" >
		        <div class="input-group">
		          <span class="input-group-addon"><i class="icon_search"></i></span>
		          <input type="text" class="form-control" placeholder="Search" autofocus>
		        </div>
		      </div>
		    </form>
		</div>
		<h3>MCQ Series</h3>
		<!--carousel start-->
	    <div id="c-slide" class="carousel slide auto panel- breadcrumb">
		    <ol class="carousel-indicators out">
		        <li class="active" data-slide-to="0" data-target="#c-slide"></li>
		        <li class="" data-slide-to="1" data-target="#c-slide"></li>
		        <li class="" data-slide-to="2" data-target="#c-slide"></li>
		    </ol>
      		<div class="carousel-inner">
        		<div class="item text-center active">
          			<div class="col-lg-6 col-md-10 col-sm-12 col-xs-12 text-left">
            			<span class="h3">Communication</span>
          			</div>
          			<div class="col-lg-6 col-md-3 col-sm-12 col-xs-12">
            			<span id="yrs"><i class="fa fa-user" id="fa-user"></i>  3-7 yrs</span>
          			</div><br>
          			<div class="col-lg-3 col-md-10 col-sm-12 col-xs-12"></div>
          			<div class="col-lg-1 col-md-10 col-sm-12 col-xs-12 text-center">
            			<i class="fa fa-question-circle" id="fa-question"></i>
            			<span id="bottom-right"></span>
          			</div> 
          			<div class="col-lg-4 col-md-10 col-sm-12 col-xs-12">
           				<span class="text-center">
              				Your family is dining togetherat the table. <br> You place a bowl full of celeal in front of your child. Even after many
           				</span><br>
            			<button class="btn btn-big btn-outline text-info text-center btnShow" id="btn">Participate Now</button>
          			</div> 
          			<div class="col-lg-4 col-md-10 col-sm-12 col-xs-12"></div>        
        		</div>
        		<!-- side-2 -->
        		<div class="item text-center">
          			<div class="col-lg-6 col-md-10 col-sm-12 col-xs-12 text-left">
            			<span class="h3">Performance</span>
          			</div><br>
          			<div class="col-lg-6 col-md-10 col-sm-12 col-xs-12">
            			<span id="yrs"><i class="fa fa-user" id="fa-user"></i>  3-7 yrs</span>
          			</div>
          			<div class="col-lg-3 col-md-10 col-sm-12 col-xs-12"></div>
          			<div class="col-lg-1 col-md-10 col-sm-12 col-xs-12 text-center">
            			<i class="fa fa-question-circle" id="fa-question"></i>
            			<span id="bottom-right"></span>
          			</div> 
          			<div class="col-lg-4 col-md-10 col-sm-12 col-xs-12">
            			<span class="text-center">
              				You nudge your child to wake up and ask him/her to get ready <br>for school.You cook the fare for tiffin and walk to
            			</span><br>
            			<button class="btn btn-big btn-outline text-info text-center btnShow" id="btn">Participate Now</button>
          			</div> 
          			<div class="col-lg-4 col-md-10 col-sm-12 col-xs-12"></div> 
        		</div>
        		<!-- side-3 -->
        		<div class="item text-center">
          			<div class="col-lg-6 col-md-10 col-sm-12 col-xs-12 text-left">
           				<span class="h3">Behaviour</span>
          			</div><br>
          			<div class="col-lg-6 col-md-10 col-sm-12 col-xs-12">
            			<span id="yrs"><i class="fa fa-user" id="fa-user"></i>  3-7 yrs</span>
          			</div>
          			<div class="col-lg-3 col-md-10 col-sm-12 col-xs-12"></div>
          				<div class="col-lg-1 col-md-10 col-sm-12 col-xs-12 text-center">
            				<i class="fa fa-question-circle" id="fa-question"></i>
            				<span id="bottom-right"></span>
          				</div> 
          				<div class="col-lg-4 col-md-10 col-sm-12 col-xs-12">
            				<span class="text-center">
              				After arranging the wardrobe with seversl piles of clothes and  <br> hangers, You decided to sit calm for some times.
             				</span><br>
            				<button class="btn btn-big text-center btnShow" id="btn">Participate Now</button>
          				</div> 
          				<div class="col-lg-4"></div>        
        			</div>
      			</div>
      			<a data-slide="prev" href="#c-slide" class="left carousel-control">
        			<i class="arrow_carrot-left_alt2"></i>
      			</a>
      			<a data-slide="next" href="#c-slide" class="right carousel-control">
        			<i class="arrow_carrot-right_alt2"></i>
      			</a>
    		</div>
    		<!--carousel end-->
		</div>

		<h3>Blogs</h3>
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
			        		<p class="text-left" style="padding-top: 10px;"><?=substr($row['blog_content'], 0, 60);?></p>
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