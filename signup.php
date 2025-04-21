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
include('functions.php');
include('connect_bd.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  form_validation($_POST);
  unset($_POST['c_password']);
  $table = 'users';
  if (!tool_insert($_POST, $table)) {
    $error = "Email invalido";
  }
  header('location:login.php');
}
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

          <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" onsubmit="return validateForm()" method="post">

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
                  <p id="b"><?php if (isset($error)) echo $error ?></p>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-md-12">
                  <label for="Password" class="text-black">Password </label>
                  <input type="password" class="form-control" id="c_subject" name="password">
                  <p id="c"></p>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-md-12">
                  <label for="c_Password" class="text-black">Confirme a Password </label>
                  <input type="password" class="form-control" id="c_subject" name="c_password">
                  <p id="d"></p>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-lg-12">
                  <input type="submit" class="btn btn-primary btn-lg btn-block" onclick="validation()" value="Registrar">
                </div>
              </div>
            </div>
          </form>
        </div>

      </div>
    </div>
  </div>
  <?php include("footer.php") ?>
</body>
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

</html>