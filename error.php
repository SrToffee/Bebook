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
    <?php
    if (isset($_GET['back']))
        header('Refresh:5; url=' . $_GET['back']);
    if (isset($_GET['show']))
        echo '<h1>' . $_GET['back'] . '</h1>';
    ?>
</head>

<body>
    <?php
    include('login_val.php');
    ?>
    <?php include("header_u.php") ?>

    <div class="site-section">
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col-md-12 ">
                    <h2 class="h3 mb-3 text-black" style="text-align:center">Ocorreu um erro...</h2>
                    <h5 class="h5 mb-3 text-black" style="text-align:center">
                        <?php
                        for ($i = 1; $i <= 5; $i++) {
                            sleep(100);
                            echo ' ' . $i . ' ';
                        }
                        ?></h5>
                </div>

            </div>
        </div>
    </div>
    <?php include("footer.php") ?>
</body>

</html>