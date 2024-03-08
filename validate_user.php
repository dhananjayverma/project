<?php
require 'path/to/PHPMailer/src/PHPMailer.php';
require 'path/to/PHPMailer/src/SMTP.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the user's email from the POST request
    $userEmail = $_POST['email'];

    // Send the validation email using PHPMailer
    $mail = new PHPMailer\PHPMailer\PHPMailer();

    // SMTP configuration for Gmail
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'sambhavanand09@gmail.com'; // Your Gmail email address
    $mail->Password = 'Bodyguard@123';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    // Sender and recipient settings
    $mail->setFrom('admin@example.com', 'Your Admin');
    $mail->addAddress($userEmail);
    $mail->Subject = 'Account Approved';
    $mail->Body = 'Dear user, your account has been approved.';

    // Send email and update user status in the database
    if ($mail->send()) {
        // Implement your database update logic here
        // For example, using MySQLi:
        $mysqli = new mysqli("localhost", "username", "password", "database");
        if ($mysqli->connect_error) {
            die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
        }

        // Update the user status in the database
        $query = "UPDATE your_table_name SET status = 'Approved' WHERE email = ?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("s", $userEmail);
        $stmt->execute();
        $stmt->close();

        echo 'User approved and email sent successfully!';
    } else {
        echo 'Error sending email: ' . $mail->ErrorInfo;
    }
}
?>
