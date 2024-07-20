<?php
session_start(); // شروع جلسه

// اتصال به پایگاه داده
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "swimdb";

// ایجاد اتصال به پایگاه داده
$conn = new mysqli($servername, $username, $password, $dbname);

// بررسی اتصال به پایگاه داده
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error); // اگر اتصال ناموفق بود، پیام خطا نمایش داده شود
}

// بررسی درخواست ارسال شده از طریق فرم
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username']; // دریافت نام کاربری از فرم
    $password = $_POST['password']; // دریافت رمز عبور از فرم
    $user_type = $_POST['user_type']; // دریافت نوع کاربر از فرم (ادمین یا کاربر)

    // انتخاب جداول بر اساس نوع کاربر
    if ($user_type == 'admin') {
        $sql = "SELECT * FROM admins WHERE username='$username'";
    } else {
        $sql = "SELECT * FROM users WHERE username='$username'";
    }

    // اجرای کوئری و دریافت نتیجه
    $result = $conn->query($sql);

    // بررسی نتیجه کوئری
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // بررسی رمز عبور
        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $username; // ذخیره نام کاربری در سشن
            $_SESSION['user_type'] = $user_type; // ذخیره نوع کاربر در سشن
            // هدایت کاربر به صفحه مناسب بر اساس نوع کاربر
            if ($user_type == 'admin') {
                header('Location: admin_dashboard.php');
            } else {
                // header("Location: dashboard.php");
                header("Location: index.php");
            }
            exit; // خروج از اسکریپت
        } else {
            echo "Invalid password"; // نمایش پیام خطا در صورت نادرست بودن رمز عبور
        }
    } else {
        echo "No user found"; // نمایش پیام خطا در صورت عدم وجود کاربر
    }
}

// بستن اتصال به پایگاه داده
$conn->close();
?>

<!DOCTYPE html>

<head>
    <title>Login Example</title>
    <link rel="stylesheet" href="css_style.css"> <!-- لینک به فایل استایل CSS -->
</head>

<body>
    <form class="my-form" method="post" action="login.php"> <!-- فرم ورود کاربر -->
        <div class="login-welcome-row">
            <a href="#" title="Logo">
                <img src="../ap/upload/img/nemayedakheli/aquaParkLogo.png" alt="Logo" class="logo"> <!-- لوگوی سایت -->
            </a> 
            <h1>Welcome back &#x1F44F;</h1> <!-- پیام خوش‌آمدگویی -->
            <p>Please enter your details!</p> <!-- پیام درخواست ورود اطلاعات -->
        </div>
        <div class="input__wrapper">
            <input type="text" id="username" name="username" required class="input__field" placeholder="username" autocomplete="off"> <!-- فیلد ورود نام کاربری -->
            <label for="username" class="input__label">username</label> <!-- لیبل نام کاربری -->
        </div>

        <div class="input__wrapper">
            <input id="password" type="password" class="input__field" placeholder="Password" name="password"> <!-- فیلد ورود رمز عبور -->
            <label for="password" class="input__label">
                Password
            </label> <!-- لیبل رمز عبور -->
        </div>
        <select id="user_type" name="user_type"> <!-- فیلد انتخاب نوع کاربر -->
            <option value="user">User</option>
            <option value="admin">Admin</option>
        </select><br>
        <button type="submit" class="my-form__button" value="Login">
            Login
        </button> <!-- دکمه ورود -->

        <div class="socials-row">
            <a href="signup.php" title="Use Google">
                Sign Up <!-- لینک به صفحه ثبت‌نام -->
            </a>
        </div>
    </form>
</body>

</html>
