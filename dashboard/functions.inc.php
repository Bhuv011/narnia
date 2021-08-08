<?php
$conn = new mysqli('localhost', 'root', '', 'xhacks') or die(mysqli_errno());
date_default_timezone_set('Asia/Kolkata');

//global hospital validation
session_start();
function checkSessHosp() {
    if(!isset($_SESSION['hosp_id'])) {
        header('location: ./login.php');
        die();
    } else {
        session_regenerate_id();
    }
}

//global user validation
function checkSessUser() {
    if(!isset($_SESSION['user_id'])) {
        header('location: ../../sign-in.php');
        die();
    } else {
        session_regenerate_id();
    }
}

//global ambulance validation
function checkSessAmbul() {
    if(!isset($_SESSION['ambulance_id'])) {
        header('location: ./index.php');
        die();
    } else {
        session_regenerate_id();
    }
}

//functions
function loginHospital() {
    $email = $password = null;

    global $formErrors;
    $formErrors = array();
    if(empty($_POST['email'])) {
        array_push($formErrors, 'Email cannot remain empty!');
    }
    if(empty($_POST['password'])) {
        array_push($formErrors, 'Password cannot remain empty!');
    }

    if(empty($formErrors)) {
        global $conn;
        $email = $_POST['email'];
        $password = $_POST['password'];

        $stmt = $conn->prepare("SELECT * FROM `hospital` WHERE `email` = ?");
        $stmt->bind_param('s', $email);
        $stmt->execute();

        if($stmt) {
            $result = $stmt->get_result();
            if($result) {
                $row = $result->fetch_assoc();
                if($row) {
                    $hashed_password = $row['password'];
                    if(password_verify($password, $hashed_password)) {
                        $_SESSION['hosp_id'] = $row['id'];
                        header('location: ./');
                        die();
                    } else {
                        array_push($formErrors, 'Please enter valid login details!');
                    }
                } else {
                    array_push($formErrors, 'Please enter valid login details!');
                }
            } else {
                array_push($formErrors, 'Please enter valid login details!');
            }
        } else {
            array_push($formErrors, 'Please enter valid login details!');
        }
    }
}

function logoutHospital() {
    unset($_SESSION['hosp_id']);
    header('location: ./login.php');
    die();
}

function loginAmbulance() {
    $email = $password = null;

    global $formErrors;
    $formErrors = array();
    if(empty($_POST['email'])) {
        array_push($formErrors, 'Email cannot remain empty!');
    }
    if(empty($_POST['password'])) {
        array_push($formErrors, 'Password cannot remain empty!');
    }

    if(empty($formErrors)) {
        global $conn;
        $email = $_POST['email'];
        $password = $_POST['password'];

        $stmt = $conn->prepare("SELECT * FROM `ambulance` WHERE `email` = ?");
        $stmt->bind_param('s', $email);
        $stmt->execute();

        if($stmt) {
            $result = $stmt->get_result();
            if($result) {
                $row = $result->fetch_assoc();
                if($row) {
                    $hashed_password = $row['password'];
                    if(password_verify($password, $hashed_password)) {
                        $_SESSION['ambulance_id'] = $row['id'];
                        header('location: ./dashboard.php');
                    } else {
                        array_push($formErrors, 'Please enter valid login details!');
                    }
                } else {
                    array_push($formErrors, 'Please enter valid login details!');
                }
            } else {
                array_push($formErrors, 'Please enter valid login details!');
            }
        } else {
            array_push($formErrors, 'Please enter valid login details!');
        }
    }
}


function loginUser() {
    $email = $password = null;

    global $formErrors;
    $formErrors = array();
    if(empty($_POST['email'])) {
        array_push($formErrors, 'Email cannot remain empty!');
    }
    if(empty($_POST['password'])) {
        array_push($formErrors, 'Password cannot remain empty!');
    }

    if(empty($formErrors)) {
        global $conn;
        $email = $_POST['email'];
        $password = $_POST['password'];

        $stmt = $conn->prepare("SELECT * FROM `user` WHERE `email` = ?");
        $stmt->bind_param('s', $email);
        $stmt->execute();

        if($stmt) {
            $result = $stmt->get_result();
            if($result) {
                $row = $result->fetch_assoc();
                if($row) {
                    $hashed_password = $row['password'];
                    if(password_verify($password, $hashed_password)) {
                        $_SESSION['user_id'] = $row['id'];
                        header('location: dashboard/user/');
                    } else {
                        array_push($formErrors, 'Please enter valid login details!');
                    }
                } else {
                    array_push($formErrors, 'Please enter valid login details!');
                }
            } else {
                array_push($formErrors, 'Please enter valid login details!');
            }
        } else {
            array_push($formErrors, 'Please enter valid login details!');
        }
    }
}

