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
  .navbar-default .dropdown-menu.notify-drop {
    min-width: 330px;
    background-color: #fff;
    min-height: 360px;
    max-height: 360px;
  }
  .navbar-default .dropdown-menu.notify-drop .notify-drop-title {
    border-bottom: 1px solid #e2e2e2;
    padding: 5px 15px 10px 15px;
  }
  .navbar-default .dropdown-menu.notify-drop .drop-content {
    min-height: 280px;
    max-height: 280px;
    overflow-y: scroll;
  }
  .navbar-default .dropdown-menu.notify-drop .drop-content::-webkit-scrollbar-track
  {
    background-color: #F5F5F5;
  }

  .navbar-default .dropdown-menu.notify-drop .drop-content::-webkit-scrollbar
  {
    width: 8px;
    background-color: #F5F5F5;
  }

  .navbar-default .dropdown-menu.notify-drop .drop-content::-webkit-scrollbar-thumb
  {
    background-color: #ccc;
  }
  .navbar-default .dropdown-menu.notify-drop .drop-content > li {
    border-bottom: 1px solid #e2e2e2;
    padding: 10px 0px 5px 0px;
  }
  .navbar-default .dropdown-menu.notify-drop .drop-content > li:nth-child(2n+0) {
    background-color: #fafafa;
  }
  .navbar-default .dropdown-menu.notify-drop .drop-content > li:after {
    content: "";
    clear: both;
    display: block;
  }
  .navbar-default .dropdown-menu.notify-drop .drop-content > li:hover {
    background-color: #fcfcfc;
  }
  .navbar-default .dropdown-menu.notify-drop .drop-content > li:last-child {
    border-bottom: none;
  }
  .navbar-default .dropdown-menu.notify-drop .drop-content > li .notify-img {
    float: left;
    display: inline-block;
    width: 45px;
    height: 45px;
    margin: 0px 0px 8px 0px;
  }
  .navbar-default .dropdown-menu.notify-drop .allRead {
    margin-right: 7px;
  }
  .navbar-default .dropdown-menu.notify-drop .rIcon {
    float: right;
    color: #999;
  }
  .navbar-default .dropdown-menu.notify-drop .rIcon:hover {
    color: #333;
  }
  .navbar-default .dropdown-menu.notify-drop .drop-content > li a {
    font-size: 12px;
    font-weight: normal;
  }
  .navbar-default .dropdown-menu.notify-drop .drop-content > li {
    font-weight: bold;
    font-size: 11px;
  }
  .navbar-default .dropdown-menu.notify-drop .drop-content > li hr {
    margin: 5px 0;
    width: 70%;
    border-color: #e2e2e2;
  }
  .navbar-default .dropdown-menu.notify-drop .drop-content .pd-l0 {
    padding-left: 0;
  }
  .navbar-default .dropdown-menu.notify-drop .drop-content > li p {
    font-size: 11px;
    color: #666;
    font-weight: normal;
    margin: 3px 0;
  }
  .navbar-default .dropdown-menu.notify-drop .drop-content > li p.time {
    font-size: 10px;
    font-weight: 600;
    top: -6px;
    margin: 8px 0px 0px 0px;
    padding: 0px 3px;
    border: 1px solid #e2e2e2;
    position: relative;
    background-image: linear-gradient(#fff,#f2f2f2);
    display: inline-block;
    border-radius: 2px;
    color: #B97745;
  }
  .navbar-default .dropdown-menu.notify-drop .drop-content > li p.time:hover {
    background-image: linear-gradient(#fff,#fff);
  }
  .navbar-default .dropdown-menu.notify-drop .notify-drop-footer {
    border-top: 1px solid #e2e2e2;
    bottom: 0;
    position: relative;
    padding: 8px 15px;
  }
  .navbar-default .dropdown-menu.notify-drop .notify-drop-footer a {
    color: #777;
    text-decoration: none;
  }
  .navbar-default .dropdown-menu.notify-drop .notify-drop-footer a:hover {
    color: #333;
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
      <?php
      $ci = & get_instance();
      if($this->session->userdata('data')->nama_level=="UPM"){
      $ci->db->where('status_aksi','Edit');
      $ci->db->join('indikator','indikator.id_indikator=indikator_ta.id_indikator');
      $this->datatables->join('user', 'indikator_ta.id_user = user.id_user');
      $data = $ci->db->get('indikator_ta')->result();
    }else{
      $q="SELECT *, c.status as ta_status, a.status as in_status FROM `indikator_ta` a,indikator b, ta c WHERE  `status_aksi`='Add' OR `status_aksi`='Read' and a.id_indikator=b.id_indikator and a.id_ta=c.id_ta and id_user=".$this->session->userdata('data')->id_user;
      $data = $ci->db->query($q)->result();
    }
       ?>
      <ul class="nav navbar-top-links navbar-right">
        <li class="dropdown">
          <a href="#" style="color:white;" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php if(count($data)>0){ ?><span class="badge badge-danger" style="background-color:red"><?php echo count($data); ?></span><?php } ?> <i data-count="3" class="glyphicon glyphicon-bell notification-icon"></i></a>
            <ul class="dropdown-menu notify-drop">
              <div class="notify-drop-title">
                <div class="row">
                  <div class="col-md-6 col-sm-6 col-xs-6">Notifikasi (<b><?php echo count($data); ?></b>) </div>
                </div>
              </div>
              <!-- end notify title -->
              <!-- notify content -->
              <div class="drop-content">
                <?php

            		foreach ($data as $row) {
                  $text='';

                 ?>
                 <?php if (($row->status_aksi=="Read"||$row->status_aksi=="Add")&&$this->session->userdata('data')->nama_level!="UPM") {


                   if ($row->status_aksi=="Read") {

                     if ($row->in_status=="Lengkap") {
                       $status='<label class="label label-success">'.$row->in_status.'</label>';
                     }else if($row->in_status=="Belum Lengkap"){
                       $status='<label class="label label-danger">'.$row->in_status.'</label>';
                     }else if ($row->in_status=="Kosong") {
                       $status='<label class="label label-default">'.$row->in_status.'</label>';
                     }else if ($row->in_status=="Draft") {
                       $status='<label class="label label-warning">'.$row->in_status.'</label>';
                     }
                     $text='<i class="fa fa-eye"></i> Inidkator '.$row->nama.' telah di review oleh UPM dengan status '.$status;
                   }else if ($row->status_aksi=="Add") {
                     $text='<i class="fa fa-sticky-note"></i> Inidkator '.$row->nama.' dibebankan kepada anda';
                   }
                   $url="";
                   if ($row->ta_status=="Aktif"&&$row->in_status!="Lengkap") {
                     $url=base_url()."indikator_ta/update/".$row->id_indikator_ta;
                   }

                    echo '<li>
                      <a href="'.$url.'">
                        <div class="col-md-12 ">
                        '.$text.'
                          <hr>
                          <p class="time">'.$row->tgl_update.'</p>
                        </div>
                      </a>
                    </li>';
                 }else if($this->session->userdata('data')->nama_level=="UPM"){
                   $url=base_url()."indikator_ta/update/".$row->id_indikator_ta;
                   echo '<li>
                     <a href="'.$url.'">
                       <div class="col-md-12 ">
                       <i class="fa fa-exchange"></i> Indikator '.$row->nama.' telah diisi oleh : '.$row->username.'.
                         <hr>
                         <p class="time">'.$row->tgl_update.'</p>
                       </div>
                     </a>
                   </li>';

                 }
              } ?>
              </div>
              <div class="notify-drop-footer text-center">
                <!-- <a href=""><i class="fa fa-eye"></i> Tümünü Göster</a> -->
              </div>
            </ul>
          </li>
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
