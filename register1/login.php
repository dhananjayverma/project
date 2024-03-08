<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Replace with your actual database credentials
             $servername = "localhost";
        $username = "medizvsu_gurdwara";
        $password = "KUfo$^I,s{d6";
        $db_name = "medizvsu_gurdwara";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $db_name);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $email = $_POST["Email"];
    $password = $_POST["password"];

    // Hash the password (use a strong hashing algorithm like bcrypt in a real-world scenario)
    $hashedPassword = md5($password);

    // Prepare and execute the query
    $stmt = $conn->prepare("SELECT * FROM register WHERE Email = ? ");
    $stmt->bind_param("s", $email, );
    $stmt->execute();
    $result = $stmt->get_result();
    echo $result->num_rows;
    // Check if the user exists
    if ($result->num_rows >= 1) {
        // Login successful
        echo $result->num_rows;
        $_SESSION['user_email'] = $email;
        header("Location: ../newsfeed.php");
        exit();
    } else {
        // Login failed
          header("Location: ../newsfeed.php");
        exit();
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
