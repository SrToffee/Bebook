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
$sql="SELECT * FROM farorite_list WHERE farovite_list.id_user =".$_SESSION['id_user'];
$query = mysqli_query($conn, $sql);
?>

<body>

  <div class="site-wrap">
    <?php include("header_u.php"); ?>

    <div class="bg-light py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-12 mb-0"><a href="index.html">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Cart</strong></div>
        </div>
      </div>
    </div>

    <div class="site-section">
      <div class="container">
        <div class="row mb-5">
          <form class="col-md-12" method="post">
            <div class="site-blocks-table">
              <?php if (mysqli_num_rows($query) > 0) { ?>
                <table class="table">

                  <tbody>

                    <?php
                    $value = mysqli_fetch_assoc($query);
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
                        <h2 class="h5 text-black">' . $value['name'] . '</h2>
                      </td>
                      <td>' . number_format($value['price'], 2) . ' €</td>
                      <td><a href="cart.php?remove=1&&id_book=' . $value['id_book'] . '" class="btn btn-primary btn-sm">X</a></td>
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
            <div class="row">
              <div class="col-md-12">
                <label class="text-black h4" for="coupon"></label>
                <p>Enter your coupon code if you have one.</p>
              </div>
              <div class="col-md-8 mb-3 mb-md-0">
                <input type="text" class="form-control py-3" id="coupon" placeholder="Coupon Code">
              </div>
              <div class="col-md-4">
                <button class="btn btn-primary btn-sm">Apply Coupon</button>
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
                $price += $value['price'];
              }
              $_SESSION['cart_t'] = $price;
            }
            ?>
            <div class="row justify-content-end">
              <div class="col-md-7">
                <div class="row">
                  <div class="col-md-12 text-right border-bottom mb-5">
                    <h3 class="text-black h4 text-uppercase">Cart Totals</h3>
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-md-6">
                    <span class="text-black">Subtotal</span>
                  </div>
                  <div class="col-md-6 text-right">
                    <strong class="text-black"><?php echo $price . ' €' ?></strong>
                  </div>
                </div>
                <div class="row mb-5">
                  <div class="col-md-6">
                    <span class="text-black">Total</span>
                  </div>
                  <div class="col-md-6 text-right">
                    <strong class="text-black"><?php echo $price . ' €' ?></strong>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12">
                    <button class="btn btn-primary btn-lg py-3 btn-block" onclick="window.location='checkout.php'">Proceed To Checkout</button>
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