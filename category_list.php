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
if (isset($_GET['remove'])) {
     $key = array_keys($_GET);
    switch ($key[1]) {
        case 'id_author':
            $table = "author";
            break;
        case 'id_author':
            $table = "gender";
            break;
        case 'id_pub':
            $table = "publisher";
            break;
    }
    $sql = "DELETE FROM " . $table . " WHERE " . $key[1] . " = " . $_GET[$key[1]];
    mysqli_query($conn, $sql);
    header('lcoation: category_list.php');
}

?>

<body>

    <div class="wrapper">

        <?php include("aside.php"); ?>

        <div class="main-panel">

            <?php include("header.php"); ?>

            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-6 col-sm-6">
                            <?php
                            $sql = "SELECT * FROM gender";
                            $result = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($result) > 0) {
                            ?>
                                <p>géneros - <button type="button" class="btn btn-secundary" value="" onclick="window.location='gender_insert.php'">Inserir um novo género</button></p>
                                <table class="table">
                                    <thead class="thead bg-primary text-white">
                                        <tr>
                                            <td>Id</td>
                                            <td>Nome</td>
                                            <td>Eliminar</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        while ($value = mysqli_fetch_assoc($result)) {
                                            echo '<tr><td><a href="gender_edit.php?id_gender=' . $value['id_gender'] . '">' . $value['id_gender'] . '</a></td>
                                            <td>' . $value['name'] . '</td>
                                            <td><a href="category_list.php?remove=1&&id_gender=' . $value['id_gender'] . '">x</td></tr>';
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            <?php } else {
                                echo "<p>Nenhum género registrado!</p>";
                            } ?>
                        </div>
                        <div class="col-lg-6 col-sm-6">
                            <?php
                            $sql = "SELECT * FROM publisher";
                            $result = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($result) > 0) {
                            ?>
                                <p>Editora - <button type="button" class="btn btn-secundary" value="" onclick="window.location='publisher_insert.php'">Inserir um nova editora</button></p>
                                <table class="table">
                                    <thead class="thead bg-primary text-white">
                                        <tr>
                                            <td>Id</td>
                                            <td>Nome</td>
                                            <td>Eliminar</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        while ($value = mysqli_fetch_assoc($result)) {
                                            echo '<tr><td><a href="publisher_edit.php?id_pub=' . $value['id_pub'] . '">' . $value['id_pub'] . '</a></td>
                                            <td>' . $value['name'] . '</td>
                                            <td><a href="category_list.php?remove=1&&id_pub=' . $value['id_pub'] . '">x</a></td></tr>';
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            <?php } else {
                                echo "<p>Nenhuma editora registrada!</p>";
                            } ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <?php
                            $sql = "SELECT * FROM author";
                            $result = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($result) > 0) {
                            ?>
                                <p>Autores - <button type="button" class="btn btn-secundary" value="" onclick="window.location='author_insert.php'">Inserir um novo autor</button></p>
                                <table class="table">
                                    <thead class="thead bg-primary text-white">
                                        <tr>
                                            <td>Id</td>
                                            <td>Nome</td>
                                            <td>Eliminar</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        while ($value = mysqli_fetch_assoc($result)) {
                                            echo '<tr><td><a href="author_edit.php?id_author=' . $value['id_author'] . '">' . $value['id_author'] . '</a></td>
                                            <td>' . $value['name'] . '</td>
                                            <td><a href="category_list.php?remove=1&&id_author=' . $value['id_author'] . '">x</td></tr>';
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            <?php } else {
                                echo "<p>Nenhum género registrado!</p>";
                            } ?>
                        </div>

                        
                    </div>
                </div>
            </div>
        </div>

        <?php include("footer.php"); ?>

</body>

</html>