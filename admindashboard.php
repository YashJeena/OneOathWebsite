<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>One Oath: Admin DashBoard</title>
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
                $stmt = $conn->prepare("SELECT * FROM admins WHERE Email = ?");
                $stmt->bind_param("s", $Email);
                $stmt->execute();
                $stmt_result = $stmt->get_result();
                if ($stmt_result->num_rows > 0) {
                    $data = $stmt_result->fetch_assoc();
                    if ($data["Password"] === $Password) {
                        $_SESSION['user_data'] = $data;
                        header("Location: admindashboard.php");
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
        <a class="navbar-brand" href="#"><h1>DashBoard</h1></a>
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
                <a class="nav-link active" aria-current="page" href="admindashboard.php">DashBoard</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="adminprofile.php">Profile</a>
              </li>
            </ul>
            <a href="logout.php"><button type="button" class="btn btn-success" style="margin-top: 5%;">log Out</button></a>
          </div>
        </div>
      </div>
    </nav>
    

</div>

<div class="cardbox">
    <div class="card" style="width: 18rem;">
        <img src="student_logo.png" class="student_logo" alt="student_logo">
        <div class="card-body">
            <?php
            // Check if user data is available in the session and display the user's name
            if (isset($_SESSION['user_data'])) {
                echo "<h5 class='card-title'><h3>Hi! " . $_SESSION['user_data']['Name'] . "</h3></h5>";
            }
            ?>
        </div>
    </div>
    <div class="row" style="margin-top: 5%;">
  <div class="col-sm-6 mb-3 mb-sm-0 ">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">DATABASE</h5>
        <p class="card-text">Create,Manage,and Delete databse tables for users Student,Teacher,Admins.</p>
        <a href="http://localhost/phpmyadmin/index.php?route=/database/structure&db=users" class="btn btn-primary">Database</a>
      </div>
    </div>
  </div>
  <div class="col-sm-6" >
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">PROFILE</h5>
        <p class="card-text">Comprehensive admin profile highlighting management progress of user as admin.</p>
        <a href="adminprofile.php" class="btn btn-primary">Profile</a>
      </div>
    </div>
  </div>
</div>
  </div>

  <div>
  <div class="card">
  <h5 class="card-header">COURSES</h5>
  <div class="card-body">
  <div class="row row-cols-1 row-cols-md-3 g-4">
  <div class="col">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Machine Learning</h5>
        <p class="card-text">Machine learning is a field of AI that enables systems to learn patterns from data and make intelligent decisions without explicit programming.</p>
        <a href="https://www.geeksforgeeks.org/machine-learning/"><button type="button" class="btn btn-primary ">Get Started</button></a>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Image Processing</h5>
        <p class="card-text">Image processing is the manipulation of digital images to enhance, analyze, or extract information for various applications and visual understanding.</p>
        <a href="https://www.geeksforgeeks.org/digital-image-processing-basics/"><button type="button" class="btn btn-primary ">Get Started</button></a>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Data Science</h5>
        <p class="card-text">Data science is an interdisciplinary field that uses scientific methods, algorithms, and tools to extract knowledge and insights from data.</p>
        <a href="https://www.geeksforgeeks.org/what-is-data-science/"><button type="button" class="btn btn-primary ">Get Started</button></a></a>
      </div>
    </div>
  </div>
  </div>
</div>
  </div>
    

<footer>
    <p>&copy; 2023 by ONE OATH.</p>
</footer>





  </body>
</html>
