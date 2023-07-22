<?php
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
                header("Location: teacherdashboard.php");
            } else {
                echo "<h1>Invalid Username, Password </h1>";
            }
        } else {
            echo "<h1>Invalid Username, Password </h1>";
        }
    }
?>
