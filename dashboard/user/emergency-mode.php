<?php
    include '../functions.inc.php';
    checkSessUser();
    if(isset($_POST['submit'])) {
        updateUserProfile();
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../assets/css/bootstrap.css" />
	<title>User | Dashboard</title>
	<link rel="icon" href="../../logo.png" />
	<style>
		.btn3d {
			position: relative;
			top: -6px;
			border: 0;
			transition: all 40ms linear;
			margin-top: 10px;
			margin-bottom: 10px;
			margin-left: 2px;
			margin-right: 2px;
			height: 250px;
			width: 250px;
			border-radius: 50%;
		}

		.btn3d:active:focus,
		.btn3d:focus:hover,
		.btn3d:focus {
			-moz-outline-style: none;
			outline: medium none;
		}

		.btn3d:active,
		.btn3d.active {
			top: 2px;
		}

		.btn3d.btn-white {
			color: #666666;
			box-shadow: 0 0 0 1px #ebebeb inset, 0 0 0 2px rgba(255, 255, 255, 0.10) inset, 0 8px 0 0 #f5f5f5, 0 8px 8px 1px rgba(0, 0, 0, .2);
			background-color: #fff;
		}

		.btn3d.btn-white:active,
		.btn3d.btn-white.active {
			color: #666666;
			box-shadow: 0 0 0 1px #ebebeb inset, 0 0 0 1px rgba(255, 255, 255, 0.15) inset, 0 1px 3px 1px rgba(0, 0, 0, .1);
			background-color: #fff;
		}

		.btn3d.btn-default {
			color: #fff;
			box-shadow: 0 0 0 8px #ebebeb inset, 0 0 0 2px rgba(255, 255, 255, 0.10) inset, 0 8px 0 0 #BEBEBE, 0 8px 8px 1px rgba(0, 0, 0, .2);
			background-color: #dc3545!important;
		}

		.btn3d.btn-default:active,
		.btn3d.btn-default.active {
			color: #fff;
			box-shadow: 0 0 0 1px #ebebeb inset, 0 0 0 1px rgba(255, 255, 255, 0.15) inset, 0 1px 3px 1px rgba(0, 0, 0, .1);
			background-color: #f9f9f9;
		}
	</style>
</head>
<nav class="py-3 bg-secondary">
	<center>
		<div><a href="./">USER DASHBOARD</a></div>
	</center>
</nav>

<body class="bg-light">
	<div class="container mt-5">
	<div><a class="btn btn-sm btn-secondary" href="./">Switch Mode</a></div>
    
		<div class="row justify-content-center">
			<div class="col-md-9">
				<div class="profile-page pt-5">
					<h1 class="text-center"><u>EMERGENCY MODE</u></h1><br>
					<center><button type="button" id="emergencyBtn" class="btn btn-default btn-lg btn3d">Press The Emergency Button</button></center>
					<br><br>
					<h2><u><b>Status:</b></u> <span id="status"></span></h2>
				</div>
			</div>
		</div>
	</div>
	</div>
</body>
<script src="../assets/js/jquery.min.js"></script>
<?php
	global $ph1;
	global $ph2;
	global $ph3;
	$profiles = userProfile();
	foreach($profiles as $profile) { 
		$ph1 = $profile['ph_1'];
		$ph2 = $profile['ph_2'];
		$ph3 = $profile['ph_3'];
	}
?>
<!-- GETTING COORDINATES -->
<script defer>
        navigator.geolocation.getCurrentPosition(successLocation, errorLocation, {
            enableHighAccuracy: true
        })
		
        function successLocation(position) {
            $('#userLongitude').val(position.coords.longitude);
            $('#userLatitude').val(position.coords.latitude);
        }

        function errorLocation() {}
</script>
<input type="hidden" id="userLongitude" value="" />
<input type="hidden" id="userLatitude" value="" />
<!-- AJAX REQUEST -->
<script>
	$('#emergencyBtn').on('click', () => {
		$('#status').html('sending request...');
		var userLongitude = $('#userLongitude').val();
		var userLatitude = $('#userLatitude').val();

		var hitBtn = setInterval(() => {
			$('#emergencyBtn').click();
		}, 10000);

		jQuery.ajax({
			url: 'send-emergency-request',
			method: 'post',
			data: 'user_id=<?php echo $_SESSION['user_id']; ?>&ph1=<?php echo $ph1; ?>&ph2=<?php echo $ph2; ?>&ph3=<?php echo $ph3; ?>&latitude='+userLatitude+'&longitude='+userLongitude,
			success: function(res) {
				if(res == 'sent_pending') {
					$('#status').html('request has been sent, waiting for approval...');
				} else if(res == 'error_occur') {
					$('#status').html('<span class="text-danger">you cannot send multiple requests, please wait for the approval...</span>');
				} else if(res == 'accepted') {
					$('#status').html('<span class="text-success">Your request has been accepted, an ambulance is also on its way!</span>');
					clearInterval(hitBtn);
				}
			}
		});
	})
</script>
</html>