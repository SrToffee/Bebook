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
include('functions.php'); ?>

<body>

    <div class="wrapper">

        <?php include("aside.php"); ?>

        <div class="main-panel">

            <?php include("header.php"); ?>

            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-3">
                            <p></p>
                        </div>
                        <div class="col-9">
                            <p>géneros</p>
                            <table class="table" border="1px solid black">
                                <tr>
                                    <td>Id</td>
                                    <td>Nome</td>
                                </tr>
                                <?php
                                $sql = "SELECT * FROM gender";
                                $result = mysqli_query($conn, $sql);
                                if ($gender = mysqli_fetch_assoc($result)) {
                                    do {
                                        echo '<tr><td><a href="customer_page.php">' . $gender['id_gender'] . '</a></td>
                                            <td>' . $gender['name'] . '</td></tr>';
                                    } while ($gender = mysqli_fetch_assoc($result));
                                } else
                                    'sem registros';
                                ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <?php include("footer.php"); ?>

</body>




</html>