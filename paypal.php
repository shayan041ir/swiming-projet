<?php
session_start();

// بررسی اینکه آیا اطلاعات مربوط به بلیط در نشست وجود دارد یا خیر
if (!isset($_SESSION['count']) || !isset($_SESSION['ticket_price'])) {
    // اگر اطلاعات بلیط موجود نباشد، کاربر به صفحه خرید بلیط هدایت می‌شود
    header('Location: buy_ticket.php');
    exit;
}

$ticket_count = $_SESSION['count']; // تعداد بلیط موجود در نشست را بارگیری می‌کند
$ticket_price = $_SESSION['ticket_price']; // قیمت بلیط در نشست را بارگیری می‌کند
$total_price = $ticket_count * $ticket_price; // محاسبه کل مبلغ پرداختی بر اساس تعداد و قیمت بلیط

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // در این مرحله فرض می‌شود که پرداخت موفقیت‌آمیز بوده است
    
    // حذف اطلاعات مربوط به بلیط از نشست برای پایان جلسه فعلی
    unset($_SESSION['count']);
    unset($_SESSION['ticket_price']);

    // نمایش پیام موفقیت و هدایت به صفحه داشبورد
    echo "<script>alert('خرید با موفقیت انجام شد'); window.location.href = 'dashboard.php';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>پرداخت آنلاین</title>
    <style>
        body {
            font-family: 'Tahoma', sans-serif;
            background-color: #f5f5f5;
            direction: rtl;
            text-align: center;
        }

        .container {
            width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header,
        .footer {
            background-color: #f2f2f2;
            padding: 10px;
            margin: -20px -20px 20px;
        }

        .header img {
            max-width: 100%;
            margin-bottom: 0px;
        }

        .form-group {
            margin-bottom: 15px;
            text-align: right;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        .form-group input {
            width: calc(100% - 10px);
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        #expire-date {
            width: calc(10% - 10px);
        }

        .form-group input[type="submit"] {
            width: 100%;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        .form-group input[type="submit"]:hover {
            background-color: #45a049;
        }

        .notice {
            background-color: #f9f9f9;
            border-left: 6px solid #2196F3;
            margin-bottom: 15px;
            padding: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <img src="../ap/upload/img/nemayedakheli/logo.jpg" alt="لوگو">
            <h1>پرداخت آنلاین</h1>
        </div>
        <form method="post">
            <div class="form-group">
                <label for="name">نام پذیرنده:</label>
                <input type="text" id="name" name="name" value="aquapark" required>
            </div>
            <div class="form-group">
                <label for="amount">مبلغ قابل پرداخت:</label>
                <input type="text" id="amount" name="amount" value="<?php echo $total_price; ?>" required>
            </div>
            <div class="form-group">
                <label for="card-number">شماره کارت:</label>
                <input type="text" id="card-number" name="card-number" required>
            </div>
            <div class="form-group">
                <label for="password">رمز اینترنتی:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="cvv2">شماره شناسایی دوم (CVV2):</label>
                <input type="text" id="cvv2" name="cvv2" required>
            </div>
            <div class="form-group">
                <label for="expire-date">تاریخ انقضای کارت:</label>
                <input type="text" id="expire-date" name="expire-date" required value="ماه">
                <input type="text" id="expire-date" name="expire-date" required value="سال">
            </div>
            <div class="form-group">
                <label for="captcha">حروف تصویر:</label>
                <input type="text" id="captcha" name="captcha" required>
                <img src="../ap/upload/img/nemayedakheli/captchaimg.jpg" alt="captcha">
            </div>
            <div class="form-group">
                <input type="submit" value="پرداخت">
            </div>
            <div class="form-group">
                <!-- دکمه انصراف که با کلیک بر روی آن کاربر به صفحه داشبورد هدایت می‌شود -->
                <input type="button" value="انصراف" onclick="window.location.href='dashboard.php';">
            </div>
        </form>
        <div class="footer">
            <p>شرکت به پرداخت ملت</p>
            <p>تلفن: 021-27312733</p>
        </div>
    </div>
</body>

</html>
