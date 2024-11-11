<?php
session_start();
include 'db.php';

$sql_men = "SELECT content, timee FROM timings WHERE id = 1";
$result_men = $conn->query($sql_men);

if ($result_men->num_rows > 0) {
  $row_men = $result_men->fetch_assoc();
  $men_content = $row_men['content'];
  $men_timee = $row_men['timee'];
} else {
  $men_content = "No content available";
  $men_timee = "No time available";
}


$sql_women = "SELECT content, timee FROM timings WHERE id = 2";
$result_women = $conn->query($sql_women);

if ($result_women->num_rows > 0) {
  $row_women = $result_women->fetch_assoc();
  $women_content = $row_women['content'];
  $women_timee = $row_women['timee'];
} else {
  $women_content = "No content available";
  $women_timee = "No time available";
}


$sql_comments = "SELECT * FROM comments WHERE approved=1";
$result_comments = $conn->query($sql_comments);

$sql_coaches = "SELECT name FROM coaches";
$result_coaches = $conn->query($sql_coaches);



$conn->close();
?>

<!DOCTYPE html>
<html lang="fa">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>پارک آبی</title>
  <link rel="stylesheet" href="../styless.css"> 
  <style>
    .hero {
      background: rgba(0, 0, 0, 0.3) url("../ap/upload/img/nemayedakheli/headphoto.jpg") no-repeat center center/cover;
    }
  </style>
</head>

<body>
  <?php include 'header.php'; ?>
  <main>
    <section id="home" class="hero">
      <div class="hero-text">
        <h1>
          به پارک آبی خوش آمدید
        </h1>
        <h2 style="font-family: a;">Aqua Park</h2>
      </div>
    </section>
    <section id="schedule">
      <div class="container">
        <h2>تایم‌های آقایان و بانوان</h2>
        <div class="schedule-timings">
          <div class="timing">
            <h3>تایم آقایان</h3>
            <p><?php echo htmlspecialchars($men_content); ?></p>
            <p><?php echo htmlspecialchars($men_timee); ?></p>
          </div>
          <div class="timing">
            <h3>تایم بانوان</h3>
            <p><?php echo htmlspecialchars($women_content); ?></p>
            <p><?php echo htmlspecialchars($women_timee); ?></p>
          </div>
        </div>
      </div>
    </section>
    <section id="gallery">
      <div class="container">
        <h2>نمای داخلی استخر</h2>
        <div class="gallery-images">
          <img src="../ap/upload/img/nemayedakheli/photo1.png" alt="Pool Image 1">
          <img src="../ap/upload/img/nemayedakheli/photo2.png" alt="Pool Image 2">
          <img src="../ap/upload/img/nemayedakheli/photo3.png" alt="Pool Image 3">
          <img src="../ap/upload/img/nemayedakheli/photo4.png" alt="Pool Image 4">
        </div>
      </div>
    </section>
    <section id="coaches">
      <div class="container">
        <h2>مربی های مؤسسه</h2>
        <div class="coach-list">
          <?php
          while ($row = $result_coaches->fetch_assoc()) {
            echo "<div class='coach'>";
            echo "<img src='../ap/upload/img/nemayedakheli/man.png' alt='Coach Image'>";
            echo "<p>" . htmlspecialchars($row['name']) . "</p>";
            echo "</div>";
          }
          ?>
        </div>
      </div>
      </div>
    </section>
    <section id="testimonials">
      <div class="container">
        <h2>نظرات کاربران</h2>
        <div class="testimonial-list">
          <?php
          while ($row = $result_comments->fetch_assoc()) {
            echo "<div class='testimonial'>";
            echo "<p>" . htmlspecialchars($row['comment']) . "</p>";
            echo "<p>-" . htmlspecialchars($row['user']) . "</p>";
            echo "</div>";
          }
          ?>
          <div class="testimonial">
            <p>بسیار عالی! تجربه‌ای فوق‌العاده از یک روز مفرح در پارک آبی.</p>
            <p>- حسین راد</p>
          </div>
        </div>
        <div class="comment-form">
          <h3>ثبت نظر</h3>
          <?php
          if (isset($_SESSION['username'])) {
            echo '<form action="http://localhost/swiming%20projet/ap/submit_comment.php" method="POST">
                                    <textarea name="comment" required placeholder="نظر خود را اینجا بنویسید..."></textarea>
                                    <button type="submit">ارسال نظر</button>
                                </form>';
          } else {
            echo '<form action="http://localhost/swiming%20projet/ap/submit_comment.php" method="POST">
              <textarea name="comment" required placeholder="نظر خود را اینجا بنویسید..."></textarea>
              <button type="submit">ارسال نظر</button>
          </form>';
            echo '<p>برای ثبت نظر لطفاً <a href="http://localhost/swiming%20projet/ap/login.php">وارد شوید</a> یا <a href="http://localhost/swiming%20projet/ap/signup.php">ثبت‌نام کنید</a>.</p>';
          }
          ?>
        </div>
      </div>
    </section>
  </main>
  <?php include 'footer.php'; ?>
</body>

</html>
