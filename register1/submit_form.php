<?php
// Database connection details
$servername = "localhost";
$username = "username";
$password = "2YXLpUtv[7B*VXNy";
$dbname = "gurudwara_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to sanitize input data
function sanitizeInput($data) {
    global $conn;
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($conn->real_escape_string($data));
    return $data;
}

// Process the form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and retrieve data from the form
    $username = sanitizeInput($_POST["username"]);
    $photo1 = sanitizeInput($_POST["photo"][0]); // Assuming index 0 corresponds to Photo1
    $address = sanitizeInput($_POST["address"]);
    $city = sanitizeInput($_POST["city"]);
    $province = sanitizeInput($_POST["province"]);
    $postalCode = sanitizeInput($_POST["postalCode"]);
    $societyPhone = sanitizeInput($_POST["societyPhone"]);

    $firstName1 = sanitizeInput($_POST["p1FirstName"]);
    $lastName1 = sanitizeInput($_POST["p1LastName"]);
    $phone1 = sanitizeInput($_POST["p1Phone"]);

    $firstName2 = sanitizeInput($_POST["p2FirstName"]);
    $lastName2 = sanitizeInput($_POST["p2LastName"]);
    $phone2 = sanitizeInput($_POST["p2Phone"]);

    $lariwarSarups = sanitizeInput($_POST["granthisSarups"]);
    $padshedSarups = sanitizeInput($_POST["padshedSarups"]);

    // Insert into the main form table
    $sqlMainForm = "INSERT INTO dataentry (username, Photo1, Address, City, Province, PostalCode, `Phone/mobileNo`, FirstName1, LastName1, Phone1, FirstName2, LastName2, Phone2, LariwarSarups, PadshedSarups) 
                    VALUES ('$username', '$photo1', '$address', '$city', '$province', '$postalCode', '$societyPhone', '$firstName1', '$lastName1', '$phone1', '$firstName2', '$lastName2', '$phone2', '$lariwarSarups', '$padshedSarups')";

    if ($conn->query($sqlMainForm) === TRUE) {
        // Retrieve the last inserted ID
        $mainFormID = $conn->insert_id;

       // Insert into the head granthi table
    // $headGranthiData = $_POST["headGranthiTable"];
    // echo $_POST["headGranthiTable"];
    $numRows = count($_POST["year"]);
    echo $numRows;

    for ($i = 0; $i < $numRows; $i++) {
        $sno = sanitizeInput($_POST["serialNumber"][$i]);
        $month = sanitizeInput($_POST["month"][$i]);
        $year = sanitizeInput($_POST["year"][$i]);

        $printedAt = sanitizeInput($_POST["printedAt"][$i]);
        $stampColor = sanitizeInput($_POST["stampColor"][$i]);
        $lipi = sanitizeInput($_POST["lipi"][$i]);
        $jiltColor = sanitizeInput($_POST["jiltColor"][$i]);
        $size = sanitizeInput($_POST["size"][$i]);
        $photo2 = sanitizeInput($_POST["photo"][$i]); // Assuming index $i corresponds to Photo2
        $language = sanitizeInput($_POST["language"][$i]);
        $totalNo = sanitizeInput($_POST["totalNumber"][$i]);
        $canPrakash = sanitizeInput($_POST["canParkash"][$i]); // Change here
        $itReceive = sanitizeInput($_POST["itReceive"][$i]);
        $printerName = sanitizeInput($_POST["printerName"][$i]);

        // Insert into the head granthi table
        $sqlHeadGranthi = "INSERT INTO dataentry2 ( year, month, PrintedAt, StampColor, Lipi, JiltColor, Size, Photo, Language, TotalNo, CanPrakash, ItReceive, PrinterName) 
                    VALUES ('$year', '$month', '$printedAt', '$stampColor', '$lipi', '$jiltColor', '$size', '$photo2', '$language', '$totalNo', '$canPrakash', '$itReceive', '$printerName')";


            $conn->query($sqlHeadGranthi);
        }

        echo "Form data successfully saved!";
    } 
    else {
        echo "Error: " . $sqlMainForm . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
