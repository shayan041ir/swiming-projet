<?php
// وارد کردن فایل اتصال به پایگاه داده
include 'db.php';
// شروع جلسه (Session)
session_start();

// بررسی اینکه آیا کاربر وارد سیستم شده است
if (!isset($_SESSION['username'])) {
    // اگر کاربر وارد نشده باشد، او را به صفحه ورود هدایت می‌کنیم
    header("Location: login.php");
    exit();
}

// دریافت نام کاربری و نوع کاربر از جلسه
$username = $_SESSION['username'];
$user_type = $_SESSION['user_type'];

// بررسی اینکه آیا کاربر فعلی ادمین است
$is_admin = false;
$sql = "SELECT * FROM admins WHERE username='$username'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $is_admin = true;
}


?>

<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>خرید بلیط</title>
    <style>
        body {
            background-color: #8e44ad;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
        }
        .form_main {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            text-align: center;
        }
        .form_main .heading {
            font-size: 1.5em;
            margin-bottom: 20px;
            color: #333;
        }
        .form_main .inputContainer {
            margin-bottom: 20px;
        }
        .form_main .inputField {
            width: 100%;
            padding: 10px;
            font-size: 1em;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            outline: none;
        }
        .form_main #button {
            background-color: #9b59b6;
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 1em;
            cursor: pointer;
            border-radius: 5px;
        }
        .form_main #button:hover {
            background-color: #8e44ad;
        }
        .form_main #backLink {
            text-decoration: none;
            color: #9b59b6;
            font-size: 0.9em;
        }
        .form_main #backLink:hover {
            text-decoration: underline;
        }
    </style>
    <script> 
        function updateDays() {
            var userType = document.getElementById("user_type").value;
            var daySelect = document.getElementById("day");
            var days = {
                "تایم آقایان": ["یکشنبه", "سه‌شنبه", "پنج‌شنبه"],
                "تایم بانوان": ["دوشنبه", "چهارشنبه", "جمعه"]
            };

            daySelect.innerHTML = "";
            days[userType].forEach(function(day) {
                var option = document.createElement("option");
                option.value = day;
                option.text = day;
                daySelect.appendChild(option);
            });
        }

        document.addEventListener("DOMContentLoaded", function() {
            updateDays();
        });
    </script>
</head>
<body>
    <div class="form_main">
        <p class="heading">خرید بلیط</p>
        <form method="post" action="add_ticket.php">
            <div class="inputContainer">
                <input type="text" name="username" placeholder="نام کاربری" required class="inputField" value="<?php echo htmlspecialchars($username);  ?>">
            </div>
            <div class="inputContainer">
                <input type="email" name="email" placeholder="ایمیل" required class="inputField">
            </div>
            <div class="inputContainer">
            <input type="number" name="count" placeholder="تعداد بلیط" required class="inputField" min="1">
            </div>
            <div class="inputContainer">
                <select name="user_type" id="user_type" class="inputField" onchange="updateDays()">
                    <option value="تایم آقایان">تایم آقایان</option>
                    <option value="تایم بانوان">تایم بانوان</option>
                </select>
            </div>
            <div class="inputContainer">
                <select name="day" id="day" class="inputField"></select>
            </div>
            <input type="submit" value="خرید بلیط" id="button">
        </form>
        <?php 
        if ($is_admin) {
            echo '<a href="admin_dashboard.php" id="backLink">بازگشت به داشبورد ادمین</a>';
        } else {
            echo '<a href="dashboard.php" id="backLink">بازگشت به داشبورد کاربر</a>';
        } 
        ?>
    </div>
</body>
</html>
