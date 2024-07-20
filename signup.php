<?php
// اتصال به فایل db.php برای برقراری ارتباط با پایگاه داده
include 'db.php';

// بررسی اینکه آیا درخواست به روش POST ارسال شده است
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // دریافت و ذخیره نام کاربری از فرم
    $username = $_POST['username'];
    
    // هش کردن رمز عبور با استفاده از الگوریتم BCRYPT
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // ساخت دستور SQL برای درج کاربر جدید در جدول users
    $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";

    // اجرای دستور SQL و بررسی موفقیت‌آمیز بودن آن
    if ($conn->query($sql) === TRUE) {
        // نمایش پیام موفقیت و هدایت به صفحه ورود
        echo "Registration successful!";
        header("Location: login.php");
    } else {
        // نمایش پیام خطا در صورت بروز مشکل در اجرای دستور SQL
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="css_style.css">
    <style>
        /* استایل‌های CSS برای ظاهر صفحه */
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background-color: #fff;
            padding: 2em;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        .my-form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .login-welcome-row {
            margin-bottom: 1em;
        }

        .logo {
            width: 50px;
            height: 50px;
        }

        h1 {
            margin: 0.5em 0;
        }

        .input__wrapper {
            position: relative;
            width: 100%;
            margin-bottom: 1.5em;
        }

        .input__field {
            width: 100%;
            padding: 0.5em;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .input__label {
            position: absolute;
            top: -1.2em;
            left: 0.5em;
            background: #fff;
            padding: 0 0.2em;
            color: #999;
        }

        .my-form__button {
            padding: 0.7em 1.5em;
            border: none;
            background-color: #007bff;
            color: #fff;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }

        .my-form__button:hover {
            background-color: #0056b3;
        }

        .socials-row {
            margin-top: 1em;
        }

        .socials-row a {
            color: #007bff;
            text-decoration: none;
        }

        .socials-row a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- فرم ثبت نام که به فایل signup.php ارسال می‌شود -->
        <form class="my-form" method="post" action="signup.php">
            <div class="login-welcome-row">
                <!-- لینک به لوگو و نمایش آن -->
                <a href="#" title="Logo">
                    <img src="../ap/upload/img/nemayedakheli/aquaParkLogo.png" alt="Logo" class="logo">
                </a>
                <h1>Create an Account &#x1F44F;</h1>
                <p>Please fill in the details to sign up!</p>
            </div>
            <div class="input__wrapper">
                <!-- فیلد ورود نام کاربری -->
                <input type="text" id="username" name="username" required class="input__field" placeholder="Username" autocomplete="off">
                <label for="username" class="input__label">Username</label>
            </div>

            <div class="input__wrapper">
                <!-- فیلد ورود رمز عبور -->
                <input id="password" type="password" class="input__field" placeholder="Password" name="password" required>
                <label for="password" class="input__label">Password</label>
            </div>

            <!-- دکمه ثبت نام -->
            <button type="submit" class="my-form__button">Sign Up</button>

            <div class="socials-row">
                <!-- لینک به صفحه اصلی -->
                <a href="http://127.0.0.1:5500/">Back to Main Page</a>
            </div>
        </form>
    </div>
</body>

</html>
