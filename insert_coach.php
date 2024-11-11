<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $coach_name = $_POST['coach_name'];

    $sql = "INSERT INTO coaches (name) VALUES ('$coach_name')";
    if ($conn->query($sql) === TRUE) {
        header("Location: admin_dashboard.php?success=1");
    } else {
        echo "Error: " . $conn->error;
    }
    $conn->close();
}
?>
        <table>
            <tr>
                <th>ID</th>
                <th>coach</th>
                <th>Action</th>
            </tr>
            <?php
            $sql = "SELECT * FROM coaches";
            $result = $conn->query($sql);
            while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td>
                        <form method="post" action="delete_comment.php" style="display:inline;">
                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                            <input type="submit" value="Delete">
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </table>

        <h2>اضافه کردن مربی جدید</h2>
        <form action="insert_coach.php" method="post">
            <label for="coach_name">نام مربی:</label>
            <input type="text" id="coach_name" name="coach_name" required>
            <input type="submit" value="اضافه کردن">
        </form>
