<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>آپلود فایل</title>
    <style>
        /* استایل برای بدنه صفحه */
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        /* استایل برای کانتینر فرم آپلود */
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            text-align: center;
        }
        /* استایل برای تگ h1 */
        h1 {
            margin-bottom: 20px;
            color: #333;
        }
        /* استایل برای ورودی‌های فرم */
        input[type="file"], input[type="text"], input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        /* استایل برای دکمه ارسال */
        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
        }
        /* استایل برای دکمه ارسال در حالت hover */
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        /* استایل برای پیام خطا و موفقیت */
        .message {
            margin: 10px 0;
            color: #d9534f;
        }
        .success {
            color: #5cb85c;
        }
        /* استایل برای لینک بازگشت */
        .back-link {
            display: block;
            margin-top: 20px;
            color: #007bff;
            text-decoration: none;
        }
        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>آپلود فایل</h1> 
        <?php
        session_start(); // شروع جلسه
        if (isset($_FILES['uploaded_file'])) {
            $errors = []; // آرایه برای نگهداری خطاها
            $file_tmp = $_FILES['uploaded_file']['tmp_name']; // مسیر فایل موقت
            $file_type = $_FILES['uploaded_file']['type']; // نوع فایل
            $file_size = $_FILES['uploaded_file']['size']; // اندازه فایل
            
            $file_ext_array = explode('.', $_FILES['uploaded_file']['name']); // تجزیه نام فایل برای گرفتن پسوند
            $file_ext = strtolower(end($file_ext_array)); // دریافت پسوند فایل و تبدیل به حروف کوچک

            $extensions = ["jpeg", "jpg", "png", "pdf"]; // فرمت‌های مجاز

            if (in_array($file_ext, $extensions) === false) {
                $errors[] = "فرمت فایل مجاز نیست. لطفاً یک فایل jpeg، jpg، png یا pdf آپلود کنید."; // خطا در صورت غیرمجاز بودن فرمت
            }

            if ($file_size > 2097152) { // حداکثر سایز 2MB
                $errors[] = 'حجم فایل نباید بیشتر از 2MB باشد.'; // خطا در صورت بزرگتر بودن حجم فایل
            }

            if (empty($errors)) {
                $upload_dir = "upload/img/nemayedakheli/"; // پوشه مقصد برای آپلود فایل
                if (!is_dir($upload_dir)) {
                    mkdir($upload_dir, 0755, true); // ایجاد پوشه در صورت عدم وجود
                }

                $custom_file_name = $_POST['file_name']; // دریافت نام فایل از فرم
                $upload_path = $upload_dir . basename($custom_file_name . '.' . $file_ext); // اضافه کردن پسوند به نام فایل

                if (move_uploaded_file($file_tmp, $upload_path)) {
                    echo "<div class='message success'>فایل با موفقیت آپلود شد.</div>"; // پیام موفقیت در آپلود
                } else {
                    echo "<div class='message'>خطا در آپلود فایل.</div>"; // پیام خطا در صورت عدم موفقیت در آپلود
                }
            } else {
                foreach ($errors as $error) {
                    echo "<div class='message'>$error</div>"; // نمایش پیام‌های خطا
                }
            }
        }
        ?>
        <a class="back-link" href="http://localhost/swiming%20projet/ap/admin_dashboard.php">بازگشت به صفحه اصلی</a> <!-- لینک بازگشت به صفحه اصلی -->

        <!-- فرم HTML برای آپلود فایل -->
        <form action="" method="POST" enctype="multipart/form-data">
            <input type="file" name="uploaded_file" required> <!-- ورودی انتخاب فایل -->
            <input type="text" name="file_name" placeholder="نام فایل" required> <!-- ورودی نام فایل -->
            <input type="submit" value="Upload"> <!-- دکمه ارسال -->
        </form>
    </div>
</body>
</html>
