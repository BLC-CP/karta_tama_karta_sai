<?php
session_start(); // Start the session

// Redirect to the dashboard if already logged in
if (isset($_SESSION['email'])) {
    header("Location: ../"); // Redirect to the dashboard or desired page
    exit(); 
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['loginkarta'])) {
    // Database connection
    $conn = new mysqli("localhost", "root", "", "kartamci");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error); 
    }

    $email = htmlspecialchars(trim($_POST['email']));
    $password = $_POST['password'];

    // Prepare a statement to avoid SQL injection
    $stmt = $conn->prepare("SELECT id_admin, id_direksaun, password FROM tb_admin WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    // Check if email exists
    if ($stmt->num_rows > 0) {
        // Fetch id_admin and the hashed password from the database
        $stmt->bind_result($id_admin, $id_direksaun, $hashed_password);
        $stmt->fetch();

        // Verify the password
        if (password_verify($password, $hashed_password)) {
            // Successful login, start session and store user data
            $_SESSION['email'] = $email; // Store the user email in session
            $_SESSION['id_admin'] = $id_admin; // Store the admin ID in session
            $_SESSION['id_direksaun'] = $id_direksaun; // Store the admin ID in session
            header("Location: ../"); // Redirect to the dashboard or desired page
            exit();
        } else {
            // Invalid password
            $error_message = "Username ka password sala";
        }
    } else {
        // Email not found
        $error_message = "Username ka password sala";
    }

    $stmt->close();
    $conn->close(); 
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login Page</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />

      <meta name="keywords" content="bootstrap, bootstrap admin template, admin theme, admin dashboard, dashboard template, admin template, responsive" />
      <meta name="author" content="Codedthemes" />
      <!-- Favicon icon -->

      <link rel="icon" href="../assets/images/favicon.ico" type="image/x-icon">
      <!-- Google font-->
      <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet">
      <!-- Required Fremwork -->
      <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap/css/bootstrap.min.css">
      <!-- waves.css -->
      <link rel="stylesheet" href="../assets/pages/waves/css/waves.min.css" type="text/css" media="all">
      <!-- themify-icons line icon -->
      <link rel="stylesheet" type="text/css" href="../assets/icon/themify-icons/themify-icons.css">
      <!-- ico font -->
      <link rel="stylesheet" type="text/css" href="../assets/icon/icofont/css/icofont.css">
      <!-- Font Awesome -->
      <link rel="stylesheet" type="text/css" href="../assets/icon/font-awesome/css/font-awesome.min.css">
      <!-- Style.css -->
      <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
  </head>

  <body themebg-pattern="theme1">
  <!-- Pre-loader start -->
  <div class="theme-loader">
      <div class="loader-track">
          <div class="preloader-wrapper">
              <div class="spinner-layer spinner-blue">
                  <div class="circle-clipper left">
                      <div class="circle"></div>
                  </div>
                  <div class="gap-patch">
                      <div class="circle"></div>
                  </div>
                  <div class="circle-clipper right">
                      <div class="circle"></div>
                  </div>
              </div>
              <div class="spinner-layer spinner-red">
                  <div class="circle-clipper left">
                      <div class="circle"></div>
                  </div>
                  <div class="gap-patch">
                      <div class="circle"></div>
                  </div>
                  <div class="circle-clipper right">
                      <div class="circle"></div>
                  </div>
              </div>

              <div class="spinner-layer spinner-yellow">
                  <div class="circle-clipper left">
                      <div class="circle"></div>
                  </div>
                  <div class="gap-patch">
                      <div class="circle"></div>
                  </div>
                  <div class="circle-clipper right">
                      <div class="circle"></div>
                  </div>
              </div>

              <div class="spinner-layer spinner-green">
                  <div class="circle-clipper left">
                      <div class="circle"></div>
                  </div>
                  <div class="gap-patch">
                      <div class="circle"></div>
                  </div>
                  <div class="circle-clipper right">
                      <div class="circle"></div>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <!-- Pre-loader end -->

    <section class="login-block">
        <!-- Container-fluid starts -->
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <!-- Authentication card start -->

                    <form class="md-float-material form-material" method="post">
    <div class="text-center">
        <img src="../assets/images/logos.png" alt="logo.png" width="20%">
    </div>
    <div class="auth-box card">
        <div class="card-block"> 
            <div class="row m-b-20"> 
                <div class="col-md-12"> 
                    <h3 class="text-center">Login Administrator</h3>
                </div>

            </div>
            <div class="form-group form-primary">
                <input type="email" name="email" class="form-control" autofocus required>
                <span class="form-bar"></span>
                <label class="float-label">Email</label>
            </div>
            <div class="form-group form-primary">
                <input type="password" name="password" class="form-control" required>
                <span class="form-bar"></span>
                <label class="float-label">Password</label>
            </div>
            <div class="row m-t-25 text-left">
                <div class="col-12">
                    <div class="forgot-phone text-right f-right">
                        <a href="#" class="text-right f-w-600"> Forgot Password?</a>
                    </div>
                </div>
            </div>
            <div class="row m-t-30">
                <div class="col-md-12">
                    <button type="submit" name="loginkarta" class="btn btn-primary btn-md btn-block waves-effect waves-light text-center m-b-20">Login</button>
                </div>
            </div>
            <?php
            // Display error messages here
            if (isset($error_message)) {
                echo "<div class='alert alert-danger text-center'>$error_message</div>";
            }
            ?>
        </div>
    </div> 
</form>

                        <!-- end of form -->
                </div>
                <!-- end of col-sm-12 -->
            </div>
            <!-- end of row -->
        </div>
        <!-- end of container-fluid -->
    </section>
<script type="text/javascript" src="../assets/js/jquery/jquery.min.js "></script>
<script type="text/javascript" src="../assets/js/jquery-ui/jquery-ui.min.js "></script>
<script type="text/javascript" src="../assets/js/popper.js/popper.min.js"></script>
<script type="text/javascript" src="../assets/js/bootstrap/js/bootstrap.min.js "></script>
<!-- waves js -->
<script src="../assets/pages/waves/js/waves.min.js"></script>
<!-- jquery slimscroll js -->
<script type="text/javascript" src="../assets/js/jquery-slimscroll/jquery.slimscroll.js"></script>
<script type="text/javascript" src="../assets/js/common-pages.js"></script>
</body>

</html>
