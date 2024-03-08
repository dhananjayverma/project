<?php
// Database credentials
$servername = "localhost";
$username = "medizvsu_gurdwara";
$password = "KUfo$^I,s{d6";
$db_name = "medizvsu_gurdwara";

// Create a connection
$conn = new mysqli($servername, $username, $password, $db_name);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to sanitize and validate input data
function sanitizeInput($data) {
    return htmlspecialchars(trim($data));
}
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
// Retrieve form data
$firstname = test_input($_POST["firstname"]);
$lastname = test_input($_POST["lastname"]);
$email = test_input($_POST["Email"]);
$password = test_input($_POST["password"]);
$fullName = test_input($_POST["fullName"]);
// $countryCode = test_input($_POST["countryCode"]);
$phoneNumber = test_input($_POST["phoneNumber"]);
// $day = test_input($_POST["day"]);
// $month = test_input($_POST["month"]);
// $year = test_input($_POST["year"]);
$city = test_input($_POST["city"]);
// $country = test_input($_POST["country"]);

// Additional fields for section 3
$p1FirstName = test_input($_POST["p1FirstName"]);
$p1LastName = test_input($_POST["p1LastName"]);
$p1CountryCode = test_input($_POST["p1CountryCode"]);
$p1PhoneNumber = test_input($_POST["p1PhoneNumber"]);
$p2FirstName = test_input($_POST["p2FirstName"]);
$p2LastName = test_input($_POST["p2LastName"]);
$p2CountryCode = test_input($_POST["p2CountryCode"]);
$p2PhoneNumber = test_input($_POST["p2PhoneNumber"]);


    $imageData = $_POST['liveImage'];
    $imageData = str_replace('data:image/png;base64,', '', $imageData);
    $imageData = str_replace(' ', '+', $imageData);
    $imageBinary = base64_decode($imageData);

    // Generate a unique filename
    $fileName = 'user_' . uniqid() . '.png';
    $filePath = 'images/' . $fileName;

    // Save the image to the server
    file_put_contents($filePath, $imageBinary);


// Insert data into the database
    $sql = "INSERT INTO register (firstname,lastname, phoneNumber,Email,password, photo,society  , city, firstname1, lastname1,  	countryCode ,phone1, firstname2, lastname2,countrycode2, phone2)
    VALUES ('$firstname','$lastname',' $phoneNumber',' $email', '$password','$fileName', '$fullName', '$city',' $p1FirstName', '$p1LastName', '$p1CountryCode', '$p1PhoneNumber', '$p2FirstName',' $p2LastName', '$p2CountryCode', '$p2PhoneNumber')";

        if ($conn->query($sql) === TRUE) {
              header("Location: ../index.html"); // Redirect to the success page
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

// Close the connection
$conn->close();
?>