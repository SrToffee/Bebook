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

    $table = "author";
    $condition = "id_author =" . $_POST['id_author'];
    if (tool_update($_POST, $condition, $table))
        header('location:category_list.php');
    else
        header('location: error.php?back=' . $_SERVER["PHP_SELF"]);
}
if (isset($_GET['id_author'])) {
    $sql = "select * from author where id_author =" . $_GET['id_author'];
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
                    <form name="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" onsubmit="return validation()" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id_author" value="<?php echo $_GET['id_author'] ?>">
                        <div class="row">
                            <div class="col-md-6">
                                <img id="blah" src="<?php echo $value['pic'] ?>" alt="Image" class="img-fluid" width="400px">
                                <input type="file" name="pic" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <label for="name" class="text-black">Nome </label>
                                        <input type="text" class="form-control" name="name" placeholder="" value="<?php echo $value['name'] ?>">
                                        <span id="c"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <label for="name" class="text-black">Biografia: </label><br>
                                        <textarea name="bio"><?php echo $value['bio']; ?></textarea>
                                        <span id="v_bio"></span>
                                    </div>
                                </div>
                                <input type="submit" class="btn btn-primary btn-lg btn-block" value="Inserir">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script>
            function isAlphanumeric(str) {
                return /^[0-9]+$/.test(str);
            }

            function CheckPassword(inputtxt) {
                var paswd = /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{7,15}$/;
                if (inputtxt.match(paswd)) {
                    return true;
                } else {
                    return false;
                }
            }

            function validateForm() {
                var x = document.getElementsByName("name")[0].value;
                if (x == "") {
                    document.getElementById('a').innerHTML = "O nome não pode estar vazio!";
                    return false;
                } else
                    document.getElementById('a').innerHTML = "";

            }
        </script>
        <?php include("footer.php"); ?>

</body>

</html>