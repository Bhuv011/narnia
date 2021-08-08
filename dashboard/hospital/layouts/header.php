<?php
    require '../functions.inc.php';
    if(isset($_POST['logout'])) {
        logoutHospital();
    }
?>
<!DOCTYPE html>
<html lang="en">

<head> 
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php hospitalName(); ?> </title>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="theme-color" content="#ffffff">
<link type="text/css" href="../../dashboard/vendor/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">
<link type="text/css" href="../../dashboard/assets/css/bootstrap.css" rel="stylesheet">
</head>

<body>
        <nav class="navbar navbar-dark navbar-theme-primary px-4 col-12 d-lg-none">
    <a class="navbar-brand me-lg-5" href="#">
        <?php hospitalName(); ?>
    </a>
    <div class="d-flex align-items-center">
        <button class="navbar-toggler d-lg-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
    </div>
</nav>