<?php
session_start(); // شروع جلسه (Session) در PHP
include 'db.php'; // شامل کردن فایل پایگاه داده

// دریافت محتوای posttext از دیتابیس
$sql = "SELECT * FROM posttext"; // تعریف کوئری SQL برای انتخاب همه رکوردها از جدول posttext
$result = $conn->query($sql); // اجرای کوئری و ذخیره نتیجه در متغیر result
$posttexts = []; // ایجاد یک آرایه خالی برای ذخیره محتوای posttext
while ($row = $result->fetch_assoc()) { // حلقه برای دریافت هر رکورد به صورت آرایه انجمنی
  $posttexts[] = $row; // اضافه کردن هر رکورد به آرایه posttexts
}
$conn->close(); // بستن ارتباط با پایگاه داده
?>
<?php
include 'header.php'; // شامل کردن فایل header.php
?>
<!DOCTYPE html>
<html lang="en"> <!-- شروع سند HTML و تعیین زبان به انگلیسی -->

<head>
  <meta charset="UTF-8"> <!-- تنظیم کدبندی کاراکترها به UTF-8 -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- تنظیم مقیاس نمایشی برای دستگاه‌های مختلف -->
  <link rel="stylesheet" href="../sstyle.css"> <!-- لینک کردن فایل استایل CSS -->
  <title>خدمات و امکانات</title> <!-- عنوان صفحه -->
</head>

<body>
  <div class="postcontainer"> <!-- شروع یک div با کلاس postcontainer -->
    <?php
    $images = [ // تعریف یک آرایه برای آدرس‌های تصاویر
      "../ap/upload/img/nemayedakheli/photos1.png",
      "../ap/upload/img/nemayedakheli/photos2.png",
      "../ap/upload/img/nemayedakheli/photos3.png",
      "../ap/upload/img/nemayedakheli/photos4.png",
      "../ap/upload/img/nemayedakheli/photos5.png",
      "../ap/upload/img/nemayedakheli/photos6.png",
      "../ap/upload/img/nemayedakheli/photos7.png",
      "../ap/upload/img/nemayedakheli/photos8.png"
    ];

    for ($i = 0; $i < count($posttexts); $i++) { // حلقه‌ای برای تکرار به تعداد پست‌ها
      echo '<div class="post">'; // ایجاد یک div برای هر پست
      echo '<div class="postimg">'; // ایجاد یک div برای تصویر پست
      echo '<img src="' . $images[$i % count($images)] . '" alt="">'; // افزودن تصویر به div (استفاده از $i % count($images) برای جلوگیری از ارور دسترسی به اندیس‌های بیش از حد آرایه images)
      echo '</div>'; // بستن div تصویر
      echo '<div class="posttext">'; // ایجاد یک div برای متن پست
      echo '<h2>' . $posttexts[$i]["title"] . '</h2>'; // افزودن عنوان پست به صورت h2
      echo '<p>' . $posttexts[$i]["content"] . '</p>'; // افزودن محتوای پست به صورت پاراگراف
      echo '</div>'; // بستن div متن
      echo '</div>'; // بستن div پست
    }
    ?>
  </div>
</body>

</html>
<?php include 'footer.php'; // شامل کردن فایل footer.php ?>
