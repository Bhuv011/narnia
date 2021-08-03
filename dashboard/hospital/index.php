<?php
  include 'layouts/header.php';
  checkSessHosp();
  include 'layouts/sidebar.php';
  include 'layouts/navbar.php';
?>
<div class="row py-5">
    <div class="col-12 mb-4">
        <div class="card bg-yellow-100 border-0 shadow">
            <div class="card-header d-sm-flex flex-row align-items-center flex-0">
                <div class="d-block mb-3 mb-sm-0">
                    <div class="fs-5 fw-normal mb-2">Total Patients (Today)</div>
                    <h2 class="fs-3 fw-extrabold"><?php $today = date('d M Y'); getNumberOfPatients($today); ?></h2>
                </div>
            </div>
            <div class="card-body p-2 h-100">
                <div class="ct-chart-sales-value ct-double-octave ct-series-g"></div>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-xl-4 mb-4">
        <div class="card border-0 shadow">
            <div class="card-body">
                <div class="row d-block d-xl-flex align-items-center">
                    <div
                        class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                        <div class="icon-shape icon-shape-primary rounded me-4 me-sm-0">
                            <svg class="icon" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z">
                                </path>
                            </svg>
                        </div>
                        <div class="d-sm-none">
                            <h2 class="h5">Total Requests</h2>
                            <h3 class="fw-extrabold mb-1"><?php totalRequests(); ?></h3>
                        </div>
                    </div>
                    <div class="col-12 col-xl-7 px-xl-0">
                        <div class="d-none d-sm-block">
                            <h2 class="h6 text-gray-400 mb-0">Total Requests</h2>
                            <h3 class="fw-extrabold mb-2"><?php totalRequests(); ?></h3>
                        </div>
                        <small class="d-flex align-items-center text-gray-500">
                            Since&nbsp;<u data-bs-toggle="tooltip" data-bs-placement="top"
                                title="Since hospital registration"> <?php registrationDate() ?></u>
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-xl-4 mb-4">
        <div class="card border-0 shadow">
            <div class="card-body">
                <div class="row d-block d-xl-flex align-items-center">
                    <div
                        class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                        <div class="icon-shape icon-shape-secondary rounded me-4 me-sm-0">
                            <svg class="icon" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3zm11.707 4.707a1 1 0 00-1.414-1.414L10 9.586 8.707 8.293a1 1 0 00-1.414 0l-2 2a1 1 0 101.414 1.414L8 10.414l1.293 1.293a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <div class="d-sm-none">
                            <h2 class="fw-extrabold h5">Accepted : Rejected</h2>
                            <h3 class="mb-1"><?php echo totalAccepted(); ?> : <?php echo totalRejected(); ?></h3>
                        </div>
                    </div>
                    <div class="col-12 col-xl-7 px-xl-0">
                        <div class="d-none d-sm-block">
                            <h2 class="h6 text-gray-400 mb-0">Accepted : Rejected</h2>
                            <h3 class="fw-extrabold mb-2"><?php echo totalAccepted(); ?> :
                                <?php echo totalRejected(); ?></h3>
                        </div>
                        <small class="d-flex align-items-center text-gray-500">
                            Since&nbsp;<u data-bs-toggle="tooltip" data-bs-placement="top"
                                title="Since hospital registration"> <?php registrationDate() ?></u>
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-xl-4 mb-4">
        <div class="card border-0 shadow">
            <div class="card-body">
                <div class="row d-block d-xl-flex align-items-center">
                    <div
                        class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                        <div class="icon-shape icon-shape-tertiary rounded me-4 me-sm-0">
                            <svg class="icon" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <div class="d-sm-none">
                            <h2 class="fw-extrabold h5">Beds Available</h2>
                            <h3 class="mb-1" contentEditable="true"><?php echo numberOfBeds(); ?></h3>
                        </div>
                    </div>
                    <div class="col-12 col-xl-7 px-xl-0">
                        <div class="d-none d-sm-block">
                            <h2 class="h6 text-gray-400 mb-0">Beds Available</h2>
                            <input type="hidden" id="inputBeds" value="">
                            <h3 class="fw-extrabold mb-2" contentEditable="true" id="beds"><?php echo numberOfBeds(); ?></h3>
                        </div>
                        <small class="d-flex align-items-center text-gray-500">
                            Live Updates&nbsp; <svg class="text-success" style="width:18px;height:18px"
                                viewBox="0 0 24 24">
                                <path fill="currentColor"
                                    d="M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2Z" />
                            </svg>
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 col-xl-12">
        <div class="row">
            <div class="col-12 mb-4">
                <div class="card border-0 shadow">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h2 class="fs-5 fw-bold mb-0">Recent Patients</h2>
                            </div>
                            <div class="col text-end">
                                <a href="#" class="btn btn-sm btn-primary">See all</a>
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
                                            $dataOfUsers = listOfRequestsToHospital();
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