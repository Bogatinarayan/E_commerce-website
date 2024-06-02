<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
</head>
<body>

<div class="wrapper">
    <header>Login Form</header>
    <form id="loginForm" method="post">
        <div class="field email">
            <div class="input-area">
                <input type="text" name="email" placeholder="Email Address" class="email">
                <i class="icon fas fa-envelope"></i>
                <i class="error error-icon fas fa-exclamation-circle"></i>
            </div>
            <div class="error error-txt">Email can't be blank</div>
        </div>
        <div class="field password">
            <div class="input-area">
                <input type="password" name="password" placeholder="Password" class="password">
                <i class="icon fas fa-lock"></i>
                <i class="error error-icon fas fa-exclamation-circle"></i>
            </div>
            <div class="error error-txt">Password can't be blank</div>
        </div>
        <div class="pass-txt"><a href="#">Forgot password?</a></div>
        <input type="button" value="Login" onclick="validateAndSubmit()">
    </form>
    <div class="sign-txt">Not yet member? <a href="#">Signup now</a></div>
</div>

<?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Connect to MySQL database
    $conn = mysqli_connect("localhost", "root", "", "login07");

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Prepare SQL query using prepared statements to prevent SQL injection
    $sql = "INSERT INTO login07 (email,password) VALUES (?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $email, $password);

    if (mysqli_stmt_execute($stmt)) {
        echo "New data entered successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    // Close prepared statement and database connection
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>

<script>
    function validateAndSubmit() {
        var email = document.querySelector(".email input").value;
        var password = document.querySelector(".password input").value;

        // Form validation
        if (!email || !password) {
            alert("Please fill in both email and password fields.");
            return;
        }

        // Submit the form
        document.getElementById("loginForm").submit();
    }
</script>

</body>
</html>