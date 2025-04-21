<!DOCTYPE html>
<html>

<head>
    <title>Bebook</title>
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

use FontLib\Table\Type\head;

include('connect_bd.php');
include('functions.php');
if (isset($_SESSION['id_user'])) {
    $sql = "SELECT * FROM users WHERE id_user=" . $_SESSION['id_user'];
    $query = mysqli_query($conn, $sql);
    $value = mysqli_fetch_assoc($query);
} else
    echo ('location:login.php');

?>

<body>

    <?php include("header_u.php") ?>

    <div class="site-section">
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col-md-12">
                    <h2 class="h3 mb-3 text-black" style="text-align:center">Edite seu perfil!</h2>
                </div>
                <div class="col-md-7">

                    <form name="form" action="" onsubmit="return  validateForm()" method="post" enctype="multipart/form-data">

                        <div class="p-3 p-lg-5 border">
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="pic">Foto</label><br>
                                    <img id="blah" alt="your image" width="100" height="100" /><br>
                                    <input type="file" name="pic" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="name" class="text-black">Nome </label>
                                    <input type="text" class="form-control" name="name" placeholder="" value="<?php if (isset($value['name'])) echo $value['name'] ?>">
                                    <p id="a"></p>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="c_email" class="text-black">Email <span id="email"></span></label>
                                    <input type="email" class="form-control" name="email" placeholder="" value="<?php if (isset($value['email'])) echo $value['email'] ?>">
                                    <p id="b"></p>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="Password" class="text-black">Password </label>
                                    <input type="password" class="form-control" name="password">
                                    <span id="c"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="c_Password" class="text-black">Confirme a Password </label>
                                    <input type="password" class="form-control" name="c_password">
                                    <p id="d"></p>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="name" class="text-black">Data de nascimento</label>
                                    <input type="text" class="form-control" name="borndate" placeholder="" value="<?php if (isset($value['borndate'])) echo $value['borndate'] ?>">
                                    <span id="borndate"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="name" class="text-black">Endereço</label><span id="address"></span></label>
                                    <input type="text" class="form-control" name="address" placeholder="" value="<?php if (isset($value['address'])) echo $value['address'] ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="name" class="text-black">Região</label><span id="region"></span></label>
                                    <input type="text" class="form-control" name="region" placeholder="" value="
                                    <?php if (isset($value['zip'])) {
                                        $sql = "SELECT * from zip_code where zip =" . $value['zip'];
                                        $result = mysqli_query($conn, $sql);
                                        $region = mysqli_fetch_assoc($region);
                                        echo $region['region'];
                                    } ?>">
                                </div>
                                <div class="col-md-6">
                                    <label for="name" class="text-black">Codigo postal:</label><span id="zip"></span></label>
                                    <input type="text" class="form-control" name="zip" placeholder="" value="<?php if (isset($value['zip'])) echo $value['zip'] ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-12">
                                    <input type="submit" class="btn btn-primary btn-lg btn-block">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
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
            x = document.getElementsByName("password")[0].value;
            if (!CheckPassword(x) || x == "") {
                document.getElementById('c').innerHTML = "<ul><li>A password têm de conter de 7 a 15 caracteres</li><li>No minimo um caracter um caracter especial</li> ";
                return false;
            } else
                document.getElementById('c').innerHTML = "";
            x = document.getElementsByName("c_password")[0].value;
            if (x == "") {
                document.getElementById('d').innerHTML = "As passwords tem de ser iguais";
                return false;
            } else
                document.getElementById('d').innerHTML = "";
        }
    </script>
    <?php include("footer.php") ?>
</body>

</html>