function signupUser() {
    $email = $phone = $password = null;
    global $formErrors;
    $formErrors = array();

    if(empty($_POST['email'])) {
        array_push($formErrors, 'Email field cannot remain empty!');
    } else {
        if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        array_push($formErrors, 'This is not a valid email!');
        }
    }

    if(empty($_POST['phone'])) {
        array_push($formErrors, 'Phone field cannot remain empty!');
    } else {
        if(!is_numeric($_POST['phone'])) {
            array_push($formErrors, 'Phone number can only contain numbers!');
        } else {
            if(strlen($_POST['phone']) !== 10) {
                array_push($formErrors, 'A phone number can have only 10 digits!');
            }
        }
    }

    if(empty($_POST['password'])) {
        array_push($formErrors, 'Password field cannot remain empty!');
    } else {
        if(strlen($_POST['password']) < 6 || strlen($_POST['password']) > 30) {
            array_push($formErrors, 'Password can have only 6 - 30 characters');
        }
    }

    if(isDataExists($_POST['email'], $_POST['phone']) == true) {
        array_push($formErrors, 'User with the same details already exists!');
    }

    if(empty($formErrors)) {
        global $conn;
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $stmt = $conn->prepare("INSERT INTO `user`(`email`,`phone`,`password`) VALUES(?, ?, ?)");
        $stmt->bind_param('sis', $email, $phone, $password);
        $stmt->execute();

        if($stmt) {
            echo '<script>alert("Your account has been activated!")</script>';
        } else {
            array_push($formErrors, 'An error occurred while registering the account, Please try again later!');
        }
    }
}

function userProfile() {
    global $conn;
    $sessUserId = $_SESSION['user_id'];
    $rows = array();
    
    $stmt = $conn->prepare("SELECT * FROM `user` WHERE `id` = ?");
    $stmt->bind_param('i', $sessUserId);
    $stmt->execute();
    if($stmt) {
        $result = $stmt->get_result();
        if($result) {
            while($row = $result->fetch_assoc()) {
                array_push($rows, $row);
            }
            return $rows;
        }
    }
}



function isDataExists($paramEmail, $paramPhone) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM `user` WHERE `email` = ? OR `phone` = ?");
    $stmt->bind_param('ss', $paramEmail, $paramPhone);
    $stmt->execute();
    if($stmt) {
        $stmt->store_result();
        $data = $stmt->num_rows();
        if($data > 0) {
            return true;
        } else {
            return false;
        }
    }
}


function updateUserProfile() {
    $name = $health_problems = $address = $ph1 = $ph2 = $ph3 = null;
    global $formErrors;
    $formErrors = array();


    if(empty($_POST['name'])) {
        array_push($formErrors, 'Name field cannot remain empty!');
    }

    if(empty($_POST['ph1']) || empty($_POST['ph2']) || empty($_POST['ph3'])) {
        array_push($formErrors, 'Please fill out all your preferred hospitals!');
    }

    if(empty($_POST['health_problems'])) {
        array_push($formErrors, 'Please fill out your health related problems!');
    }

    if(empty($_POST['address'])) {
        array_push($formErrors, 'Please fill out your address!');
    }

    if(empty($formErrors)) {
        global $conn;
        $name = $_POST['name'];
        $health_problems = $_POST['health_problems'];
        $address = $_POST['address'];
        $ph1 = $_POST['ph1'];
        $ph2 = $_POST['ph2'];
        $ph3 = $_POST['ph3'];
        
        $stmt = $conn->prepare("UPDATE `user` SET `name` = ?, `health_problems` = ?, `address` = ?, `ph_1` = ?, `ph_2` = ?, `ph_3` = ? WHERE `id` = ?");
        $stmt->bind_param('sssiiii', $name, $health_problems, $address, $ph1, $ph2, $ph3, $_SESSION['user_id']);
        $stmt->execute();
        if($stmt) {
            echo '<script>alert("Your profile has been updated!")</script>';
        } else {
            array_push($formErrors, 'An error occurred while updating your profile, Please try again later!');
        }
    }
}

