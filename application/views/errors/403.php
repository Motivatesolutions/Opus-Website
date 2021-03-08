<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="E-Library Management System">
  <meta name="author" content="Saipali Infotech">
  <meta name="keyword" content="E-Library Management System which boots Students Learning much Easy!">
  <title><?php echo $title ;?></title>
    <!-- Bootstrap CSS -->
  <link href="<?=base_url(); ?>assets/admin/css/bootstrap.min.css" rel="stylesheet">
  <!-- bootstrap theme -->
  <link href="<?=base_url(); ?>assets/admin/css/bootstrap-theme.css" rel="stylesheet">
  <!--external css-->
  <link rel="shortcut icon"  type=" image/png" href="<?=base_url('uploads/logo/'.$this->systemdata->sphoto); ?>">
  <!-- font icon -->
  <link href="<?=base_url(); ?>assets/admin/css/elegant-icons-style.css" rel="stylesheet" />
  <link href="<?=base_url(); ?>assets/admin/css/font-awesome.min.css" rel="stylesheet" />
  <!-- Custom styles -->
  <link href="<?=base_url(); ?>assets/admin/css/style.css" rel="stylesheet">
  <link href="<?=base_url(); ?>assets/admin/css/style-responsive.css" rel="stylesheet" />
</head>

<body>
  <div class="page-404">
    <p class="text-404">403</p>
    <h2>Access Forbidden!</h2>
    <p>Sorry, you donot have permission to access the requested page <br><br>
      <a href="javascript:void(0)" onclick="history.go(-1);">Return To Previous Page</a>
    </p>
  </div>
</body>
</html>