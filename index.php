<!DOCTYPE html>
<html lang="en">

<head>
  <title>Bebook</title>
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
?>

<body>

  <div class="site-wrap">
    <?php include("header_u.php"); ?>

    <div class="site-blocks-cover" style="background-image: url(img/library.jpg);" data-aos="fade">
      <div class="container">
        <div class="row align-items-start align-items-md-center justify-content-end">
          <div class="col-md-5 text-center text-md-left pt-5 pt-md-0">
            <h1 class="mb-2" style="color:aliceblue;">Encontre uma historia para se aventurar!</h1>
            <div class="intro-text text-center text-md-left">
              <p class="mb-4" style="color:aliceblue;">Na maior biblioteca virtual não há limites!</p>
              <p>
                <a href="library.php" class="btn btn-sm btn-primary">Explorar</a>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="site-section site-section-sm site-blocks-1">
      <div class="container">
        <div class="row">
          <div class="col-md-6 col-lg-4 d-lg-flex mb-4 mb-lg-0 pl-4" data-aos="fade-up" data-aos-delay="">
            <div class="icon mr-4 align-self-start">
              <span class="icon-book"></span>
            </div>
            <div class="text">
              <h2 class="text-uppercase">Acesso instantanêo</h2>
              <p>Após pagamento acesso imediato ao livro comprado</p>
            </div>
          </div>
          <div class="col-md-6 col-lg-4 d-lg-flex mb-4 mb-lg-0 pl-4" data-aos="fade-up" data-aos-delay="100">
            <div class="icon mr-4 align-self-start">
              <span class="icon-refresh2"></span>
            </div>
            <div class="text">
              <h2 class="text-uppercase">Retorno gratuito</h2>
              <p>retorno da compra ate 7 dias apos a compra.</p>
            </div>
          </div>
          <div class="col-md-6 col-lg-4 d-lg-flex mb-4 mb-lg-0 pl-4" data-aos="fade-up" data-aos-delay="200">
            <div class="icon mr-4 align-self-start">
              <span class="icon-help"></span>
            </div>
            <div class="text">
              <h2 class="text-uppercase">Suporte ao cliente</h2>
              <p>Suporte 24 horas</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="site-section site-blocks-2">
      <div class="container">
        <div class="row">
          <?php
          $sql = 'SELECT * from gender limit 3';
          $result = mysqli_query($conn, $sql);
          if (mysqli_num_rows($result)) {
            while ($row = mysqli_fetch_assoc($result))
              echo '<div class="col-sm-6 col-md-6 col-lg-4 mb-4 mb-lg-0" data-aos="fade" data-aos-delay="">
          <a class="block-2-item" href="library.php?id_gender='.$row['id_gender'].'">
            <figure class="image">
              <img src="' . $row['pic'] . '" alt="" class="img-fluid">
            </figure>
            <div class="text">
              <span class="text-uppercase">géneros</span>
              <h3>' . $row['name'] . '</h3>
            </div>
          </a>
        </div>';
          }
          ?>
        </div>
      </div>
    </div>

    <div class="site-section block-3 site-blocks-2 bg-light">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-7 site-section-heading text-center pt-4">
            <h2>Mais vendidos!</h2>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="nonloop-block-3 owl-carousel">
              <?php
              $sql = "SELECT count(order_d.id_book) as sells, book.* 
                from book, order_d
                where book.stat = 1 && book.id_book = order_d.id_book group by book.id_book order by sells;";
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

    <div class="site-section block-8">
      <div class="container">
        <div class="row justify-content-center  mb-5">
          <div class="col-md-7 site-section-heading text-center pt-4">
            <h2>Grande promoção!</h2>
          </div>
        </div>
        <div class="row align-items-center">
          <div class="col-md-12 col-lg-7 mb-5">
            <a href="#"><img src="img/offer.jpg" alt="Image placeholder" class="img-fluid rounded"></a>
          </div>
          <div class="col-md-12 col-lg-5 text-center pl-md-5">
            <h2><a href="#">Comprar um livro ganha 50% no segundo!</a></h2>
            <p>Aproveite agora mesmo e compre quantos livros sua estante caber!</p>
            <p><a href="library.php" class="btn btn-primary btn-sm">Promoção</a></p>
          </div>
        </div>
      </div>
    </div>


    <?php include("footer.php") ?>
</body>

</html>