function getHospitalList() {
    global $conn;
    $rows = array();

    $stmt = $conn->prepare("SELECT `id`, `name` FROM `hospital`");
    $stmt->execute();
    if($stmt) {
        $result = $stmt->get_result();
        if($result) {
            while($row = $result->fetch_assoc()) {
                array_push($rows, $row);
            }
            return $rows;
        }
    }
}

function logoutUser() {
    unset($_SESSION['user_id']);
    header('location: ../../sign-in.php');
    die();
}


function sendHospitalsRequest() {
    global $conn;
    $userId = $_POST['user_id'];
    $ph1 = $_POST['ph1'];
    $ph2 = $_POST['ph2'];
    $ph3 = $_POST['ph3'];
    $userLatitude = $_POST['latitude'];
    $userLongitude = $_POST['longitude'];

    $stmt = $conn->prepare("SELECT * FROM `request` WHERE `user_id` = ?");
    $stmt->bind_param('s', $userId);
    $stmt->execute();

    if($stmt) {
        $stmt->store_result();
        $data = $stmt->num_rows();
        if($data >= 3) {
            if(checkAcceptance() == true) {
                echo 'accepted';
            } else {
                echo 'error_occur';
            }
        } else {
            $arrs = array($ph1,  $ph2, $ph3);

            for($i = 1; $i <= count($arrs); $i++) {
                $ords = $i - 1;
                $dateNow = date('Y-m-d');
                mysqli_query($conn, "INSERT INTO `request`(`user_id`, `hospital_id`, `status`, `request_sent_on`, `latitude`, `longitude`) VALUES('$userId', '$arrs[$ords]', 'pending', '$dateNow', '$userLatitude', '$userLongitude')");
            }
            echo 'sent_pending';
        }
    }
}

function checkAcceptance() {
    global $conn;
    $userId = $_SESSION['user_id'];

    $stmt = $conn->prepare("SELECT * FROM `request` WHERE `user_id` = ? AND `status` = 'accepted'");
    $stmt->bind_param('i', $userId);
    $stmt->execute();

    if($stmt) {
        $stmt->store_result();
        $res = $stmt->num_rows();

        if($res > 0) {
            return true;
        } else {
            return false;
        }
    }
}


function totalAccepted() {
    global $conn;
    $hospSessId = $_SESSION['hosp_id'];

    $stmt = $conn->prepare("SELECT * FROM `request` WHERE `hospital_id` = ? AND `status` = 'accepted'");
    $stmt->bind_param('i', $hospSessId);
    $stmt->execute();

    if($stmt) {
        $stmt->store_result();
        echo $stmt->num_rows();  
    }
}

function totalRejected() {
    global $conn;
    $hospSessId = $_SESSION['hosp_id'];

    $stmt = $conn->prepare("SELECT * FROM `request` WHERE `hospital_id` = ? AND `status` = 'rejected'");
    $stmt->bind_param('i', $hospSessId);
    $stmt->execute();

    if($stmt) {
        $stmt->store_result();
        echo $stmt->num_rows();  
    }
}

function totalRequests() {
    global $conn;
    $hospSessId = $_SESSION['hosp_id'];

    $stmt = $conn->prepare("SELECT * FROM `request` WHERE `hospital_id` = ?");
    $stmt->bind_param('i', $hospSessId);
    $stmt->execute();

    if($stmt) {
        $stmt->store_result();
        echo $stmt->num_rows();  
    }
}

function registrationDate() {
    global $conn; 

    $hospSessId = $_SESSION['hosp_id'];

    $stmt = $conn->prepare("SELECT * FROM `hospital` WHERE `id` = ?");
    $stmt->bind_param('i', $hospSessId);
    $stmt->execute();

    if($stmt) {
        $result = $stmt->get_result();
        if($result) {
            $row = $result->fetch_assoc();
            if($row) {
                echo date('d M Y', strtotime($row['date']));
            }
        } 
    }
}

