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

if (!isset($_SESSION['id_user'])) {
    header('location: login.php');
}
$sql = "SELECT * FROM users WHERE id_user = " . $_SESSION['id_user'];
$query = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($query);
?>

<body>

    <div class="site-wrap">
        <?php include("header_u.php"); ?>

        <div class="site-section">
            <div class="container">
                <form name="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
                    <div class="row mb-5">
                        <div class="col-md-6">
                            <p><img src="<?php echo $user['pic'] ?>" alt="Image" id="pic" class="img-fluid" max-width="100px"></p>
                        </div>
                        <div class="col-md-6">
                            <h2 class="text-black"><?php echo $user['name'] ?></h2>
                            <a href="user_edit.php">Editar perfil</a>
                        </div>
                    </div>
                </form>
                <div class="row mb-5">
                    <form class="col-md-12" method="post">
                        <div class="site-blocks-table">
                            <table class="table">
                                <thead class="thead bg-primary text-white">
                                    <tr>
                                        <th>Id</th>
                                        <th>Data</th>
                                        <th>Total</th>
                                        <th>Livros</th>
                                        <th>Fatura</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT * FROM orders WHERE id_user = " . $_SESSION['id_user'];
                                    $result = mysqli_query($conn, $sql);
                                    if (mysqli_num_rows($result)) {
                                        while ($sells = mysqli_fetch_assoc($result)) {
                                            echo '
                                                <tr>
                                                <td class="product-name">
                                                <h2 class="h5 text-black">' . $sells['id_order'] . '</h2>
                                                </td>
                                                <td class="product-name">
                                                    <h2 class="h5 text-black">' . $sells['o_date'] . '</h2>
                                                </td>
                                                <td class="product-name">
                                                    <h2 class="h5 text-black">' . $sells['total'] . '</h2>
                                                </td>
                                                <td>
                                                <div class="dropdown">
                                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Ver
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">';
                                            $sql = "SELECT order_d.*, book.name, order_d.price
                                                FROM  order_d, orders, book
                                                where order_d.id_order = orders.id_order 
                                                && orders.id_order = " . $sells['id_order'] . ' && order_d.id_book = book.id_book';
                                            $query = mysqli_query($conn, $sql);
                                            while ($item = mysqli_fetch_assoc($query))
                                                echo '<a class="dropdown-item" href="book_page.php?id_book=' . $item['id_book'] . '">' . $item['id_book'] . ' |' . $item['name'] . ' | ' . $item['price'] . '</li>';
                                            echo '</div>
                                                    </div>
                                                </td>
                                                ';
                                            echo '<td><a href="order_pdf.php?id_order=' . $sells['id_order'] . '">Fatura</a></td>';
                                        }
                                    } else

                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <?php include("footer.php") ?>

</body>

</html>