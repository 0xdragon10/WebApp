<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <form action="index.php" method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <select name="gender" required>
                <option value="" disabled selected>Select Gender</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select>        
            <input type="email" name="email" placeholder="example@gmail.com" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
<?php

$host = "localhost";
$db_username = "root"; 
$db_password = ""; 
$database = "store";


$conn = new mysqli($host, $db_username, $db_password, $database);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $gender = $_POST['gender'];
    $email = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); 

   
    $stmt = $conn->prepare("INSERT INTO users (username, gender, email, password ) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $username, $gender, $email, $password);

    if ($stmt->execute()) {
        echo '<p class="message success">Registration successful!</p>';
    } else {
        echo '<p class="message error">Error: ' . $stmt->error . '</p>';
    }

    $stmt->close();
}

$conn->close();
?>
