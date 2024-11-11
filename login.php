<?php
session_start(); 

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "swimdb";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error); // اگر اتصال ناموفق بود، پیام خطا نمایش داده شود
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username']; 
    $password = $_POST['password']; 
    $user_type = $_POST['user_type'];
    if ($user_type == 'admin') {
        $sql = "SELECT * FROM admins WHERE username='$username'";
    } else {
        $sql = "SELECT * FROM users WHERE username='$username'";
    }

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $username;
            $_SESSION['user_type'] = $user_type;
            if ($user_type == 'admin') {
                header('Location: admin_dashboard.php');
            } else {
                // header("Location: dashboard.php");
                header("Location: index.php");
            }
            exit; 
        } else {
            echo "Invalid password";
        }
    } else {
        echo "No user found"; 
    }
}

$conn->close();
?>

<!DOCTYPE html>

<head>
    <title>Login Example</title>
    <link rel="stylesheet" href="css_style.css">
</head>

<body>
    <form class="my-form" method="post" action="login.php"> 
        <div class="login-welcome-row">
            <a href="#" title="Logo">
                <img src="../ap/upload/img/nemayedakheli/aquaParkLogo.png" alt="Logo" class="logo"> 
            </a> 
            <h1>Welcome back &#x1F44F;</h1> 
            <p>Please enter your details!</p> 
        </div>
        <div class="input__wrapper">
            <input type="text" id="username" name="username" required class="input__field" placeholder="username" autocomplete="off"> 
            <label for="username" class="input__label">username</label>
        </div>

        <div class="input__wrapper">
            <input id="password" type="password" class="input__field" placeholder="Password" name="password"> 
            <label for="password" class="input__label">
                Password
            </label> 
        </div>
        <select id="user_type" name="user_type">
            <option value="user">User</option>
            <option value="admin">Admin</option>
        </select><br>
        <button type="submit" class="my-form__button" value="Login">
            Login
        </button>

        <div class="socials-row">
            <a href="signup.php" title="Use Google">
                Sign Up 
            </a>
        </div>
    </form>
</body>

</html>
