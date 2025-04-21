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
    if (isset($_POST['zip'])) {
        $sql = "select * from zip_code where zip =" . $_POST['zip'];
        if (mysqli_num_rows(mysqli_query($conn, $sql)) == 0)
            unset($_POST['zip']);
    }

    $table = 'users';
    if (!($id_book = tool_insert($_POST, $table)));
    $error = "Email repetido";
    header('location:users_list.php');
}

?>

<body>

    <div class="wrapper">

        <?php include("aside.php"); ?>

        <div class="main-panel">

            <?php include("header.php"); ?>

            <div class="content">
                <div class="container">
                    <p><strong class="text-primary h4">Inserir Utilizador</strong>
                    <form name="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" onsubmit="return validateForm()" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6">
                                <img id="blah" src="" alt="Image" class="img-fluid" width="400px">
                                <input type="file" name="pic" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                            </div>
                            <div class="col-md-6">
                                <div class="p-3 p-lg-5 border">
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <label for="name" class="text-black">Nome </label>
                                            <input type="text" class="form-control" id="name" name="name" placeholder="" value="<?php if (isset($_POST['name'])) echo $_POST['name'] ?>">
                                            <p id="a"></p>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <label for="c_email" class="text-black">Email </label>
                                            <input type="email" class="form-control" id="c_email" name="email" placeholder="" value="<?php if (isset($_POST['email'])) echo $_POST['email'] ?>">
                                            <p id="b"><?php if (isset($error)) echo $error; ?></p>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <label for="Password" class="text-black">Password </label>
                                            <input type="password" class="form-control" id="c_subject" name="password">
                                            <p id="c"></p>
                                        </div>
                                    </div>
                                    <select name="u_type">
                                        <option value="0">Administrador</option>
                                        <option value="1">Regular</option>
                                    </select>
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <label for="name" class="text-black">Endereço: </label>
                                            <input type="text" class="form-control" id="address" name="address" placeholder="" value="<?php if (isset($_POST['address'])) echo $_POST['address'] ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <label for="name" class="text-black">Contacto: </label>
                                            <input type="text" class="form-control" id="address" name="Contact" placeholder="" value="<?php if (isset($_POST['Contact'])) echo $_POST['Contact'] ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <label for="name" class="text-black">Data de nascimento: </label>
                                            <input type="date" name="borndate" value="<?php echo (isset($book['borndate']) ? 'value=' . $book['borndate'] : '') ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-12">
                                            <input type="submit" class="btn btn-primary btn-lg btn-block" value="Inserir">
                                        </div>
                                    </div>
                                </div>

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

                x = document.getElementsByName("email")[0].value;
                if (x == "") {
                    document.getElementById('b').innerHTML = "O email não pode estar vazio!";
                    return false;
                } else
                    document.getElementById('b').innerHTML = "";
                pass = document.getElementsByName("password")[0].value;
                y = document.getElementsByName("c_password")[0].value;
                if (!CheckPassword(pass) || pass == "") {
                    document.getElementById('c').innerHTML = "<ul><li>A password têm de conter de 7 a 15 caracteres</li><li>No minimo um caracter um caracter especial</li></ul> ";
                    return false;
                } else
                    document.getElementById('c').innerHTML = "";

                if (y == "" || pass != y) {
                    document.getElementById('d').innerHTML = "As passwords tem de ser iguais";
                    return false;
                } else
                    document.getElementById('d').innerHTML = "";
            }
        </script>
        <?php include("footer.php"); ?>

</body>

</html>