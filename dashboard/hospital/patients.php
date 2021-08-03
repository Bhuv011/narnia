<?php
  include 'layouts/header.php';
  checkSessHosp();
  include 'layouts/sidebar.php';
  include 'layouts/navbar.php';
?>
<div class="row py-5">
<div class="row">
    <div class="col-12 col-xl-12">
        <div class="row">
            <div class="col-12 mb-4">
                <div class="card border-0 shadow">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h2 class="fs-5 fw-bold mb-0">Total Patients (<?php echo ucfirst($_GET['status']); ?>)</h2>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th class="border-bottom" scope="col">#</th>
                                    <th class="border-bottom" scope="col">Patient name</th>
                                    <th class="border-bottom" scope="col">Patient age</th>
                                    <th class="border-bottom" scope="col">Patient contact</th>
                                    <th class="border-bottom" scope="col">Date</th>
                                    <th class="border-bottom" scope="col">Status</th>
                                    <th class="border-bottom" scope="col">Patient profile</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $dataOfUsers = listOfUsersToHospital($_GET['status']);
                                    $i = 0;
                                    foreach($dataOfUsers as $dataOfUser) {
                                        $i++;
                                        if($dataOfUser['status'] == 'accepted') {
                                            $status = '<span class="text-success"><svg style="width:20px;height:20px" viewBox="0 0 24 24"><path fill="currentColor" d="M12 2C6.5 2 2 6.5 2 12S6.5 22 12 22 22 17.5 22 12 17.5 2 12 2M10 17L5 12L6.41 10.59L10 14.17L17.59 6.58L19 8L10 17Z" /></svg> Accepted</span>';
                                        } else if($dataOfUser['status'] == 'rejected') {
                                            $status = '<span class="text-danger"><svg style="width:20px;height:20px" viewBox="0 0 24 24"><path fill="currentColor" d="M13,13H11V7H13M13,17H11V15H13M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2Z" /></svg> Rejected</span>';
                                        } else if($dataOfUser['status'] == 'failed') {
                                            $status = '<span class="text-danger"><svg style="width:20px;height:20px" viewBox="0 0 24 24"><path fill="currentColor" d="M15.07,11.25L14.17,12.17C13.45,12.89 13,13.5 13,15H11V14.5C11,13.39 11.45,12.39 12.17,11.67L13.41,10.41C13.78,10.05 14,9.55 14,9C14,7.89 13.1,7 12,7A2,2 0 0,0 10,9H8A4,4 0 0,1 12,5A4,4 0 0,1 16,9C16,9.88 15.64,10.67 15.07,11.25M13,19H11V17H13M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12C22,6.47 17.5,2 12,2Z" /></svg> Was Redirected</span>';
                                        }
                                ?>
                                <tr>
                                    <td class="text-gray-900" scope="row">
                                        <?php echo $i; ?>
                                    </td>
                                    <th class="text-gray-900" scope="row">
                                        <?php echo $dataOfUser['name']; ?>
                                    </th>
                                    <td class="fw-bolder text-gray-500">
                                        <?php echo $dataOfUser['age']; ?>
                                    </td>
                                    <td class="fw-bolder text-gray-500">
                                        <?php echo $dataOfUser['phone']; ?>
                                    </td>
                                    <td class="fw-bolder text-gray-500">
                                        <?php echo date('d-M-Y', strtotime($dataOfUser['request_sent_on'])); ?>
                                    </td>
                                    <td class="fw-bolder text-gray-500">
                                        <?php echo $status; ?>
                                    </td>
                                    <td class="fw-bolder text-gray-500">
                                        <div class="d-flex">
                                            <button class="btn btn-tertiary" type="button" data-bs-toggle="modal" data-bs-target="#modalProfile<?php echo $i; ?>">View Profile</button>
                                        </div>
                                    </td>
                                </tr>
                                <!-- Modal Content -->
                                <div class="modal fade" id="modalProfile<?php echo $i; ?>" tabindex="-1" role="dialog"
                                    aria-labelledby="modalTitleNotify" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <p class="modal-title" id="modalTitleNotify">USER PROFILE or DATA</p>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="text-left">
                                                    <h2 class="h4 modal-title my-3">Request sent on <u><?php echo date('d M Y', strtotime($dataOfUser['request_sent_on'])); ?></u></h2>
                                                    <p><b>Name:</b> <?php echo $dataOfUser['name']; ?></p>
                                                    <p><b>Email:</b> <?php echo $dataOfUser['email']; ?></p>
                                                    <p><b>Phone:</b> <?php echo $dataOfUser['phone']; ?></p>
                                                    <p><b>Address:</b> <?php echo $dataOfUser['address']; ?></p>
                                                    <p><b>Age:</b> <?php echo $dataOfUser['age']; ?></p>
                                                    <p><b>Health Problems:</b> <?php echo $dataOfUser['health_problems']; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End of Modal Content -->
                                <?php }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<?php
include 'layouts/footer.php';
?>