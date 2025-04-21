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
if (isset($_SESSION['id_user']) && isset($_SESSION['cart'])) {
  $aux = array_keys($_SESSION['cart']);
  foreach ($aux as $id) {
    $sql = "select * from book_user where id_user =" . $_SESSION['id_user'] . "&& id_book=" . $id;
    if (mysqli_num_rows(mysqli_query($conn, $sql)) == 1)
      unset($_SESSION['cart'][$id]);
  }
}
if (isset($_GET['remove'])) {
  if (isset($_SESSION['cart'][$_GET['id_book']]))
    unset($_SESSION['cart'][$_GET['id_book']]);
  if (count($_SESSION['cart']) == 0)
    unset($_SESSION['cart']);
  header('location:cart.php');
  if (count($_SESSION['cart']) > 1) {
    $aux = array_keys($_SESSION['cart']);
    $cheap =  $value['exp'] = mysqli_fetch_assoc(mysqli_query($conn, "select max(price) as exp from book"));
    foreach ($aux as $id) {
      $sql = "select * from book where id_book =" . $id;
      $price = mysqli_fetch_assoc(mysqli_query($conn, $sql));
      if ($cheap >= $price['price'])
        $_SESSION['cheap'] = $id;
    }
  } else
    if (isset($_SESSION['cheap']))
    unset($_SESSION['cheap']);
}
?>

<body>

  <div class="site-wrap">
    <?php include("header_u.php"); ?>

    <div class="bg-light py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-12 mb-0"><a href="index.html">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Carrinho</strong></div>
        </div>
      </div>
    </div>

    <div class="site-section">
      <div class="container">
        <div class="row mb-5">
          <form class="col-md-12" method="post">
            <div class="site-blocks-table">
              <?php if (isset($_SESSION['cart'])) { ?>
                <table class="table">

                  <tbody>

                    <?php
                    $books = array_keys($_SESSION['cart']);
                    foreach ($books as $id) {
                      $sql = 'SELECT * FROM book WHERE id_book =' . $id;
                      $query = mysqli_query($conn, $sql);
                      $value = mysqli_fetch_assoc($query);
                      echo '
                      <tr>
                      <td class="product-thumbnail">
                        <img src="' . $value['pic'] . '" alt="Image" class="img-fluid">
                      </td>
                      <td class="product-name">
                        <h2 class="h5 text-black"><a href="book_page.php?id_book=' . $value['id_book'] . '">' . $value['name'] . '</a></h2>
                      </td>';
                      if (isset($_SESSION['cheap']) && $_SESSION['cheap'] == $value['id_book'])
                        echo '<td>' . number_format($value['price'] / 2, 2) . ' €</td>';
                      else
                        echo '<td>' . number_format($value['price'], 2) . ' €</td>';
                      echo '<td><a href="cart.php?remove=1&&id_book=' . $value['id_book'] . '" class="btn btn-primary btn-sm">X</a></td>
                    </tr>
                      ';
                    }
                    ?>
                  </tbody>
                </table>
              <?php
              } else
                echo '<h2 class="text-uppercase">Carrinho vazio!</h2>'; ?>
            </div>
          </form>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="row mb-5">

              <div class="col-md-12">
                <button class="btn btn-outline-primary btn-sm btn-block" onclick="window.location='library.php'">Continue a comprar</button>
              </div>
            </div>

          </div>
          <div class="col-md-6 pl-5">
            <?php
            $price = 0;
            if (isset($_SESSION['cart'])) {
              $books = array_keys($_SESSION['cart']);
              foreach ($books as $id) {
                $sql = 'SELECT * FROM book WHERE id_book =' . $id;
                $query = mysqli_query($conn, $sql);
                $value = mysqli_fetch_assoc($query);
                if (isset($_SESSION['cheap']) && $_SESSION['cheap'] == $value['id_book'])
                  $price += $value['price'] / 2;
                else
                  $price += $value['price'];
              }
              $_SESSION['cart_t'] = $price;
            }
            ?>
            <div class="row justify-content-end">
              <div class="col-md-7">
                <div class="row">
                  <div class="col-md-12 text-right border-bottom mb-5">
                    <h3 class="text-black h4 text-uppercase">Total</h3>
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-md-6">
                    <span class="text-black">Subtotal (sem IVA)</span>
                  </div>
                  <div class="col-md-6 text-right">
                    <strong class="text-black"><?php echo number_format($price - ($price * 0.23), 2) . ' €' ?></strong>
                  </div>
                </div>
                <div class="row mb-5">
                  <div class="col-md-6">
                    <span class="text-black">Total (com IVA)</span>
                  </div>
                  <div class="col-md-6 text-right">
                    <strong class="text-black"><?php echo number_format($price, 2) . ' €' ?></strong>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12">
                    <button class="btn btn-primary btn-lg py-3 btn-block" onclick="window.location='checkout.php'" <?php if (!isset($_SESSION['cart'])) echo 'disabled'; ?>>Confirmar compra</button>
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