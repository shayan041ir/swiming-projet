<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    session_start();
    if (!isset($_SESSION['username'])) {
        header("Location: http://localhost/swiming%20projet/ap/login.php");
        exit();
    }

    include 'db.php';

    $comment = mysqli_real_escape_string($conn, $_POST['comment']);
    $user = $_SESSION['username'];

    $sql = "INSERT INTO comments (user, comment) VALUES ('$user', '$comment')";

    if (mysqli_query($conn, $sql)) {
        header("Location: http://localhost/swiming%20projet/ap/index.php?message=comment_success");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
} else {
    header("Location: http://localhost/swiming%20projet/ap/index.php");
    exit();
}
?>