function userRequest() {
    global $conn;
    $hospSessId = $_SESSION['hosp_id'];
    $stmt = $conn->prepare("SELECT request.user_id, user.name, user.phone FROM request JOIN user ON user.id = request.user_id WHERE `hospital_id` = ? AND `status` = 'pending' LIMIT 1");
    $stmt->bind_param('i', $hospSessId);
    $stmt->execute();

    if($stmt) {
        $result = $stmt->get_result();
        if($result) {
            $row = $result->fetch_assoc();
            if($row) {
                $user_id = $row['user_id'];
                $user_name = $row['name'];
                $user_phone = $row['phone'];

                //JSON format
                $rows = array("user_id" => "$user_id", "user_name" => $user_name, "user_phone" => $user_phone);
                $JSON = json_encode($rows);
                echo $JSON;
            } else {
                echo 0;
            }            
        } else {
            echo 0;
        }
    } else {
        echo 0;
    }
}

function getAmbulanceHospitalId() {
    global $conn;
    $ambuSessId = $_SESSION['ambulance_id'];
    $stmt = $conn->prepare("SELECT * FROM `ambulance` WHERE `id` = ?");
    $stmt->bind_param('i', $ambuSessId);
    $stmt->execute();
    if($stmt) {
        $result = $stmt->get_result();
        if($result) {
            $row = $result->fetch_assoc();
            if($row) {
                return $row['associated_hospital'];
            }
        }
    }
}

function checkDispatchRequest() {
    global $conn;
    $associatedHospital = getAmbulanceHospitalId();
    $stmt = $conn->prepare("SELECT `latitude`, `longitude`, `user_id` FROM `request` WHERE `hospital_id` = ? AND `status` = 'accepted' AND `dispatch_status` = 'not_dispatched'");
    $stmt->bind_param('i', $associatedHospital);
    $stmt->execute();

    if($stmt) {
        $result = $stmt->get_result();
        if($result) {
            $row = $result->fetch_assoc();
            if($row) {
                $latitude = $row['latitude'];
                $longitude = $row['longitude'];
                $user_id = $row['user_id'];

                //JSON format
                $rows = array("latitude" => "$latitude", "longitude" => $longitude, "user_id" => "$user_id");
                $JSON = json_encode($rows);
                echo $JSON;
            } else {
                echo 0;
            }            
        } else {
            echo 0;
        }
    } else {
        echo 0;
    }
}

function checkOtherHospitalActions($userId) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM `request` WHERE `user_id` = ? AND `status` = 'accepted'");
    $stmt->bind_param('i', $userId);
    $stmt->execute();
    if($stmt) {
        $stmt->store_result();
        $result = $stmt->num_rows();
    }
    return $result;
}

function acceptRequest() {
    global $conn;
    $sessHospId = $_SESSION['hosp_id'];
    $user_id = $_GET['id'];

    if(checkOtherHospitalActions($_GET['id']) > 0) {
        echo 'Request has been accepted by another hospital. Redirecting you to the dashboard in 5 seconds...';
        header('refresh: 5; url=./');
    } else {
        $stmt = $conn->prepare("UPDATE `request` SET `status` = 'accepted', `dispatch_status` = 'not_dispatched' WHERE `hospital_id` = ? AND `user_id` = ?");
        $stmt->bind_param('ii', $sessHospId, $user_id);
        $stmt->execute();
        if($stmt) {
            notAcceptedByOtherHospitals($user_id);
            echo 'The request has been assigned to you, please dispatch an ambulance at the earliest. Redirecting you to the dashboard in 8 seconds...';
            header('refresh: 8; url=./');
        }
    }
}

function rejectRequest() {
    global $conn;
    $sessHospId = $_SESSION['hosp_id'];
    $user_id = $_GET['id'];
    
    $stmt = $conn->prepare("UPDATE `request` SET `status` = 'rejected' WHERE `hospital_id` = ? AND `user_id` = ?");
    $stmt->bind_param('ii', $sessHospId, $user_id);
    $stmt->execute();
    if($stmt) {
        header('location: ./');
    }
}

function notAcceptedByOtherHospitals($user_id) {
    global $conn;
    $sessHospId = $_SESSION['hosp_id'];

    $stmt = $conn->prepare("UPDATE `request` SET `status` = 'failed' WHERE `hospital_id` != ? AND `user_id` = ? AND `status` = 'pending'");
    $stmt->bind_param('ii', $sessHospId, $user_id);
    $stmt->execute();
}

