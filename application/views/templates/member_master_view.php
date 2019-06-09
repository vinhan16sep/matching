<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Matching System</title>

    <!-- Custom fonts for this template-->
    <link href="<?php echo site_url('assets/'); ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo site_url('assets/'); ?>vendor/jquery.datetimepicker.min.css" rel="stylesheet" type="text/css">
    <!--    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">-->

    <!-- Custom styles for this template-->
    <link rel="stylesheet"  href="<?php echo site_url('assets/'); ?>css/sb-admin-2.min.css" />

    <!-- my Style -->
    <link rel="stylesheet"  href="<?php echo site_url('assets/'); ?>scss/admin/style.css" />

    <!-- Bootstrap core JavaScript-->
    <script src="<?php echo site_url('assets/'); ?>vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo site_url('assets/'); ?>vendor/jquery.datetimepicker.full.min.js"></script>
    <script src="<?php echo site_url('assets/'); ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <!--    <script src="--><?php //echo site_url('assets/'); ?><!--vendor/jquery-easing/jquery.easing.min.js"></script>-->

    <!-- Custom scripts for all pages-->
    <script src="<?php echo site_url('assets/'); ?>js/sb-admin-2.min.js"></script>

</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">
    <?php
    $this->load->view('templates/member_parts/member_master_sidebar_view');
    $this->load->view('templates/member_parts/member_master_header_view');
    if ($this->ion_auth->logged_in()) {

    }

    ?>
    <?php
    echo $the_view_content;
    ?>
    <?php
    $this->load->view('templates/member_parts/member_master_footer_view');
    ?>


