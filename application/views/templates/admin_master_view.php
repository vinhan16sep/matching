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

    <!-- Bootstrap 4.3 -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- Custom fonts for this template-->
    <link href="<?php echo site_url('assets/'); ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo site_url('assets/'); ?>vendor/font-awesome-master/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<!--    <link href="--><?php //echo site_url('assets/'); ?><!--vendor/font-awesome.min.css" rel="stylesheet" type="text/css">-->
<!--    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">-->

    <!-- Custom styles for this template-->
    <link rel="stylesheet"  href="<?php echo site_url('assets/'); ?>css/sb-admin-2.min.css" />
    <link rel="stylesheet"  href="<?php echo site_url('assets/'); ?>vendor/bootstrap-datepicker/css/bootstrap-datepicker3.css" />

    <link rel="stylesheet"  href="<?php echo site_url('assets/'); ?>scss/style.css" />
    <script src="<?php echo site_url('assets/'); ?>vendor/jquery/jquery-3.4.1.js"></script>

    <!-- Bootstrap core JavaScript-->
<!--    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <script src="<?php echo site_url('assets/'); ?>vendor/bootstrap-datepicker/bootstrap-datepicker.js"></script>
    <script src="<?php echo site_url('assets/'); ?>vendor/bootstrap-datepicker/locales/bootstrap-datepicker.vi.js"></script>

    <!-- Core plugin JavaScript-->
<!--    <script src="--><?php //echo site_url('assets/'); ?><!--vendor/jquery-easing/jquery.easing.min.js"></script>-->

    <!-- Custom scripts for all pages-->
    <script src="<?php echo site_url('assets/'); ?>js/sb-admin-2.min.js"></script>

</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">
<?php
$this->load->view('templates/admin_parts/admin_master_sidebar_view');
$this->load->view('templates/admin_parts/admin_master_header_view');
if ($this->ion_auth->logged_in()) {

}

?>
<?php
    echo $the_view_content;
?>
<?php
$this->load->view('templates/admin_parts/admin_master_footer_view');
?>


