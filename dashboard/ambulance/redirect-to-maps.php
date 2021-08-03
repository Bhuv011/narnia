<?php
    include '../functions.inc.php';
    checkSessAmbul();
    if(isset($_GET['latitude']) && isset($_GET['longitude']) && isset($_GET['user_id'])) {
        $lat = $_GET['latitude'];
        $lon = $_GET['longitude'];
        updateDispatchStatus();
        header('location: https://maps.google.com?q='.$lat.','.$lon);
    } else {
        header('location: ./dashboard.php');
    }
?>