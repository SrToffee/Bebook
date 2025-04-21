<!DOCTYPE html>
<html lang="en">

<head>

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
?>

<body>

    <div class="site-wrap">
        <?php include("header_u.php"); ?>

        <div class="bg-light py-3">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 mb-0"><a href="index.php">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Biblioteca</strong></div>
                </div>
            </div>
        </div>
        <div class="site-section">
            <div class="container">

                <div class="row mb-5">
                    <div class="col-md-9 order-2">

                        <div class="row">
                            <div class="col-md-12 mb-5">
                                <div class="d-flex">
                                    <div class="dropdown mr-1 ml-md-auto">
                                        <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" id="dropdownMenuOffset" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            géneros
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuOffset">
                                            <?php
                                            $sql = "SELECT * FROM gender";
                                            $result = mysqli_query($conn, $sql);
                                            if (mysqli_num_rows($result) > 0)
                                                while ($row = mysqli_fetch_assoc($result))
                                                    echo '<a class="dropdown-item" href="#">' . $row['name'] . '</a>';
                                            ?>
                                        </div>
                                    </div>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" id="dropdownMenuReference" data-toggle="dropdown">Reference</button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuReference">
                                            <a class="dropdown-item" href="#">Relevancia</a>
                                            <a class="dropdown-item" href="#">Nome, A -> Z</a>
                                            <a class="dropdown-item" href="#">Nome, Z -> A</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Qtd livros -> alto</a>
                                            <a class="dropdown-item" href="#">Qtd livros -> baixo</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5">

                            <?php
                            $sql = "SELECT  author.* from author;";
                            $result = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($result)) {
                                while ($row = mysqli_fetch_assoc($result))
                                    echo '<div class="col-sm-6 col-lg-4 mb-4" data-aos="fade-up">
                                    <div class="block-4 text-center border">
                                        <figure class="block-4-image">
                                            <a href="book_page.php?id_book=' . $row['id_author'] . '"><img src="' . $row['pic'] . '" alt="Image placeholder" class="img-fluid"></a>
                                        </figure>
                                        <div class="block-4-text p-4">
                                            <h3><a href="author_page.php?id_author=' . $row['id_author'] . '">' . $row['name'] . '</a></h3>
                                        </div>
                                    </div>
                                </div>';
                            }
                            ?>
                        </div>

                    </div>

                    <div class="col-md-3 order-1 mb-5 mb-md-0">
                        <div class="border p-4 rounded mb-4">
                            <h3 class="mb-3 h6 text-uppercase text-black d-block">Editoras relacionadas</h3>
                            <ul class="list-unstyled mb-0">
                                <?php
                                $sql = "SELECT * FROM publisher";
                                $result = mysqli_query($conn, $sql);
                                if (mysqli_num_rows($result) > 0)
                                    while ($row = mysqli_fetch_assoc($result))
                                        echo '<li class="mb-1"><a href="#" class="d-flex"><span>' . $row['name'] . '</span></a></li>';
                                ?>
                            </ul>
                        </div>



                    </div>
                </div>
            </div>



        </div>
    </div>
    <?php include("footer.php") ?>

</body>

</html>