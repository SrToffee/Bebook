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
$sql = "SELECT orders.*, users.name
        FROM  users, orders
        where users.id_user = orders.id_user
        order by id_order desc";
$result = mysqli_query($conn, $sql);
?>

<body>

    <div class="wrapper">

        <?php include("aside.php"); ?>

        <div class="main-panel">

            <?php include("header.php"); ?>

            <div class="content">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <?php if (mysqli_num_rows($result) > 0) { ?>
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
                                    }?>
                                    </tbody>
                                </table>
                            <?php } else {
                                echo '<p>Sem registros de utilizadores!</p>';
                            } ?>
                        </div>
                    </div>
                </div>
            </div>

            <?php include("footer.php"); ?>

</body>




</html>