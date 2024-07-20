<?php
include 'db.php';
session_start();

// بررسی اینکه آیا درخواست به صورت POST ارسال شده است یا خیر
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $count = intval($_POST['count']); // اطمینان از اینکه count یک عدد صحیح است
    $time_slot = $_POST['user_type'] . ' - ' . $_POST['day']; // ترکیب نوع کاربر و روز برای time_slot
    $user_type = '';

    // بررسی اینکه آیا کاربر ادمین است یا خیر
    $sql = "SELECT * FROM admins WHERE username='$username'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $user_type = 'admin';
    } else {
        // بررسی اینکه آیا کاربر یک کاربر معمولی است یا خیر
        $sql = "SELECT * FROM users WHERE username='$username'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $user_type = 'user';
        }
    }

    // درج اطلاعات در جدول tickets
    $sql = "INSERT INTO tickets (username, email, count, time_slot) VALUES ('$username', '$email', $count, '$time_slot')";

    if ($conn->query($sql) === TRUE) {
        if ($user_type == 'admin') {
            // header("Location: admin_dashboard.php");
            // بررسی ارسال فرم
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $ticket_count = $_POST['count'];
                $ticket_price = 15000;

                $_SESSION['count'] = $ticket_count;
                $_SESSION['ticket_price'] = $ticket_price;

                // هدایت به صفحه paypal.php
                header('Location: paypal.php');
                exit();
            }
        } else {
            // header("Location: dashboard.php");
            // بررسی ارسال فرم
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $ticket_count = $_POST['count'];
                $ticket_price = 15000;

                $_SESSION['count'] = $ticket_count;
                $_SESSION['ticket_price'] = $ticket_price;

                // هدایت به صفحه paypal.php
                header('Location: paypal.php');
                exit();
            }
        }
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error; // چاپ خطای SQL
    }

    $conn->close();
}
?>
