<?php
// Establish database connection
$db_host = 'https://plathiya.scweb.ca/';
$db_name = 'plathiya';
$db_user = 'plathiya';
$db_pass = 'pb9nrpb9nrzwwd4zwwd4';

$conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if form data has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize form data
    $first_name = htmlspecialchars($_POST['Fname']);
    $last_name = htmlspecialchars($_POST['Lname']);
    $address1 = htmlspecialchars($_POST['Add1']);
    $address2 = htmlspecialchars($_POST['Add2']);
    $postal_code = htmlspecialchars($_POST['postal-code']);
    $city = htmlspecialchars($_POST['city']);
    $date = htmlspecialchars($_POST['date-input']);
    $quantity = htmlspecialchars($_POST['Quantity']);
    $phone_number = htmlspecialchars($_POST['phone']);
    $special_request = htmlspecialchars($_POST['message']);

    // Prepare SQL INSERT statement
    $stmt = $conn->prepare("INSERT INTO reservations (first_name, last_name, address1, address2, postal_code, city, date, quantity, phone_number, special_request) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    // Bind parameters and execute INSERT statement
    $stmt->bindParam(1, $first_name);
    $stmt->bindParam(2, $last_name);
    $stmt->bindParam(3, $address1);
    $stmt->bindParam(4, $address2);
    $stmt->bindParam(5, $postal_code);
    $stmt->bindParam(6, $city);
    $stmt->bindParam(7, $date);
    $stmt->bindParam(8, $quantity);
    $stmt->bindParam(9, $phone_number);
    $stmt->bindParam(10, $special_request);

    if ($stmt->execute()) {
        // Redirect to thank you page
        header('Location: thankyou.php');
        exit;
    } else {
        // Handle error
        echo 'Error submitting form data';
    }
}
?>