function hospitalName() {
    global $conn;    

    if(!isset($_SESSION['hosp_id'])) {
        echo 'Sign In';
    } else {
        $sessHospId = $_SESSION['hosp_id'];
        $stmt = $conn->prepare("SELECT * FROM `hospital` WHERE id = ?");
        $stmt->bind_param('i', $sessHospId);
        $stmt->execute();

        if($stmt) {
            $result = $stmt->get_result();
            if($result) {
                $row = $result->fetch_assoc();
                if($row) {
                    echo $row['name'];
                }
            }
        }
    }
}

function listOfUsersToHospital($status) {
    global $conn;
    $sessHospId = $_SESSION['hosp_id'];
    $rows = array();

    $stmt = $conn->prepare("SELECT user.name, user.age, user.email, user.phone, user.health_problems, user.address, request.request_sent_on, request.status FROM `user` JOIN `request` ON user.id = request.user_id WHERE request.hospital_id = ? AND request.status = ? ORDER BY request.id DESC");
    $stmt->bind_param('is', $sessHospId, $status);
    $stmt->execute(); 

    if($stmt) {
        $result = $stmt->get_result();
        if($result) {
            while($row = $result->fetch_assoc()) {
                array_push($rows, $row);
            }
            return $rows;
        }
    }
}

function listOfRequestsToHospital() {
    global $conn;
    $sessHospId = $_SESSION['hosp_id'];
    $rows = array();

    $stmt = $conn->prepare("SELECT user.name, user.age, user.email, user.phone, user.health_problems, user.address, request.request_sent_on, request.status FROM `user` JOIN `request` ON user.id = request.user_id WHERE request.hospital_id = ? ORDER BY request.id DESC LIMIT 15");
    $stmt->bind_param('i', $sessHospId);
    $stmt->execute(); 

    if($stmt) {
        $result = $stmt->get_result();
        if($result) {
            while($row = $result->fetch_assoc()) {
                array_push($rows, $row);
            }
            return $rows;
        }
    }
}

function getNumberOfPatients($date) {
    global $conn;
    $sessHospId = $_SESSION['hosp_id'];

    $newDate = date('Y-m-d', strtotime($date));

    $res = mysqli_query($conn, "SELECT * FROM `request` WHERE `hospital_id` = '$sessHospId' AND `request_sent_on` =  '$newDate'");
    $number = mysqli_num_rows($res);
    if($number > 0) {
        echo $number;
    } else {
        echo '0';
    }
}

function updateBeds() {
    global $conn;
    $beds = $_GET['beds'];
    $hospSessId = $_SESSION['hosp_id'];

    $stmt = $conn->prepare("UPDATE `hospital` SET `beds` = ? WHERE `id` = ?");
    $stmt->bind_param('ii', $beds, $hospSessId);
    $stmt->execute(); 

    if($stmt) {
        echo 'Number of beds have been updated!';
    } else {
        echo 'An error ocurred while updating the number of beds, please try again later!';
    }
}

function numberOfBeds() {
    global $conn;
    $hospSessId = $_SESSION['hosp_id'];

    $stmt = $conn->prepare("SELECT `beds` FROM `hospital` WHERE `id` = ?");
    $stmt->bind_param('i', $hospSessId);
    $stmt->execute(); 

    if($stmt) {
        $result = $stmt->get_result();
        if($result) {
            $row = $result->fetch_assoc();
            if($row) {
                echo $row['beds'];
            } else {
                echo 'N/A';
            }
        } else {
            echo 'N/A';
        }
    } else {
        echo 'N/A';
    }
}

function updateDispatchStatus() {
    global $conn;
    $user_id = $_GET['user_id'];
    $sessAmbuId = $_SESSION['ambulance_id'];
    $hospitalId = getAmbulanceHospitalId();
    
    $stmt = $conn->prepare("UPDATE `request` SET `dispatch_status` = 'dispatched' WHERE `hospital_id` = ? AND `user_id` = ? AND `status` = 'accepted'");
    $stmt->bind_param('ii', $hospitalId, $user_id);
    $stmt->execute();
}
?>