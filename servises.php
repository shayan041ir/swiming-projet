<?php
session_start(); 
include 'db.php'; 

$sql = "SELECT * FROM posttext"; 
$result = $conn->query($sql); 
$posttexts = []; 
while ($row = $result->fetch_assoc()) {
  $posttexts[] = $row; 
}
$conn->close(); 
?>
<?php
include 'header.php'; 
?>
<!DOCTYPE html>
<html lang="en"> 

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
  <link rel="stylesheet" href="../sstyle.css">
  <title>خدمات و امکانات</title> 
</head>

<body>
  <div class="postcontainer"> 
    <?php
    $images = [ 
      "../ap/upload/img/nemayedakheli/photos1.png",
      "../ap/upload/img/nemayedakheli/photos2.png",
      "../ap/upload/img/nemayedakheli/photos3.png",
      "../ap/upload/img/nemayedakheli/photos4.png",
      "../ap/upload/img/nemayedakheli/photos5.png",
      "../ap/upload/img/nemayedakheli/photos6.png",
      "../ap/upload/img/nemayedakheli/photos7.png",
      "../ap/upload/img/nemayedakheli/photos8.png"
    ];

    for ($i = 0; $i < count($posttexts); $i++) { 
      echo '<div class="post">'; 
      echo '<div class="postimg">'; 
      echo '<img src="' . $images[$i % count($images)] . '" alt="">';
      echo '</div>'; 
      echo '<div class="posttext">'; 
      echo '<h2>' . $posttexts[$i]["title"] . '</h2>';
      echo '<p>' . $posttexts[$i]["content"] . '</p>'; 
      echo '</div>'; 
      echo '</div>'; 
    }
    ?>
  </div>
</body>

</html>
<?php include 'footer.php'; ?>
