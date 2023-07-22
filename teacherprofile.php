<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>One Oath: Teacher Profile</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  </head>
  <body class="p-3 m-3 border-0 bd-example m-0 border-0">


  <?php

session_start();


$data = null;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['Email']) && isset($_POST['Password'])) {
        $Email = $_POST['Email'];
        $Password = $_POST['Password'];

        # Database Connection
        $conn = new mysqli("localhost", "root", "", "users");
        if ($conn->connect_error) {
            die("Failed to connect: " . $conn->connect_error);
        } else {
            $stmt = $conn->prepare("SELECT * FROM teachers WHERE Email = ?");
            $stmt->bind_param("s", $Email);
            $stmt->execute();
            $stmt_result = $stmt->get_result();
            if ($stmt_result->num_rows > 0) {
                $data = $stmt_result->fetch_assoc();
                if ($data["Password"] === $Password) {
                   
                    $_SESSION['user_data'] = $data;
                    
                    header("Location: teacherdashboard.php");
                    exit; // Exit after redirection to prevent further code execution
                } else {
                  header("Location: error.html");
                }
            } else {
              header("Location: error.html");
            }
        }
    } else {
      header("Location: error.html");
    }
}
?>
<div>
<nav class="navbar bg-body-tertiary fixed-top">
      <div class="container-fluid">
        <a class="navbar-brand" href="#"><h1>Profile</h1></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
          <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasNavbarLabel">One Oath</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>
          <div class="offcanvas-body">
            <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
              <li class="nav-item">
                <a class="nav-link " aria-current="page" href="teacherdashboard.php">DashBoard</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="teacherprofile.php">Profile</a>
              </li>    
            </ul>
            <a href="logout.php"><button type="button" class="btn btn-success" style="margin-top: 5%;">log Out</button></a>
          </div>
        </div>
      </div>
    </nav>

    <div>
     
<div class="student-profile py-4">
  <div class="container">
    <div class="row p-5" >
      <div class="col-lg-4 " >
        <div class="card shadow-sm p-5" >
          <div class="card-header bg-transparent text-center">
            <h3><?php
            // Check if user data is available in the session and display the user's name
            if (isset($_SESSION['user_data'])) {
                echo  $_SESSION['user_data']['Name'];
            }
            ?></h3>
          </div>
          <div class="card-body">
            <p class="mb-0 p-3"><strong class="pr-1">Teacher ID  :  </strong><?php
            // Check if user data is available in the session and display the user's name
            if (isset($_SESSION['user_data'])) {
                echo  $_SESSION['user_data']['TID'];
            }
            ?></p>
            <p class="mb-0 p-3"><strong class="pr-1">Email  :  </strong><?php
            // Check if user data is available in the session and display the user's name
            if (isset($_SESSION['user_data'])) {
                echo  $_SESSION['user_data']['Email'];
            }
            ?></p>
            <p class="mb-0 p-3"><strong class="pr-1">Password  :  </strong><?php
            // Check if user data is available in the session and display the user's name
            if (isset($_SESSION['user_data'])) {
                echo  $_SESSION['user_data']['Password'];
            }
            ?></p>
          </div>
        </div>
      </div>
      <div class="col-lg-8">
        <div class="card shadow-sm">
          <div class="card-header bg-transparent border-0 p-5" >
            <h3 class="mb-0"><i class="far fa-clone pr-1"></i>General Information</h3>
          </div>
          <div class="card-body pt-0 p-5">
            <table class="table table-bordered">
              <tr>
                <th width="30%">Name</th>
                <td width="2%">:</td>
                <td><?php
            // Check if user data is available in the session and display the user's name
            if (isset($_SESSION['user_data'])) {
                echo  $_SESSION['user_data']['Name'];
            }
            ?></td>
              </tr>
              <tr>
                <th width="30%">Subject	</th>
                <td width="2%">:</td>
                <td><?php
            // Check if user data is available in the session and display the user's name
            if (isset($_SESSION['user_data'])) {
                echo  $_SESSION['user_data']['Subject'];
            }
            ?></td>
              </tr>
              <tr>
                <th width="30%">Contact</th>
                <td width="2%">:</td>
                <td><?php
            // Check if user data is available in the session and display the user's name
            if (isset($_SESSION['user_data'])) {
                echo  $_SESSION['user_data']['Contact'];
            }
            ?></td>
              </tr>
              <tr>
                <th width="30%">Age</th>
                <td width="2%">:</td>
                <td><?php
            // Check if user data is available in the session and display the user's name
            if (isset($_SESSION['user_data'])) {
                echo  $_SESSION['user_data']['Age'];
            }
            ?></td>
              </tr>
              <tr>
                <th width="30%">City</th>
                <td width="2%">:</td>
                <td><?php
            // Check if user data is available in the session and display the user's name
            if (isset($_SESSION['user_data'])) {
                echo  $_SESSION['user_data']['City'];
            }
            ?></td>
              </tr>
            </table>
          </div>
        </div>
    </div>

<footer>
    <p>&copy; 2023 by ONE OATH.</p>
</footer>


</body>
</HTML>