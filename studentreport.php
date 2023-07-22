<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>One Oath: Student Report</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  </head>
  <body class="p-3 m-3 border-0 bd-example m-0 border-0">

  <?php
session_start();

if (!isset($_SESSION['user_data'])) {
    
    header("Location: studentdashboard.php");
    exit;
}

$conn = new mysqli("localhost", "root", "", "users");
if ($conn->connect_error) {
    die("Failed to connect: " . $conn->connect_error);
}

$user_data = $_SESSION['user_data'];
$user_id = $user_data['ID'];

$stmt = $conn->prepare("SELECT * FROM marks WHERE ID = ?");
$stmt->bind_param("s", $user_id);
$stmt->execute();
$stmt_result = $stmt->get_result();
if ($stmt_result->num_rows > 0){
  $row = $stmt_result->fetch_assoc();
}
?>

<div>
<nav class="navbar bg-body-tertiary fixed-top">
      <div class="container-fluid">
        <a class="navbar-brand" href="#"><h1>Report</h1></a>
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
                <a class="nav-link " aria-current="page" href="studentdashboard.php">DashBoard</a>
              </li>
              <li class="nav-item">
                <a class="nav-link " href="studentprofile.php">Profile</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="studentreport.php">Report</a>
              </li>    
            </ul>
            <a href="logout.php"><button type="button" class="btn btn-success" style="margin-top: 5%;">log Out</button></a>
          </div>
        </div>
      </div>
    </nav>

    <div class="container">
    <div class="row p-5">
        <div class="col-lg-2">
        </div>
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header bg-transparent border-0 p-5">
                    <h3 class="mb-0"><i class="far fa-clone pr-1"></i>RESULT</h3>
                </div>
                <div class="card-body pt-0 p-5">
                    <table class="table table-bordered">
                        <tr>
                            <th width="30%">Test ID</th>
                            <td width="2%">:</td>
                            <td><?php echo $row['TestID']; ?></td>
                        </tr>
                        <tr>
                            <th width="30%">Subject</th>
                            <td width="2%">:</td>
                            <td><?php echo $row['Subject']; ?></td>
                        </tr>
                        <tr>
                            <th width="30%">Total Questions</th>
                            <td width="2%">:</td>
                            <td><?php echo $row['TotalQS']; ?></td>
                        </tr>
                        <tr>
                            <th width="30%">Correct Questions</th>
                            <td width="2%">:</td>
                            <td><?php echo $row['CorrectQs']; ?></td>
                        </tr>
                        <tr>
                            <th width="30%">Wrong Questions</th>
                            <td width="2%">:</td>
                            <td><?php echo $row['WrongQS']; ?></td>
                        </tr>
                        <tr>
                            <th width="30%">Skipped Questions</th>
                            <td width="2%">:</td>
                            <td><?php echo $row['SkippedQS']; ?></td>
                        </tr>
                        <tr>
                            <th width="30%">Total Marks</th>
                            <td width="2%">:</td>
                            <td><?php echo $row['TotalMarks']; ?></td>
                        </tr>
                        <tr>
                            <th width="30%">Marks Secured</th>
                            <td width="2%">:</td>
                            <td><?php echo $row['MarksSecured']; ?></td>
                        </tr>
                        <tr>
                            <th width="30%">Status</th>
                            <td width="2%">:</td>
                            <td><?php echo $row['Status']; ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

<footer>
    <p>&copy; 2023 by ONE OATH.</p>
</footer>

      </body>
</html>