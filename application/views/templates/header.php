<!DOCTYPE html>
<html lang="en">
<html>
    <head>
        <title>SPMI</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <link rel="stylesheet" href="<?php echo base_url('assets/datatables/dataTables.bootstrap.css') ?>"/>
        <link href="<?php echo base_url('assets/vendor/font-awesome/css/font-awesome.min.css') ?>" rel="stylesheet">
		<!-- MetisMenu CSS -->
		<link href="<?php echo base_url('assets/vendor/metisMenu/metisMenu.min.css') ?>" rel="stylesheet">

		<!-- Custom CSS -->
		<link href="<?php echo base_url('assets/css/sb-admin-2.css') ?>" rel="stylesheet">
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap-select.min.css'); ?>">
		  <script src="<?php echo base_url('assets/ckeditor/ckeditor.js'); ?>"></script>
		<style>
            .dataTables_wrapper {
                min-height: 500px
            }
            
            .dataTables_processing {
                position: absolute;
                top: 50%;
                left: 50%;
                width: 100%;
                margin-left: -50%;
                margin-top: -25px;
                padding-top: 20px;
                text-align: center;
                font-size: 1.2em;
                color:grey;
            }
        </style>
    </head>
    <body>
	
		<!-- Main Menu -->
		<div id="wrapper">

			<!-- Navigation -->
			<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0;background-color:#3498db;">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="<?php echo site_url('home'); ?>" style="color:white;">Sistem Penjaminan Mutu Internal</a>
				</div>
				<!-- /.navbar-header -->

				<ul class="nav navbar-top-links navbar-right">
					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#">
							<i style="color:white">Selamat Datang , <?php echo $this->session->userdata('data')->username; ?></i> <i class="fa fa-user fa-fw" style="color:white;"></i> <i class="fa fa-caret-down" style="color:white;"></i>
						</a>
						<ul class="dropdown-menu dropdown-user">
							<li><a href="<?php echo site_url('login/logout'); ?>"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
							</li>
						</ul>
						<!-- /.dropdown-user -->
					</li>
					<!-- /.dropdown -->
				</ul>
				<!-- /.navbar-top-links -->

				<div class="navbar-default sidebar" role="navigation" >
					<div class="sidebar-nav navbar-collapse">
						<ul class="nav" id="side-menu">
							<?php if($this->session->userdata('data')->nama_level!="Admin"){echo generate_sidemenu_ka();}else{echo generate_sidemenu();}?>
						</ul>
					</div>
					<!-- /.sidebar-collapse -->
				</div>
				<!-- /.navbar-static-side -->
			</nav>
			<!-- Main Menu -->
			<div id="page-wrapper">