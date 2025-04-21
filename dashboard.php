<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>Dashboard | bebook</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />

    <link href="assets/css/animate.min.css" rel="stylesheet" />

    <link href="assets/css/paper-dashboard.css" rel="stylesheet" />

    <link href="assets/css/demo.css" rel="stylesheet" />

    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/themify-icons.css" rel="stylesheet">

</head>
<?php
include('connect_bd.php');
include('functions.php');

?>

<body>

    <div class="wrapper">

        <?php include("aside.php"); ?>

        <div class="main-panel">

            <?php include("header.php"); ?>

            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-3 col-sm-6">
                            <div class="card">
                                <div class="content">
                                    <div class="row">
                                        <div class="col-xs-5">
                                            <div class="icon-big icon-warning text-center">
                                                <i class="ti-server"></i>
                                            </div>
                                        </div>
                                        <div class="col-xs-7">
                                            <div class="numbers">
                                                <?php
                                                $sql = "SELECT sum(total) as soma FROM orders";
                                                $result = mysqli_query($conn, $sql);
                                                $total = mysqli_fetch_assoc($result);
                                                echo "<p>Total faturado</p>" . number_format($total['soma'], 2) . "€</p>";
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="footer">
                                        <hr />
                                        <div class="stats">
                                            <p><i class="ti-reload"></i>
                                                <?php
                                                $sql = "SELECT max(id_order),total FROM orders;";
                                                $result = mysqli_query($conn, $sql);
                                                $total = mysqli_fetch_assoc($result);
                                                echo "Maior venda " . $total['total'] . "€</p>";
                                                ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <div class="card">
                                <div class="content">
                                    <div class="row">
                                        <div class="col-xs-5">
                                            <div class="icon-big icon-success text-center">
                                                <i class="ti-wallet"></i>
                                            </div>
                                        </div>
                                        <div class="col-xs-7">
                                            <div class="numbers">
                                                <?php
                                                $sql = "SELECT count(book.id_book) as sold
                                                FROM  book, order_d 
                                                where book.id_book = order_d.id_book";
                                                $result = mysqli_query($conn, $sql);
                                                $sold = mysqli_fetch_assoc($result);
                                                echo "<p>Livros vendidos</p>
                                                " . $sold['sold'];
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="footer">
                                        <hr />
                                        <div class="stats">
                                            <i class="ti-calendar"></i>
                                            <?php
                                            echo "Aproveitamento 100%";
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <div class="card">
                                <div class="content">
                                    <div class="row">
                                        <div class="col-xs-5">
                                            <div class="icon-big icon-danger text-center">
                                                <i class="ti-pulse"></i>
                                            </div>
                                        </div>
                                        <div class="col-xs-7">
                                            <div class="numbers">
                                                <?php
                                                $sql = "SELECT count(users.id_user) as buyers
                                                FROM  users, orders
                                                where users.id_user = orders.id_user group by users.id_user;";
                                                $result = mysqli_query($conn, $sql);
                                                $buyers = mysqli_fetch_assoc($result);

                                                $sql = "SELECT count(*) as total
                                                FROM  users";
                                                $result = mysqli_query($conn, $sql);
                                                $total = mysqli_fetch_assoc($result);
                                                echo "<p>Compradores/ Clientes</p>
                                                " . $buyers['buyers'] . "/" . $total['total'];
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="footer">
                                        <hr />
                                        <div class="stats">
                                            <i class="ti-timer"></i>
                                            <?php
                                            $value = ($buyers['buyers'] / $total['total']) * 100;
                                            echo "Aproveitamento " . number_format($value, 0) . "%";
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <div class="card">
                                <div class="content">
                                    <div class="row">
                                        <div class="col-xs-5">
                                            <div class="icon-big icon-info text-center">
                                                <i class="ti-gift"></i>
                                            </div>
                                        </div>
                                        <div class="col-xs-7">
                                            <div class="numbers">
                                                <?php
                                                $sql = "SELECT count(id_order) as total
                                                FROM  orders";
                                                $result = mysqli_query($conn, $sql);
                                                $orders = mysqli_fetch_assoc($result);
                                                echo "<p>Total de vendas</p>" . $orders['total'];
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="footer">
                                        <hr />
                                        <div class="stats">
                                            <i class="ti-reload"></i>
                                            <?php
                                            $sql = "SELECT count(id_order) as total
                                                FROM orders Where o_date >= '" . date("Y-m-d") . "'";
                                            $result = mysqli_query($conn, $sql);
                                            $orders = mysqli_fetch_assoc($result);
                                            echo "Vendas hoje +" . $orders['total'];
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <p>Vendas</p>
                            <table class="table">
                                <thead class="thead bg-primary text-white">
                                    <tr>
                                        <th>Id</th>
                                        <th>Data</th>
                                        <th>Utilizador</th>
                                        <th>Total</th>
                                        <th>Livros</th>
                                        <th>Fatura</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT orders.*, users.name
                                                FROM  users, orders
                                                where users.id_user = orders.id_user
                                                order by id_order desc limit 5";
                                    $result = mysqli_query($conn, $sql);
                                    if (mysqli_num_rows($result) > 0) {
                                        while ($value = mysqli_fetch_assoc($result)) {
                                            echo '<tr><td>' . $value['id_order'] . '</td>
                                                <td>' . $value['o_date'] . '</td>
                                                <td>' . $value['id_user'] . ' | ' . $value['name'] . '</td>
                                                <td>' . $value['total'] . '€</td>
                                                <td>
                                                <div class="dropdown">
                                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Ver
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">';
                                            $sql = "SELECT order_d.*, book.name, order_d.price
                                                FROM  order_d, orders, book
                                                where order_d.id_order = orders.id_order 
                                                && orders.id_order = " . $value['id_order'] . ' && order_d.id_book = book.id_book';
                                            $query = mysqli_query($conn, $sql);
                                            while ($item = mysqli_fetch_assoc($query))
                                                echo '<a class="dropdown-item" href="book_page.php?id_book=' . $item['id_book'] . '">' . $item['id_book'] . ' |' . $item['name'] . ' | ' . $item['price'] . '</a>';
                                            echo '</div>
                                                    </div>
                                                </td>
                                                <td><a class="dropdown-item" href="order_pdf.php?id_order=' . $value['id_order'] . '">Fatura</a></td>
                                            </tr>';
                                        }
                                    ?>
                                    <?php
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <p>Administradores</p>
                            <table class="table">
                                <thead class="thead bg-primary text-white">
                                    <tr>
                                        <th>Id</th>
                                        <th>Nome</th>
                                        <th>Email</th>
                                        <th>Contacto</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include('connect_bd.php');
                                    $sql = "SELECT * FROM users WHERE u_type = 0";
                                    $result = mysqli_query($conn, $sql);

                                    while ($admin = mysqli_fetch_assoc($result)) {
                                        echo '
                                            <tr>
                                                <td>' . $admin['id_user'] . '</td>
                                                <td>' . $admin['name'] . '</td>
                                                <td>' . $admin['email'] . '</td>
                                                <td>' . $admin['contact'] . '</td>
                                            </tr>';
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>


            <footer class="footer">
                <div class="container-fluid">

                    <div class="copyright pull-right">
                        &copy; <script>
                            document.write(new Date().getFullYear())
                        </script> Be-Book
                    </div>
                </div>
            </footer>

        </div>
    </div>


</body>

<script src="assets/js/jquery-1.10.2.js" type="text/javascript"></script>
<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

<script src="assets/js/bootstrap-checkbox-radio.js"></script>

<script src="assets/js/chartist.min.js"></script>

<script src="assets/js/bootstrap-notify.js"></script>

<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>

<script src="assets/js/paper-dashboard.js"></script>

<script src="assets/js/demo.js"></script>



</html>