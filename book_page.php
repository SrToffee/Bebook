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

if (isset($_GET['id_book'])) {
  $sql = "SELECT book.*, publisher.name as pub FROM book,publisher where book.id_pub = publisher.id_pub and id_book =" . $_GET['id_book'];
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
          <div class="col-md-12 mb-0"><a href="index.php">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black"><?php echo $book['name'] ?></strong></div>
        </div>
      </div>
    </div>

    <div class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <img src="<?php echo $book['pic'] ?>" alt="Image" class="img-fluid">
          </div>
          <div class="col-md-6">
            <h2 class="text-black"><?php echo $book['name'] ?></h2>
            <?php
            $sql = "SELECT author.name, author.id_author from author, book_author where author.id_author = book_author.id_author AND book_author.id_book = " . $book['id_book'];
            $query = mysqli_query($conn, $sql);
            echo '<p>Autores:';
            for ($i = 0; $i < mysqli_num_rows($query); $i++) {
              $author = mysqli_fetch_assoc($query);
              echo '<a href="author_page.php?id_author=' . $author['id_author'] . '">';
              echo ($i + 1 == mysqli_num_rows($query)) ? $author['name'] : $author['name'] . ' - ';
              echo '</a>';
            }
            echo '</p>';

            echo '<p>Editora: <a href="pub_page.php?id_pub=' . $book['id_pub'] . '">' . $book['pub'] . '</a></p>';
            ?>
            <p><strong class="text-primary h7">
                <?php
                $sql = "SELECT gender.name, gender.id_gender from gender, book_gender where gender.id_gender = book_gender.id_gender AND book_gender.id_book = " . $book['id_book'];
                $query = mysqli_query($conn, $sql);
                for ($i = 0; $i < mysqli_num_rows($query); $i++) {
                  $author = mysqli_fetch_assoc($query);
                  echo '<a href="gender_page.php?id_gender=' . $author['id_gender'] . '">';
                  echo ($i + 1 == mysqli_num_rows($query)) ? $author['name'] : $author['name'] . ' - ';
                  echo '</a>';
                }
                ?>
              </strong>
            </p>
            <p><?php echo $book['sinopse'] ?></p>
            <p><strong class="text-primary h4"><?php echo $book['price'] ?> € </strong></p>

            <?php
            if (isset($_SESSION['id_user'])) {
              $sql = "select * from book_user where id_user =" . $_SESSION['id_user'] . "&& id_book=" . $_GET['id_book'];
              if (mysqli_num_rows(mysqli_query($conn, $sql)) == 1)
                echo '<button class="btn btn-primary btn-sm">Ler</button>';
                else
                echo '<form name="form" method="post" action="cart_update.php">
                  <input type="hidden" value="' . $book['id_book'] . '" name="id_book">
                  <button type="submit" class="btn btn-primary btn-sm">Adicionar ao carrinho</button>
                </form>';
            } else
              echo '<form name="form" method="post" action="cart_update.php">
                <input type="hidden" value="' . $book['id_book'] . '" name="id_book">
                <button type="submit" class="btn btn-primary btn-sm">Adicionar ao carrinho</button>
              </form>'
            ?>

          </div>
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

    <?php include("footer.php") ?>

</body>

</html>