<?php
// ob_start();
include_once '../lib/core.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['login'])) {
        $email = $conn->real_escape_string($_POST['email']);
        $password = $conn->real_escape_string($_POST['password']);
        $password = md5($password);
        $sql = "SELECT * FROM admin where email='$email' and password='$password'";
        if($result = $conn->query($sql)) {
          if($result->num_rows > 0)
          {
            $_SESSION['admin_signed_in']=$email;
            header("location:homepage.php");
          }
          else
          {
            $error = true;
          }
        }
        else
        {
          $error = true;
        }
    }
  }


?>
<!DOCTYPE html>
<html lang="en">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>STRental Login</title>
<!--favicon-->
<link rel="icon" href="<?= $config['logo'] ?>" type="image/png">
<!-- loader-->
<link href="assets/css/pace.min.css" rel="stylesheet">
<script src="assets/js/pace.min.js"></script>
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="assets/css/bootstrap.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600&amp;family=Roboto&amp;display=swap">
<!-- Icons CSS -->
<link rel="stylesheet" href="assets/css/icons.css">
<!-- App CSS -->
<link rel="stylesheet" href="assets/css/app.css">
<style>
 .form-control:focus{
  border-color:#1fcecb;
  box-shadow:0 0 0 0.05rem #1fcecb;
}
  </style>
<style>
  
  .btn-secondary,
  .btn-secondary:hover {
    background-color: #343a40;
    color: white;
  }
</style>
<style>
  .cke {
    visibility: hidden;
  }
