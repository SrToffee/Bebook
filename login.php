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
include('connect_bd.php');
include('functions.php'); ?>

<body>

  <?php include("header_u.php") ?>

  <div class="site-section">
    <div class="container">
      <div class="row justify-content-md-center">
        <div class="col-md-12 ">
          <h2 class="h3 mb-3 text-black" style="text-align:center">Logar</h2>
        </div>
        <div class="col-md-7">

          <form action="login_val.php" onsubmit="return validateForm()" method="post">

            <div class="p-3 p-lg-5 border">
              <div class="form-group row">
                <div class="col-md-12">
                  <label for="c_email" class="text-black">Email </label>
                  <input type="email" class="form-control" id="email" name="email" placeholder="" value="<?php if (isset($_POST['email'])) echo $_POST['email'] ?>">
                  <p id="b"></p>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-md-12">
                  <label for="Password" class="text-black">Password </label>
                  <input type="password" class="form-control" id="password" name="password">
                  <p id="c"><?php if(isset ($_GET['w_pass'])) echo 'Email ou Password Errado, tente novamente!'?></p>
                </div>

              </div>

              <div class="form-group row">
                <div class="col-lg-12">
                  <input type="submit" class="btn btn-primary btn-lg btn-block" value="Login">
                  <button type="button" class="btn btn-primary btn-lg btn-block" onclick="window.location='signup.php'">Registrar</button>
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
      var x = document.getElementsByName("email")[0].value;
      if (x == "") {
        document.getElementById('b').innerHTML = "O email não pode estar vazio!";
        return false;
      } else
        document.getElementById('b').innerHTML = "";
      pass = document.getElementsByName("password")[0].value;
      if (!CheckPassword(pass) || pass == "") {
        document.getElementById('c').innerHTML = "A password têm de conter de 7 a 15 caracteres ";
        return false;
      } else
        document.getElementById('c').innerHTML = "";
      return true;
    }
  </script>
  <?php include("footer.php") ?>
</body>

</html>