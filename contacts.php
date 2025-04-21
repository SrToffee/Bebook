<!DOCTYPE html>
<html lang="en">

<head>
  <title>BeBook</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Mukta:300,400,700">
  <link rel="stylesheet" href="fonts/icomoon/style.css">

  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/magnific-popup.css">
  <link rel="stylesheet" href="css/jquery-ui.css">
  <link rel="stylesheet" href="css/owl.carousel.min.css">
  <link rel="stylesheet" href="css/owl.theme.default.min.css">


  <link rel="stylesheet" href="css/aos.css">

  <link rel="stylesheet" href="css/style.css">

</head>
<?php
include('functions.php');
include('connect_bd.php');

if (isset($_GET['id_book'])) {
  $sql = "SELECT * FROM book where id_book =" . $_GET['id_book'];
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) == 1) {
    $book = mysqli_fetch_assoc($result);
  } else
    header('location: index.php');
} else
  header('location: index.php');
?>

<body>

  <div class="site-wrap">
    <?php include("header_u.php"); ?>

    <div class="bg-light py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-12 mb-0"><a href="index.html">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Em breve</strong></div>
        </div>
      </div>
    </div>

    Em breve!

    <?php include("footer.php")?>

</body>

</html>