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
if (!empty($_GET)) {
    if (isset($_GET['disable']))
        $sql = "update users set stat = 0 where id_user =" . $_GET['disable'];
    else
        if (isset($_GET['able']))
            $sql = "update users set stat = 1 where id_user =" . $_GET['able'];
    mysqli_query($conn, $sql);
}
$sql = "SELECT * FROM users WHERE u_type = 1";
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
                        <div class="col-3">
                            <p></p>
                        </div>
                        <div class="col-9">
                            <?php if (mysqli_num_rows($result) > 0) { ?>
                                <p>Utilizadores - <button type="button" class="btn btn-secundary" value="" onclick="window.location='user_insert.php'">Inserir um novo Utilizador</button></p>
                                <table class="table">
                                    <thead class="thead bg-primary text-white">
                                        <tr>
                                            <th>Id</th>
                                            <th>Nome</th>
                                            <th>Email</th>
                                            <th>Contacto</th>
                                            <th>Estado</th>
                                            <th>Desativar/Ativar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        while ($user = mysqli_fetch_assoc($result)) {
                                            echo '<tr><td><a href="customer_page.php">' . $user['id_user'] . '</a></td>
                                            <td>' . $user['name'] . '</td>
                                            <td>' . $user['email'] . '</td>
                                            <td>' . $user['contact'] . '</td>';
                                            echo ($user['stat']) ? '<td>Ativo</td>' : '<td>Desativado</td>';
                                            echo '<td><a href="' . $_SERVER["PHP_SELF"] . '?';
                                            echo ($user['stat']) ? 'disable=' : 'able=';
                                            echo $user['id_user'] . '">X</a></td></tr>';
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            <?php } else {
                                echo '<p>Sem registros de utilizadores!</p>';
                            } ?>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <?php include("footer.php"); ?>

</body>




</html>