</style>
<style type="text/css">
  .apexcharts-canvas {
    position: relative;
    user-select: none;
    /* cannot give overflow: hidden as it will crop tooltips which overflow outside chart area */
  }


  /* scrollbar is not visible by default for legend, hence forcing the visibility */
  .apexcharts-canvas ::-webkit-scrollbar {
    -webkit-appearance: none;
    width: 6px;
  }

  .apexcharts-canvas ::-webkit-scrollbar-thumb {
    border-radius: 4px;
    background-color: rgba(0, 0, 0, .5);
    box-shadow: 0 0 1px rgba(255, 255, 255, .5);
    -webkit-box-shadow: 0 0 1px rgba(255, 255, 255, .5);
  }

  .apexcharts-canvas.apexcharts-theme-dark {
    background: #424242;
  }

  .apexcharts-inner {
    position: relative;
  }

  .apexcharts-text tspan {
    font-family: inherit;
  }

  .legend-mouseover-inactive {
    transition: 0.15s ease all;
    opacity: 0.20;
  }

  .apexcharts-series-collapsed {
    opacity: 0;
  }

  .apexcharts-tooltip {
    border-radius: 5px;
    box-shadow: 2px 2px 6px -4px #999;
    cursor: default;
    font-size: 14px;
    left: 62px;
    opacity: 0;
    pointer-events: none;
    position: absolute;
    top: 20px;
    overflow: hidden;
    white-space: nowrap;
    z-index: 12;
    transition: 0.15s ease all;
  }

  .apexcharts-tooltip.apexcharts-active {
    opacity: 1;
    transition: 0.15s ease all;
  }

  .apexcharts-tooltip.apexcharts-theme-light {
    border: 1px solid #e3e3e3;
    background: rgba(255, 255, 255, 0.96);
  }

  .apexcharts-tooltip.apexcharts-theme-dark {
    color: #fff;
    background: rgba(30, 30, 30, 0.8);
  }

  .apexcharts-tooltip * {
    font-family: inherit;
  }


  .apexcharts-tooltip-title {
    padding: 6px;
    font-size: 15px;
    margin-bottom: 4px;
  }

  .apexcharts-tooltip.apexcharts-theme-light .apexcharts-tooltip-title {
    background: #ECEFF1;
    border-bottom: 1px solid #ddd;
  }

  .apexcharts-tooltip.apexcharts-theme-dark .apexcharts-tooltip-title {
    background: rgba(0, 0, 0, 0.7);
    border-bottom: 1px solid #333;
  }

  .apexcharts-tooltip-text-value,
  .apexcharts-tooltip-text-z-value {
    display: inline-block;
    font-weight: 600;
    margin-left: 5px;
  }

  .apexcharts-tooltip-text-z-label:empty,
  .apexcharts-tooltip-text-z-value:empty {
    display: none;
  }

  .apexcharts-tooltip-text-value,
  .apexcharts-tooltip-text-z-value {
    font-weight: 600;
  }

  .apexcharts-tooltip-marker {
    width: 12px;
    height: 12px;
    position: relative;
    top: 0px;
    margin-right: 10px;
    border-radius: 50%;
  }

  .apexcharts-tooltip-series-group {
    padding: 0 10px;
    display: none;
    text-align: left;
    justify-content: left;
    align-items: center;
  }

  .apexcharts-tooltip-series-group.apexcharts-active .apexcharts-tooltip-marker {
    opacity: 1;
  }

  .apexcharts-tooltip-series-group.apexcharts-active,
  .apexcharts-tooltip-series-group:last-child {
    padding-bottom: 4px;
  }

  .apexcharts-tooltip-series-group-hidden {
    opacity: 0;
    height: 0;
    line-height: 0;
    padding: 0 !important;
  }

  .apexcharts-tooltip-y-group {
    padding: 6px 0 5px;
  }

  .apexcharts-tooltip-candlestick {
    padding: 4px 8px;
  }

  .apexcharts-tooltip-candlestick>div {
    margin: 4px 0;
  }

  .apexcharts-tooltip-candlestick span.value {
    font-weight: bold;
  }

  .apexcharts-tooltip-rangebar {
    padding: 5px 8px;
  }

  .apexcharts-tooltip-rangebar .category {
    font-weight: 600;
    color: #777;
  }

  .apexcharts-tooltip-rangebar .series-name {
    font-weight: bold;
    display: block;
    margin-bottom: 5px;
  }

  .apexcharts-xaxistooltip {
    opacity: 0;
    padding: 9px 10px;
    pointer-events: none;
    color: #373d3f;
    font-size: 13px;
    text-align: center;
    border-radius: 2px;
    position: absolute;
    z-index: 10;
    background: #ECEFF1;
    border: 1px solid #90A4AE;
    transition: 0.15s ease all;
  }

  .apexcharts-xaxistooltip.apexcharts-theme-dark {
    background: rgba(0, 0, 0, 0.7);
    border: 1px solid rgba(0, 0, 0, 0.5);
    color: #fff;
  }

  .apexcharts-xaxistooltip:after,
  .apexcharts-xaxistooltip:before {
    left: 50%;
    border: solid transparent;
    content: " ";
    height: 0;
    width: 0;
    position: absolute;
    pointer-events: none;
  }

  .apexcharts-xaxistooltip:after {
    border-color: rgba(236, 239, 241, 0);
    border-width: 6px;
    margin-left: -6px;
  }

  .apexcharts-xaxistooltip:before {
    border-color: rgba(144, 164, 174, 0);
    border-width: 7px;
    margin-left: -7px;
  }

  .apexcharts-xaxistooltip-bottom:after,
  .apexcharts-xaxistooltip-bottom:before {
    bottom: 100%;
  }

  .apexcharts-xaxistooltip-top:after,
  .apexcharts-xaxistooltip-top:before {
    top: 100%;
  }

  .apexcharts-xaxistooltip-bottom:after {
    border-bottom-color: #ECEFF1;
  }

  .apexcharts-xaxistooltip-bottom:before {
    border-bottom-color: #90A4AE;
  }

  .apexcharts-xaxistooltip-bottom.apexcharts-theme-dark:after {
    border-bottom-color: rgba(0, 0, 0, 0.5);
  }

  .apexcharts-xaxistooltip-bottom.apexcharts-theme-dark:before {
    border-bottom-color: rgba(0, 0, 0, 0.5);
  }

  .apexcharts-xaxistooltip-top:after {
    border-top-color: #ECEFF1
  }

  .apexcharts-xaxistooltip-top:before {
    border-top-color: #90A4AE;
  }

  .apexcharts-xaxistooltip-top.apexcharts-theme-dark:after {
    border-top-color: rgba(0, 0, 0, 0.5);
  }

  .apexcharts-xaxistooltip-top.apexcharts-theme-dark:before {
    border-top-color: rgba(0, 0, 0, 0.5);
  }

  .apexcharts-xaxistooltip.apexcharts-active {
    opacity: 1;
    transition: 0.15s ease all;
  }

  .apexcharts-yaxistooltip {
    opacity: 0;
    padding: 4px 10px;
    pointer-events: none;
    color: #373d3f;
    font-size: 13px;
    text-align: center;
    border-radius: 2px;
    position: absolute;
    z-index: 10;
    background: #ECEFF1;
    border: 1px solid #90A4AE;
  }

  .apexcharts-yaxistooltip.apexcharts-theme-dark {
    background: rgba(0, 0, 0, 0.7);
    border: 1px solid rgba(0, 0, 0, 0.5);
    color: #fff;
  }

  .apexcharts-yaxistooltip:after,
  .apexcharts-yaxistooltip:before {
    top: 50%;
    border: solid transparent;
    content: " ";
    height: 0;
    width: 0;
    position: absolute;
    pointer-events: none;
  }

  .apexcharts-yaxistooltip:after {
    border-color: rgba(236, 239, 241, 0);
    border-width: 6px;
    margin-top: -6px;
  }

  .apexcharts-yaxistooltip:before {
    border-color: rgba(144, 164, 174, 0);
    border-width: 7px;
    margin-top: -7px;
  }

  .apexcharts-yaxistooltip-left:after,
  .apexcharts-yaxistooltip-left:before {
    left: 100%;
  }

  .apexcharts-yaxistooltip-right:after,
  .apexcharts-yaxistooltip-right:before {
    right: 100%;
  }

  .apexcharts-yaxistooltip-left:after {
    border-left-color: #ECEFF1;
  }

  .apexcharts-yaxistooltip-left:before {
    border-left-color: #90A4AE;
  }

  .apexcharts-yaxistooltip-left.apexcharts-theme-dark:after {
    border-left-color: rgba(0, 0, 0, 0.5);
  }

  .apexcharts-yaxistooltip-left.apexcharts-theme-dark:before {
    border-left-color: rgba(0, 0, 0, 0.5);
  }

  .apexcharts-yaxistooltip-right:after {
    border-right-color: #ECEFF1;
  }

  .apexcharts-yaxistooltip-right:before {
    border-right-color: #90A4AE;
  }

  .apexcharts-yaxistooltip-right.apexcharts-theme-dark:after {
    border-right-color: rgba(0, 0, 0, 0.5);
  }

  .apexcharts-yaxistooltip-right.apexcharts-theme-dark:before {
    border-right-color: rgba(0, 0, 0, 0.5);
  }

  .apexcharts-yaxistooltip.apexcharts-active {
    opacity: 1;
  }

  .apexcharts-yaxistooltip-hidden {
    display: none;
  }

  .apexcharts-xcrosshairs,
  .apexcharts-ycrosshairs {
    pointer-events: none;
    opacity: 0;
    transition: 0.15s ease all;
  }

  .apexcharts-xcrosshairs.apexcharts-active,
  .apexcharts-ycrosshairs.apexcharts-active {
    opacity: 1;
    transition: 0.15s ease all;
  }

  .apexcharts-ycrosshairs-hidden {
    opacity: 0;
  }

  .apexcharts-selection-rect {
    cursor: move;
  }

  .svg_select_boundingRect,
  .svg_select_points_rot {
    pointer-events: none;
    opacity: 0;
    visibility: hidden;
  }

  .apexcharts-selection-rect+g .svg_select_boundingRect,
  .apexcharts-selection-rect+g .svg_select_points_rot {
    opacity: 0;
    visibility: hidden;
  }

  .apexcharts-selection-rect+g .svg_select_points_l,
  .apexcharts-selection-rect+g .svg_select_points_r {
    cursor: ew-resize;
    opacity: 1;
    visibility: visible;
  }

  .svg_select_points {
    fill: #efefef;
    stroke: #333;
    rx: 2;
  }

  .apexcharts-canvas.apexcharts-zoomable .hovering-zoom {
    cursor: crosshair
  }

  .apexcharts-canvas.apexcharts-zoomable .hovering-pan {
    cursor: move
  }

  .apexcharts-zoom-icon,
  .apexcharts-zoomin-icon,
  .apexcharts-zoomout-icon,
  .apexcharts-reset-icon,
  .apexcharts-pan-icon,
  .apexcharts-selection-icon,
  .apexcharts-menu-icon,
  .apexcharts-toolbar-custom-icon {
    cursor: pointer;
    width: 20px;
    height: 20px;
    line-height: 24px;
    color: #6E8192;
    text-align: center;
  }

  .apexcharts-zoom-icon svg,
  .apexcharts-zoomin-icon svg,
  .apexcharts-zoomout-icon svg,
  .apexcharts-reset-icon svg,
  .apexcharts-menu-icon svg {
    fill: #6E8192;
  }

  .apexcharts-selection-icon svg {
    fill: #444;
    transform: scale(0.76)
  }

  .apexcharts-theme-dark .apexcharts-zoom-icon svg,
  .apexcharts-theme-dark .apexcharts-zoomin-icon svg,
  .apexcharts-theme-dark .apexcharts-zoomout-icon svg,
  .apexcharts-theme-dark .apexcharts-reset-icon svg,
  .apexcharts-theme-dark .apexcharts-pan-icon svg,
  .apexcharts-theme-dark .apexcharts-selection-icon svg,
  .apexcharts-theme-dark .apexcharts-menu-icon svg,
  .apexcharts-theme-dark .apexcharts-toolbar-custom-icon svg {
    fill: #f3f4f5;
  }

  .apexcharts-canvas .apexcharts-zoom-icon.apexcharts-selected svg,
  .apexcharts-canvas .apexcharts-selection-icon.apexcharts-selected svg,
  .apexcharts-canvas .apexcharts-reset-zoom-icon.apexcharts-selected svg {
    fill: #008FFB;
  }

  .apexcharts-theme-light .apexcharts-selection-icon:not(.apexcharts-selected):hover svg,
  .apexcharts-theme-light .apexcharts-zoom-icon:not(.apexcharts-selected):hover svg,
  .apexcharts-theme-light .apexcharts-zoomin-icon:hover svg,
  .apexcharts-theme-light .apexcharts-zoomout-icon:hover svg,
  .apexcharts-theme-light .apexcharts-reset-icon:hover svg,
  .apexcharts-theme-light .apexcharts-menu-icon:hover svg {
    fill: #333;
  }

  .apexcharts-selection-icon,
  .apexcharts-menu-icon {
    position: relative;
  }

  .apexcharts-reset-icon {
    margin-left: 5px;
  }

  .apexcharts-zoom-icon,
  .apexcharts-reset-icon,
  .apexcharts-menu-icon {
    transform: scale(0.85);
  }

  .apexcharts-zoomin-icon,
  .apexcharts-zoomout-icon {
    transform: scale(0.7)
  }

  .apexcharts-zoomout-icon {
    margin-right: 3px;
  }

  .apexcharts-pan-icon {
    transform: scale(0.62);
    position: relative;
    left: 1px;
    top: 0px;
  }

  .apexcharts-pan-icon svg {
    fill: #fff;
    stroke: #6E8192;
    stroke-width: 2;
  }

  .apexcharts-pan-icon.apexcharts-selected svg {
    stroke: #008FFB;
  }

  .apexcharts-pan-icon:not(.apexcharts-selected):hover svg {
    stroke: #333;
  }

  .apexcharts-toolbar {
    position: absolute;
    z-index: 11;
    max-width: 176px;
    text-align: right;
    border-radius: 3px;
    padding: 0px 6px 2px 6px;
    display: flex;
    justify-content: space-between;
    align-items: center;
  }

  .apexcharts-menu {
    background: #fff;
    position: absolute;
    top: 100%;
    border: 1px solid #ddd;
    border-radius: 3px;
    padding: 3px;
    right: 10px;
    opacity: 0;
    min-width: 110px;
    transition: 0.15s ease all;
    pointer-events: none;
  }

  .apexcharts-menu.apexcharts-menu-open {
    opacity: 1;
    pointer-events: all;
    transition: 0.15s ease all;
  }

  .apexcharts-menu-item {
    padding: 6px 7px;
    font-size: 12px;
    cursor: pointer;
  }

  .apexcharts-theme-light .apexcharts-menu-item:hover {
    background: #eee;
  }

  .apexcharts-theme-dark .apexcharts-menu {
    background: rgba(0, 0, 0, 0.7);
    color: #fff;
  }

  @media screen and (min-width: 768px) {
    .apexcharts-canvas:hover .apexcharts-toolbar {
      opacity: 1;
    }
  }

  .apexcharts-datalabel.apexcharts-element-hidden {
    opacity: 0;
  }

  .apexcharts-pie-label,
  .apexcharts-datalabels,
  .apexcharts-datalabel,
  .apexcharts-datalabel-label,
  .apexcharts-datalabel-value {
    cursor: default;
    pointer-events: none;
  }

  .apexcharts-pie-label-delay {
    opacity: 0;
    animation-name: opaque;
    animation-duration: 0.3s;
    animation-fill-mode: forwards;
    animation-timing-function: ease;
  }

  .apexcharts-canvas .apexcharts-element-hidden {
    opacity: 0;
  }

  .apexcharts-hide .apexcharts-series-points {
    opacity: 0;
  }

  .apexcharts-gridline,
  .apexcharts-annotation-rect,
  .apexcharts-tooltip .apexcharts-marker,
  .apexcharts-area-series .apexcharts-area,
  .apexcharts-line,
  .apexcharts-zoom-rect,
  .apexcharts-toolbar svg,
  .apexcharts-area-series .apexcharts-series-markers .apexcharts-marker.no-pointer-events,
  .apexcharts-line-series .apexcharts-series-markers .apexcharts-marker.no-pointer-events,
  .apexcharts-radar-series path,
  .apexcharts-radar-series polygon {
    pointer-events: none;
  }


  /* markers */

  .apexcharts-marker {
    transition: 0.15s ease all;
  }

  @keyframes opaque {
    0% {
      opacity: 0;
    }

    100% {
      opacity: 1;
    }
  }


  /* Resize generated styles */

  @keyframes resizeanim {
    from {
      opacity: 0;
    }

    to {
      opacity: 0;
    }
  }

  .resize-triggers {
    animation: 1ms resizeanim;
    visibility: hidden;
    opacity: 0;
  }

  .resize-triggers,
  .resize-triggers>div,
  .contract-trigger:before {
    content: " ";
    display: block;
    position: absolute;
    top: 0;
    left: 0;
    height: 100%;
    width: 100%;
    overflow: hidden;
  }

  .resize-triggers>div {
    background: #eee;
    overflow: auto;
  }

  .contract-trigger:before {
    width: 200%;
    height: 200%;
  }
