<!DOCTYPE html>
<html lang="en">

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
if (!isset($_POST['search']))
    header('location:index.php');
$sql = "SELECT book.* FROM book WHERE book.stat = 1 && book.name LIKE '%" . $_POST['search'] . "%'";
$result = mysqli_query($conn, $sql);


?>

<body>

    <div class="site-wrap">
        <?php include("header_u.php"); ?>
        <div class="site-section block-3 site-blocks-2 bg-light">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-7 site-section-heading text-center pt-4">
                        <?php
                            echo (mysqli_num_rows($result) > 0) ?'<h2>Produtos relacionados a "'.$_POST['search'].'"</h2>' : '<h2>Sem resultados</h2>';    
                        ?>
                    </div>
                </div>
                <?php if(mysqli_num_rows($result) > 0){?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="nonloop-block-3 owl-carousel">
                            <?php

                            
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo '<div class="item-search">
                                            <div class="block-4 text-center">
                                            <figure class="block-4-image">
                                                <img src="' . $row['pic'] . '" alt="Image placeholder" class="img-fluid">
                                            </figure>
                                            <div class="block-4-text p-4">
                                                <h3><a href="book_page.php?id_book=' . $row['id_book'] . '">' . $row['name'] . '</a></h3>
                                                <p class="mb-0">Leia agora!</p>
                                                <p class="text-primary font-weight-bold">' . $row['price'] . ' €</p>
                                            </div>
                                            </div>
                                        </div>';
                                }
                            ?>
                        </div>
                    </div>
                </div>
                <?php }?>
            </div>
        </div>
        <?php include("footer.php") ?>
</body>

</html>