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
    $stmt = $conn->prepare("INSERT INTO product_detail_final (first_name, last_name, email, phone, location, description, elocation) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $first_name, $last_name, $email, $phone, $location, $description, $elocation);

    // Set parameters and execute
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $location = $_POST['location'];
    $description = $_POST['description'];
    $elocation = $_POST['elocation'];
    $stmt->execute();

    echo "Thank you, we will call you soon.";

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Form</title>
    <style>
        body {
            background-color: #add8e6;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            background-image: url("narayanfree.png");
            background-size: cover;
        }
        #buy-form {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            text-align: center;
        }
        #buy-form label {
            display: block;
            margin: 10px 0 5px;
        }
        #buy-form input, #buy-form textarea {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        #buy-form button {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        #buy-form button:hover {
            background-color: #0056b3;
        }
        #buy-form input[type="hidden"] {
            display: none;
        }
    </style>
</head>
<body>

    <form id="buy-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <label for="first-name">First Name:</label>
        <input type="text" id="first-name" name="first_name" required><br>
        <label for="last-name">Last Name:</label>
        <input type="text" id="last-name" name="last_name" required><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>
        <label for="phone">Phone Number:</label>
        <input type="text" id="phone" name="phone" required><br>
        <label for="location">Location:</label>
        <input type="text" id="location" name="location" required><br>
        <label for="description">Description:</label>
        <textarea id="description" name="description" placeholder="Enter what do you want to buy" required></textarea><br>
        <input type="hidden" id="elocation" name="elocation">

        <button type="submit" name="submit">Order</button>
    </form>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var latitude = position.coords.latitude;
                    var longitude = position.coords.longitude;
                    document.getElementById("elocation").value = "Latitude: " + latitude + ", Longitude: " + longitude;
                }, function(error) {
                    console.error("Error fetching location: ", error);
                });
            } else {
                alert("Geolocation is not supported by this browser.");
            }
        });
    </script>

</body>
</html>
