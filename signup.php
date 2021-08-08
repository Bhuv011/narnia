<?php
    include 'dashboard/functions.inc.php';
    if(isset($_POST['submit'])) {
        signupUser();
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Sign Up</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="title" content="Sign Up" />
    <meta name="theme-color" content="#ffffff" />
    <link type="text/css" href="dashboard/assets/css/bootstrap.css" rel="stylesheet" />
</head>

<body>
    <main>
        <section class="vh-lg-100 mt-5 mt-lg-0 bg-soft d-flex align-items-center">
            <div class="container mt-5">
                <div class="row justify-content-center form-bg-image"
                    data-background-lg="dashboard/assets/img/illustrations/signin.svg">
                    <div class="col-12 d-flex align-items-center justify-content-center">
                        <div class="bg-white shadow border-0 rounded border-light p-4 p-lg-5 w-100 fmxw-500">
                            <div class="text-center text-md-center mb-4 mt-md-0">
                                <h1 class="mb-0 h3">Create Account</h1>
                            </div>
                            <form action="" method="POST" class="mt-4">
                                <div class="form-group mb-4">
                                    <label for="email">Your Email</label>
                                    <div class="input-group">
                                        <input type="email" class="form-control" placeholder="example@company.com"
                                            id="email" name="email" autofocus required value="<?php echo isset($_POST['submit']) && isset($_POST['email']) ? $_POST['email'] : null ?>" />
                                    </div>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="confirm_password">Phone
                                    </label>
                                    <div class="input-group">
                                        <input type="text" placeholder="9811679046" class="form-control" name="phone"
                                            required maxlength="10" value="<?php echo isset($_POST['submit']) && isset($_POST['phone']) ? $_POST['phone'] : null ?>" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-group mb-4">
                                        <label for="password">Your
                                            Password</label>
                                        <div class="input-group">

                                            <input type="password" placeholder="*******" class="form-control" required
                                                name="password" value="<?php echo isset($_POST['submit']) && isset($_POST['password']) ? $_POST['password'] : null ?>" />
                                        </div>
                                    </div>
                                </div>
                                <div class="d-grid">
                                    <button type="submit" name="submit" class="btn btn-gray-800">
                                        Sign up
                                    </button>
                                </div>
                            </form>
                            <p class="mt-4 text-danger"><?php include 'dashboard/_formErrors.php'; ?></p>
                            <div class="d-flex justify-content-center align-items-center mt-4">
                                <span class="fw-normal">
                                    Already have an account?
                                    <a href="./sign-in.php" class="fw-bold">Login here</a>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</body>

</html>