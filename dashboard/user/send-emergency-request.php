<?php
    include '../functions.inc.php';
    if(isset($_POST['user_id'])) {
        sendHospitalsRequest();
    }
?>