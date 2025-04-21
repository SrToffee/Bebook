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
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $table = "publisher";
    $condition = "id_pub =" . $_POST['id_pub'];
    if (tool_update($_POST, $condition, $table))
        header('location:category_list.php');
    else
        header('location: error.php?back=' . $_SERVER["PHP_SELF"]);
}
if (isset($_GET['id_pub'])) {
    $sql = "select * from publisher where id_pub =" . $_GET['id_pub'];
    $value = mysqli_fetch_assoc(mysqli_query($conn, $sql));
} else
    header('location: category_list.php');
?>

<body>

    <div class="wrapper">

        <?php include("aside.php"); ?>

        <div class="main-panel">

            <?php include("header.php"); ?>

            <div class="content">
                <div class="container">
                <p><strong class="text-primary h4">Alterar Editora</strong></p>
                    <form name="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" onsubmit="return validation()" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id_pub" value="<?php echo $_GET['id_pub'] ?>">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <label for="name" class="text-black">Nome </label>
                                        <input type="text" class="form-control" name="name" placeholder="" value="<?php echo $value['name'] ?>">
                                        <span id="v_name"></span>
                                    </div>
                                </div>

                                <input type="submit" class="btn btn-primary btn-lg btn-block" value="Inserir">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <?php include("footer.php"); ?>

</body>

</html>