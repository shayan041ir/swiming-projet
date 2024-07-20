<?php
// بررسی اینکه آیا فرم ارسال شده است
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // بررسی اینکه آیا کاربر وارد شده است
    session_start();
    if (!isset($_SESSION['username'])) {
        // اگر کاربر وارد نشده باشد، به صفحه ورود هدایت می‌شود
        header("Location: http://localhost/swiming%20projet/ap/login.php");
        exit();
    }

    // اتصال به پایگاه داده
    include 'db.php';

    // پاکسازی و اعتبار سنجی ورودی کامنت
    $comment = mysqli_real_escape_string($conn, $_POST['comment']);
    $user = $_SESSION['username'];

    // آماده‌سازی دستور SQL برای درج کامنت
    $sql = "INSERT INTO comments (user, comment) VALUES ('$user', '$comment')";

    // اجرای دستور SQL
    if (mysqli_query($conn, $sql)) {
        // اگر کامنت با موفقیت درج شود، به صفحه مربوطه با پیام موفقیت هدایت می‌شود
        header("Location: http://localhost/swiming%20projet/ap/index.php?message=comment_success");
        exit();
    } else {
        // خطا در اجرای دستور SQL
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    // بستن اتصال پایگاه داده
    mysqli_close($conn);
} else {
    // اگر درخواست به روش POST نباشد، به صفحه اصلی هدایت می‌شود یا پیام خطا نمایش داده می‌شود
    header("Location: http://localhost/swiming%20projet/ap/index.php");
    exit();
}
?>
