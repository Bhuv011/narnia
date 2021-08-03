<?php
    include '../functions.inc.php';
    checkSessUser();
    if(isset($_POST['submit'])) {
        updateUserProfile();
    }
    if(isset($_POST['logout'])) {
        logoutUser();
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
</head>
<nav class="py-3 bg-secondary">
    <center><div><span>USER DASHBOARD</span></div></center>
</nav>
<body class="bg-light">
    <div class="container mt-5">
    <div><a class="btn btn-sm btn-secondary" href="emergency-mode.php" style="margin-right: 20px;">Switch Mode</a><button class="btn btn-sm btn-danger" onclick="document.getElementById('logout-user-form').submit()">Logout</button></div>
    <form action="" method="POST" id="logout-user-form">
        <input type="hidden" name="logout" />
    </form>
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="profile-page pt-5">
                    <h1 class="text-center"><u>My Profile</u></h1><br>
                    <form action="" method="POST">
                        <?php
                            $profiles = userProfile();
                            foreach($profiles as $profile) { 
                        ?>
                        <div class="mb-4">
                            <label class="form-label">Full Name</label>
                            <input type="text" class="form-control" name="name" value="<?php echo isset($_POST['submit']) && isset($_POST['name']) ? $_POST['name'] : $profile['name']; ?>" />
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Email Address</label>
                            <input type="email" class="form-control" disabled value="<?php echo $profile['email']; ?>" />
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Phone Number</label>
                            <input type="text" class="form-control" disabled value="<?php echo $profile['phone']; ?>" />
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Health Problems</label>
                            <input type="text" name="health_problems" class="form-control"
                                value="<?php echo isset($_POST['submit']) && isset($_POST['health_problems']) ? $_POST['health_problems'] : $profile['health_problems']; ?>" />
                            <div id="emailHelp" class="form-text">Write single words seperated by commas</div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Address</label>
                            <textarea name="address" rows="3" cols="2" class="form-control"><?php echo isset($_POST['submit']) && isset($_POST['address']) ? $_POST['address'] : $profile['address']; ?></textarea>
                            <div id="emailHelp" class="form-text">Please write your full address here.</div>
                        </div>
                        <?php }
                        ?>                                           
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Preferred Hospitals</label>
                                    <select class="form-control" name="ph1">
                                        <option value="" selected disabled>Preference #1</option>
                                        <?php
                                            $lists = getHospitalList();
                                            foreach($lists as $list) {
                                        ?>
                                            <option value="<?php echo $list['id'] ?>"><?php echo $list['name'] ?></option>
                                        <?php }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">&nbsp;</label>
                                    <select class="form-control" name="ph2">
                                        <option value="" selected disabled>Preference #2</option>
                                        <?php
                                            $lists = getHospitalList();
                                            foreach($lists as $list) {
                                        ?>
                                            <option value="<?php echo $list['id'] ?>"><?php echo $list['name'] ?></option>
                                        <?php }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">&nbsp;</label>
                                    <select class="form-control" name="ph3">
                                        <option value="" selected disabled>Preference #3</option>
                                        <?php
                                            $lists = getHospitalList();
                                            foreach($lists as $list) {
                                        ?>
                                            <option value="<?php echo $list['id'] ?>"><?php echo $list['name'] ?></option>
                                        <?php }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                </div>
                <br>
                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                </form>
                <br><br>
                <p class="text-danger"><?php include '../_formErrors.php'; ?></p>
            </div>
        </div>
    </div>
    </div>
</body>

</html>