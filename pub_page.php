<!DOCTYPE html>
<html lang="en">

<head>
  <title>BeBOOK</title>
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

if (isset($_GET['id_pub'])) {
  $sql = "SELECT * FROM publisher where id_pub =" . $_GET['id_pub'];
  $pub_query = mysqli_query($conn, $sql);
  if (mysqli_num_rows($pub_query) == 1) {
    $row = mysqli_fetch_assoc($pub_query);
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
          <div class="col-md-12 mb-0"><a href="index.php">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black"><?php echo $row['name'] ?></strong></div>
        </div>
      </div>
    </div>

    <div class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h2 class="text-black" style="text-align: center"><?php echo $row['name'] ?></h2>
            <div class="site-section block-3 site-blocks-2 bg-light">
              <div class="container">
                <div class="row justify-content-center">
                  <div class="col-md-7 site-section-heading text-center pt-4">
                    <h2>Livros relacionados!</h2>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="nonloop-block-3 owl-carousel">
                      <?php
                      $sql = "SELECT  book.* from book where book.stat = 1 && id_pub = " . $row['id_pub'];
                      $result = mysqli_query($conn, $sql);
                      if (mysqli_num_rows($result)) {
                        while ($row = mysqli_fetch_assoc($result))
                          echo '<div class="item">
                    <div class="block-4 text-center">
                      <figure class="block-4-image">
                        <img src="' . $row['pic'] . '" alt="Image placeholder" class="img-fluid">
                      </figure>
                      <div class="block-4-text p-4">
                        <h3><a href="book_page.php?id_book=' . $row['id_book'] . '">' . $row['name'] . '</a></h3>
                        <p class="mb-0">Leia agora!</p>
                        <p class="text-primary font-weight-bold">' . $row['price'] . ' €</p>
                      </div>
                    </div>
                  </div>';
                      }
                      ?>

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>



    <?php include("footer.php") ?>

</body>

</html>