<?php
// وارد کردن فایل اتصال به پایگاه داده
include 'db.php';
// شروع جلسه (Session)
session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <!-- تنظیمات متا برای تنظیم کدگذاری کاراکترها و مقیاس نمایش -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        /* تنظیمات استایل برای بدنه صفحه */
        body {
            background-color: #f0f0f0;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }

        /* تنظیمات استایل برای کانتینر اصلی */
        .container {
            width: 80%;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        /* تنظیمات استایل برای عنوان‌ها */
        h2,
        h3 {
            text-align: center;
            color: #333;
        }

        /* تنظیمات استایل برای جداول */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #f9f9f9;
        }

        /* تنظیمات استایل برای فرم‌ها */
        form {
            text-align: center;
            margin-bottom: 20px;
        }

        form input[type="text"],
        form input[type="password"],
        form input[type="email"],
        form input[type="number"],
        form select {
            width: 50%;
            padding: 8px;
            margin: 8px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        form input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 4px;
        }

        form input[type="submit"]:hover {
            background-color: #0056b3;
        }

        /* تنظیمات استایل برای تراز وسط */
        .center {
            text-align: center;
            margin-top: 20px;
        }

        /* تنظیمات استایل برای لینک بازگشت */
        .back-link {
            display: block;
            text-align: center;
            margin-bottom: 20px;
            color: #007bff;
            text-decoration: none;
        }

        .back-link:hover {
            text-decoration: underline;
        }

        /* تنظیمات استایل برای منوهای ناوبری */
        .nav-menu {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        .nav-menu a {
            margin: 0 10px;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
        }

        .nav-menu a:hover {
            background-color: #0056b3;
        }

        /* تنظیمات استایل برای دکمه بازگشت به بالا */
        #backToTopBtn {
            /* display: none; */
            position: fixed;
            bottom: 20px;
            right: 10px;
            z-index: 99;
            font-size: 15px;
            border: none;
            outline: none;
            background-color: #007bff;
            color: white;
            cursor: pointer;
            padding: 15px;
            border-radius: 50%;
        }

        #backToTopBtn:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <header>
        <!-- منوهای ناوبری -->
        <div class="nav-menu">
            <a href="#manage-users">Manage Users</a>
            <a href="#manage-admins">Manage Admins</a>
            <a href="#manage-tickets">Manage Tickets</a>
            <a href="#manage-comments">Manage Comments</a>
            <a href="#Upload-Image-and-Imagename">Upload Image</a>
            <a href="#manage-coaches">Manage Coaches</a>
            <a href="#update-text">Update Text</a>
            <a href="#post-content">Post Content</a>
        </div>
    </header>
    <button onclick="window.scrollTo({top:0, behavior:'smooth'})" id="backToTopBtn">back up</button>
    <div class="container">
        <img src="../ap/upload/img/nemayedakheli/admind.png" style="width: 50px; height: 50px; text-align: center;">
        <h2>Admin Dashboard</h2>
        <p class="center">Welcome, Admin</p>
        <a class="back-link" href="http://localhost/swiming%20projet/ap/index.php">Back to Main Page</a>
        <br>

        <div class="container" id="manage-users">
            <!-- بخش مدیریت کاربران -->
            <h3>Manage Users</h3>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Action</th>
                </tr>
                <?php
                // بازیابی اطلاعات کاربران از پایگاه داده
                $sql = "SELECT * FROM users";
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['username']; ?></td>
                        <td>
                            <form method="post" action="admin_delete_user.php">
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                <input type="submit" value="Delete">
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </table>

            <h3>Add User</h3>
            <form method="post" action="admin_add_user.php">
                Username: <input type="text" name="username" required><br>
                Password: <input type="password" name="password" required><br>
                <input type="submit" value="Add User">
            </form>
            <h3>update user</h3>
            <form method="post" action="edit_user.php">
                <label for="id">id:</label>
                <input type="text" name="id"><br>
                <label for="username">Username:</label>
                <input type="text" name="username" required value="new username"><br>
                <label for="password">Password:</label>
                <input type="text" name="password" required value="new password"><br>
                <input type="submit" value="Update">
            </form>
        </div>
        <br>


        <div class="container" id="manage-admins">
            <!-- بخش مدیریت ادمین‌ها -->
            <h3>Manage Admins</h3>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Action</th>
                </tr>
                <?php
                // بازیابی اطلاعات ادمین‌ها از پایگاه داده
                $sql = "SELECT * FROM admins";
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['username']; ?></td>
                        <td>
                            <form method="post" action="admin_delete_admin.php">
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                <input type="submit" value="Delete">
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </table>

            <h3>Add Admin</h3>
            <form method="post" action="admin_add_admin.php">
                Username: <input type="text" name="username" required><br>
                Password: <input type="password" name="password" required><br>
                <input type="submit" value="Add Admin">
            </form>
            <h3>update Admin</h3>
            <form method="post" action="edit_admin.php">
                <label for="id">id:</label>
                <input type="text" name="id"><br>
                <label for="username">Username:</label>
                <input type="text" name="username" required value="new username"><br>
                <label for="password">Password:</label>
                <input type="text" name="password" required value="new password"><br>
                <input type="submit" value="Update">
            </form>
        </div>

        <br>

        <div class="container" id="manage-tickets">
            <!-- بخش مدیریت بلیط‌ها -->
            <h3>Manage Tickets</h3>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Count</th>
                    <th>Time Slot</th>
                    <th>Action</th>
                </tr>
                <?php
                // بازیابی اطلاعات بلیط‌ها از پایگاه داده
                $sql = "SELECT * FROM tickets";
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['username']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['count']; ?></td>
                        <td><?php echo $row['time_slot']; ?></td>
                        <td>
                            <form method="post" action="admin_delete_ticket.php">
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                <input type="submit" value="Delete">
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </table>

            <h3>Add Ticket</h3>
            <form method="post" action="admin_add_ticket.php">
                Username: <input type="text" name="username" required><br>
                Email: <input type="email" name="email" required><br>
                Enter number of tickets:
                <input type="number" name="count" id="ticket_count"><br>
                <div class="inputContainer">
                    <select name="user_type" class="inputField">
                        <option value="تایم آقایان">تایم آقایان</option>
                        <option value="تایم بانوان">تایم بانوان</option>
                    </select>
                </div>
                <div class="inputContainer">
                    <select name="day" class="inputField">
                        <option value="یکشنبه">یکشنبه</option>
                        <option value="سه شنبه">سه شنبه</option>
                        <option value="پنجشنبه">پنجشنبه</option>
                        <option>------</option>
                        <option value="دوشنبه">دوشنبه</option>
                        <option value="چهارشنبه">چهارشنبه</option>
                        <option value="جمعه">جمعه</option>
                    </select>
                </div>
                <input type="submit" value="Add Ticket">
            </form>
        </div>
        <br>


        <div class="container" id="manage-comments">
            <!-- بخش مدیریت نظرات کاربران -->
            <h3>Manage User Comments</h3>
            <table>
                <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>Comment</th>
                    <th>Action</th>
                </tr>
                <?php
                // بازیابی اطلاعات نظرات کاربران از پایگاه داده
                $sql = "SELECT * FROM comments";
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['user']; ?></td>
                        <td><?php echo $row['comment']; ?></td>
                        <td>
                            <form method="post" action="delete_comment.php" style="display:inline;">
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                <input type="submit" value="Delete">
                            </form>
                            <form method="post" action="approve_comment.php" style="display:inline;">
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                <input type="submit" value="Approve">
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </table>

        </div>

        <br>
        <br>
        <div class="container" id="Upload-Image-and-Imagename">

            <h3>Upload Image and Text</h3>
            <form method="post" action="move_uploaded_file.php">
                <input type="submit" value="Upload Image">
            </form>
        </div>
        <br>
        <br>


        <div class="container" id="manage-coaches">
            <table>
                <tr>
                    <th>ID</th>
                    <th>coach</th>
                </tr>
                <?php
                // بازیابی اطلاعات نظرات کاربران از پایگاه داده
                $sql = "SELECT * FROM coaches";
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                    </tr>
                <?php } ?>
            </table>

            <h2>ویرایش نام مربی</h2>
            <form action="update_coach.php" method="post">
                <label for="old_id">شناسه فعلی مربی:</label>
                <input type="number" id="old_id" name="old_id" required><br>

                <label for="new_name">نام جدید مربی:</label>
                <input type="text" id="new_name" name="new_name" required><br>

                <input type="submit" value="بروزرسانی">
            </form>
            <form action="insert_coach.php" method="post">
                <label for="coach_name">نام مربی:</label>
                <input type="text" id="coach_name" name="coach_name" required>
                <input type="submit" value="اضافه کردن">
            </form>

        </div>

        <!-- بروزرسانی بخش تایمینگ سایت -->
        <br>
        <div class="container" id="update-text">
            <h3>update Text</h3>
            <form action="timing.php" method="post">
                <label for="men_content">Men Content:</label>
                <input type="text" name="men_content" id="men_content" value="mentime"><br>

                <label for="men_timee">Men Timee:</label>
                <input type="text" name="men_timee" id="men_timee" value="men_time"><br>

                <label for="women_content">Women Content:</label>
                <input type="text" name="women_content" id="women_content" value="womentime"><br>

                <label for="women_timee">Women Timee:</label>
                <input type="text" name="women_timee" id="women_timee" value="women_time"><br>

                <input type="submit" value="save">
            </form>
        </div>
        <br>

        <?php
        // دریافت محتوای posttext از دیتابیس
        $sql = "SELECT * FROM posttext";
        $result = $conn->query($sql);
        $posttexts = [];
        while ($row = $result->fetch_assoc()) {
            $posttexts[] = $row;
        }

        $conn->close();
        ?>
        <div class="container" id="post-content">
            <h2>ویرایش محتوای پست‌ها</h2>
            <?php foreach ($posttexts as $posttext) : ?>
                <form action="update_posttext.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $posttext['id']; ?>">
                    <label for="title_<?php echo $posttext['id']; ?>">عنوان:</label>
                    <input type="text" id="title_<?php echo $posttext['id']; ?>" name="title" value="<?php echo htmlspecialchars($posttext['title']); ?>" required>
                    <label for="content_<?php echo $posttext['id']; ?>">محتوا:</label>
                    <textarea id="content_<?php echo $posttext['id']; ?>" name="content" required><?php echo htmlspecialchars($posttext['content']); ?></textarea>
                    <input type="submit" value="بروزرسانی">
                </form>
            <?php endforeach; ?>
        </div>

    </div>
</body>

</html>