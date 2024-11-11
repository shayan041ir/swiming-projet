<?php
include 'db.php';
session_start();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $count = intval($_POST['count']); 
    $time_slot = $_POST['user_type'] . ' - ' . $_POST['day']; 
    $user_type = '';


    $sql = "SELECT * FROM admins WHERE username='$username'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $user_type = 'admin';
    } else {

        $sql = "SELECT * FROM users WHERE username='$username'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $user_type = 'user';
        }
    }


    $sql = "INSERT INTO tickets (username, email, count, time_slot) VALUES ('$username', '$email', $count, '$time_slot')";

    if ($conn->query($sql) === TRUE) {
        if ($user_type == 'admin') {


            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $ticket_count = $_POST['count'];
                $ticket_price = 15000;

                $_SESSION['count'] = $ticket_count;
                $_SESSION['ticket_price'] = $ticket_price;


                header('Location: paypal.php');
                exit();
            }
        } else {
            // header("Location: dashboard.php");

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $ticket_count = $_POST['count'];
                $ticket_price = 15000;

                $_SESSION['count'] = $ticket_count;
                $_SESSION['ticket_price'] = $ticket_price;


                header('Location: paypal.php');
                exit();
            }
        }
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
