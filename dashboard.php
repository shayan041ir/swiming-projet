<?php
include 'db.php'; 
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: signin.php");
    exit();
}

$username = $_SESSION['username']; 

$sql_tickets = "SELECT * FROM tickets WHERE username='$username'";
$result_tickets = mysqli_query($conn, $sql_tickets);

$sql_comments = "SELECT * FROM comments WHERE user='$username'";
$result_comments = mysqli_query($conn, $sql_comments);
?>

<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>داشبورد کاربر</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .container h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .container p {
            text-align: center;
            color: #666;
        }

        .container table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .container table th,
        .container table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        .container table th {
            background-color: #f2f2f2;
        }

        .container form {
            text-align: center;
            margin-bottom: 20px;
        }

        .container form input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 8px 20px;
            cursor: pointer;
            border-radius: 4px;
        }

        .container form input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .container a {
            display: block;
            text-align: center;
            margin-bottom: 20px;
            color: #007bff;
            text-decoration: none;
        }
    </style>

</head>

<body>
    <div class="container">
        <header>
            <h2>داشبورد کاربر</h2>
            <p>خوش آمدید، <?php echo $username; ?></p>
            <a href="index.php">بازگشت به صفحه اصلی</a>
        </header>
        <section>
            <h3>تیکت‌های شما</h3>
            <table> 
                <tr>
                    <th>ID</th>
                    <th>Email</th>
                    <th>Count</th>
                    <th>Time Slot</th>
                    <th>Action</th>
                </tr>
                <?php while ($row = mysqli_fetch_assoc($result_tickets)) { ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['count']; ?></td>
                        <td><?php echo $row['time_slot']; ?></td>
                        <td>
                            <form method="post" action="delete_ticket.php">
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                <input type="submit" value="Delete">
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </table>
            <form action="buy_ticket.php" method="post">
                <input type="submit" value="Buy Ticket">
            </form>
        </section>
        <section>
            <h3>نظرات شما</h3>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Comment</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
                <?php while ($row = mysqli_fetch_assoc($result_comments)) { ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['comment']; ?></td>
                        <td><?php echo $row['created_at']; ?></td>
                        <td>
                            <form method="post" action="delete_comment.php">
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                <input type="submit" value="Delete">
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </section>
    </div>
</body>

</html>
