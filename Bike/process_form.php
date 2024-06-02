<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Form</title>
</head>
<body>

    <form id="buy-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <label for="first-name">First Name:</label>
        <input type="text" id="first-name" name="first-name"><br>
        <label for="last-name">Last Name:</label>
        <input type="text" id="last-name" name="last-name"><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email"><br>
        <label for="phone">Phone Number:</label>
        <input type="text" id="phone" name="phone"><br>
        <label for="location">Location:</label>
        <input type="text" id="location" name="location"><br>

        <button type="submit" name="submit">Order</button>
    </form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Establish connection to MySQL database
    $servername = "localhost";
    $username = "root"; // Default username for XAMPP
    $password = ""; // No password for XAMPP
    $dbname = "product_detail";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and bind parameters
    $stmt = $conn->prepare("INSERT INTO product_detail (first_name, last_name, email, phone, location) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $first_name, $last_name, $email, $phone, $location);

    // Set parameters and execute
    $first_name = $_POST['first-name'];
    $last_name = $_POST['last-name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $location = $_POST['location'];
    $stmt->execute();

    echo "Order placed successfully.";

    $stmt->close();
    $conn->close();
}
?>
</body>
</html>
