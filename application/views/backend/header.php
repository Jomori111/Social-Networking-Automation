<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Manage post system.">
    <link rel="icon" href="assets/frontend/image/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="assets/frontend/image/favicon.png" type="image/x-icon">
    <title>Post System</title>

    <link href="https://fonts.googleapis.com/css?family=Work+Sans:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/backend/css/fontawesome.css">
    <link rel="stylesheet" type="text/css" href="assets/backend/css/icofont.css">
    <link rel="stylesheet" type="text/css" href="assets/backend/css/themify.css">
    <link rel="stylesheet" type="text/css" href="assets/backend/css/flag-icon.css">
    <link rel="stylesheet" type="text/css" href="assets/backend/css/feather-icon.css">
    <link rel="stylesheet" type="text/css" href="assets/backend/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="assets/backend/css/style.css">
    <link rel="stylesheet" type="text/css" href="assets/backend/css/jsgrid.css">
    <link id="color" rel="stylesheet" href="assets/backend/css/light-1.css" media="screen">
    <link rel="stylesheet" type="text/css" href="assets/backend/css/responsive.css">
  </head>
  <style>
    .hide{
      display: none;
    }
    .redial-social-widget.radial-bar-100 {
        background-image: linear-gradient(0deg, #158df7 100%, transparent 50%, transparent), linear-gradient(360deg, #158df7 50%, #e8f4fe 50%, #e8f4fe);
    }
  </style>
  <body>
 

    <div class="loader-wrapper">
      <div class="loader loader-7">
        <div class="line line1"></div>
        <div class="line line2"></div>
        <div class="line line3"></div>
      </div>
    </div>
    <div class="page-wrapper">
      <div class="page-main-header">
        <div class="main-header-right row">
          <div class="main-header-left d-lg-none">
            <div class="logo-wrapper"><a href="index.html"><img src="assets/backend/images/creative-logo1.png" alt=""></a></div>
          </div>
          <div class="mobile-sidebar d-block">
            <div class="media-body text-right switch-sm">
              <label class="switch">
                <input id="sidebar-toggle" type="checkbox" checked="checked"><span class="switch-state"></span>
              </label>
            </div>
          </div>
          <div class="vertical-mobile-sidebar"><i class="fa fa-bars sidebar-bar"></i></div>
          <div class="nav-right col left-menu-header">
            <ul class="nav-menus-left">
              <li><a class="text-dark" href="#!" onclick="javascript:toggleFullScreen()"><i data-feather="maximize"></i></a></li>
            </ul>
            <div class="d-xl-none mobile-toggle-left pull-right"><i data-feather="more-horizontal"></i></div>
          </div>
          <div class="d-lg-none mobile-toggle pull-right"><i data-feather="more-horizontal"></i></div>
        </div>
      </div>

      <div class="page-body-wrapper">
        <div class="page-sidebar iconcolor-sidebar">
          <div class="main-header-left d-none d-lg-block">
            <div class="logo-wrapper"><a href="index.html"><img src="assets/backend/images/creative-logo.png" alt=""></a></div>
          </div>
          <div class="sidebar custom-scrollbar">
            <ul class="sidebar-menu">
              <li>
                <a class="sidebar-header" href="admin_company">
                  <i data-feather="globe"></i>
                  <span>Register Company</span>
                </a>
              </li>
              <li>
                <a class="sidebar-header" href="admin_list">
                  <i data-feather="airplay"></i><span>Existing List</span>
                </a>
              </li>
              
            </ul>
          </div>
        </div>