</style>
</head>

<body class="bg-login  pace-done">
  <div class="pace  pace-inactive">
    <div class="pace-progress" data-progress-text="100%" data-progress="99" style="transform: translate3d(100%, 0px, 0px);">

      <div class="pace-progress-inner"></div>
    </div>
    <div class="pace-activity"></div>
  </div>
  <!-- wrapper -->
  <div class="wrapper">
   
    <div class="section-authentication-login d-flex align-items-center justify-content-center">

      <div class="col-12 col-lg-6 mx-auto">
        <div class="card radius-15">
          <div class="row no-gutters">
            <div class="col-lg-12">
              <div class="card-body p-md-5">
                <div class="text-center">
                <div>
                    <h1 class="logo-text" style="font-size:50px">STRental </h1>
                </div>
                  <h3 style="color:#1fcecb" class="mt-4 font-weight-bold">Welcome Back</h3>
                  <div id="msg" style="display: none; border: 2px solid #343a40; color: white; background-color: #343a40">
                    <p id="error" style="margin-top: 12px;"> </p>
                  </div>
                </div>
                <div class="login-separater text-center"> <span>LOGIN WITH EMAIL</span>
                  <hr>
                </div>
                <?php
                  if (isset($error)) {
                  ?>
                    <div class="alert alert-danger"><strong>Error! </strong>Invalid user & Password</div>
                    <hr />
                  <?php

                  }
                  ?>
                <form method="post">
                  <div class="form-group mt-4">
                    <label>Email Address</label>
                    <input type="email" name="email" id="email" class="form-control emil" placeholder="Enter your email address">
                  </div>
                  <div class="form-group">
                    <label>Password</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password">
                  </div>

                  <div class="btn-group mt-3 w-100">
                    <button type="submit" style="background-color:#1fcecb;" name="login" class="btn btn-secondary btn-block"><span id="loginspin" style="display: none;" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>&nbsp;Log In</button>
                    <button type="button" style="background-color:#1fcecb;" name="login" class="btn btn-secondary"><i class="lni lni-arrow-right"></i>
                    </button>
                  </div>
                </form>

                <hr>
                <div class="text-center">
                  <p class="mb-0">For more information<a href="https://www.cyberflow.in"> Click Here</a>
                  </p>
                </div>
              </div>
            </div>
          </div>
          <!--end row-->
        </div>
      </div>
    </div>
  </div>
  <!-- end wrapper -->



  <!-- ./wrapper -->

  <!-- jQuery 3 -->
  <script src="bower_components/jquery/dist/jquery.min.js"></script>
  <script src="dist/js/jquery.form.js"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- FastClick -->
  <script src="bower_components/fastclick/lib/fastclick.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.min.js"></script>
  <!-- Sparkline -->
  <script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
  <script src="bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
  <!-- jvectormap  -->
  <script src="assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
  <script src="assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
  <!-- SlimScroll -->
  <script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
  <!-- multiselect -->

  <!--CKEditor-->
  <script src="https://cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>

  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/popper.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
  <!--plugins-->
  <script src="assets/plugins/simplebar/js/simplebar.min.js"></script>
  <script src="assets/plugins/metismenu/js/metisMenu.min.js"></script>
  <script src="assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
  <!-- App JS -->
  <script src="assets/js/app.js"></script>

  <script src="assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js"></script>
  <script src="assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js"></script>
  <script src="assets/plugins/vectormap/jquery-jvectormap-in-mill.js"></script>
  <script src="assets/plugins/vectormap/jquery-jvectormap-us-aea-en.js"></script>
  <script src="assets/plugins/vectormap/jquery-jvectormap-uk-mill-en.js"></script>
  <script src="assets/plugins/vectormap/jquery-jvectormap-au-mill.js"></script>
  <script src="assets/plugins/apexcharts-bundle/js/apexcharts.min.js"></script>
  <script src="assets/js/index.js"></script>
  <!-- App JS -->
  <script>
    new PerfectScrollbar('.dashboard-social-list');
    new PerfectScrollbar('.dashboard-top-countries');
  </script>

  <script>
    $(function() {
      if (window.location.href.substring(window.location.href.lastIndexOf('/') + 1).includes('?')) {


        $("a[href$='" + window.location.href.substring(window.location.href.lastIndexOf('/') + 1) + "']").parent().parent().parent().addClass("active");

      } else {
        $("a[href$='" + window.location.href.substring(window.location.href.lastIndexOf('/') + 1) + "']").parent().addClass("active");

      }

      $('#example1').DataTable()
      $('#example2').DataTable({
        'paging': true,
        'lengthChange': true,
        'searching': true,
        'ordering': true,
        'info': true,
        'autoWidth': true
      })
    })
  </script>

  <script>
    $("input:checkbox").on("change", function() {

      var val = $(this).is(':checked') ? 1 : 0;
      $.ajax({
        type: "POST",
        url: "indexAjax.php",
        data: {
          val: val
        }
      });
    });
  </script>

  <script>
    //file type validation

    $(document).on('change', '#image_upload_file', function() {
      var progressBar = $('.progressBar'),
        bar = $('.progressBar .bar'),
        percent = $('.progressBar .percent');

      $('#image_upload_form').ajaxForm({
        beforeSend: function() {
          progressBar.fadeIn();
          var percentVal = '0%';
          bar.width(percentVal)
          percent.html(percentVal);
        },
        uploadProgress: function(event, position, total, percentComplete) {
          var percentVal = percentComplete + '%';
          bar.width(percentVal)
          percent.html(percentVal);
        },
        success: function(html, statusText, xhr, $form) {
          obj = $.parseJSON(html);
          if (obj.status) {
            var percentVal = '100%';
            bar.width(percentVal)
            percent.html(percentVal);
            $("#imgArea>img").prop('src', obj.image_medium);
          } else {
            alert(obj.error);
          }
        },
        complete: function(xhr) {
          progressBar.fadeOut();
        }
      }).submit();

    });
  </script>

  <script>
    function check() {
      var email = $('#email').val();
      if (email == '') {
        $("#error").html("Enter Registered Email Address")
      } else {
        checkemail(email);
      }
    }

    function checkemail(email) {
      // $.ajax({
      //     url: "https://tattbooking.com/tattey_app/appapis/appointment.php",
      //     type: "POST",
      // 	dataType: "json",
      //     data: {
      //         forgotPass: email,
      //         email: email
      //     },
      //     success: function(data) 
      // 	{
      // 	   var obj=JSON.parse(data)
      // 	   console.log(obj.msg.trim())
      //     },
      //     error: function() 
      // 	{
      // 		$("#error").append("Enter registered email address")
      //     }
      // })
      $("#forgotbtn").prop('disabled', false);
      $('#loginspin').show();
      fetch('https://tattbooking.com/tattey_app/appapis/appointment.php', {
          method: 'POST',
          headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json',
          },
          body: JSON.stringify({
            forgotPass: email,
            email: email,
          })

        }).then(function(response) {
          return response.json()
        })
        .then(function(data) {
          $("#forgotbtn").prop('disabled', true);
          $('#loginspin').hide();
          console.log(data)
          var mssg = data.msg;
          console.log(mssg);
          if (mssg == "success") {
            $("#msg").show()
            $("#error").html("Reset Link Sent to Email")

          } else if (mssg == "no_user") {
            $("#msg").show()
            $("#error").html("Enter registered email address")
            $("#forgotbtn").prop('disabled', false);
          } else if (mssg == "something_wrong") {
            $("#msg").show()
            $("#error").html("Something went wrong")
            $("#forgotbtn").prop('disabled', false);
          }
        })

    }
  </script><svg id="SvgjsSvg1001" width="2" height="0" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" style="overflow: hidden; top: -100%; left: -100%; position: absolute; opacity: 0;">
    <defs id="SvgjsDefs1002"></defs>
    <polyline id="SvgjsPolyline1003" points="0,0"></polyline>
    <path id="SvgjsPath1004" d="M0 0 "></path>
  </svg>
  <div class="jvectormap-tip"></div>
</body>

</html>