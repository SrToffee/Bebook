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
if (isset($_GET['able'])) {
    $value = mysqli_fetch_assoc(mysqli_query($conn, 'SELECT stat from book where id_book =' . $_GET['able']));
    if ($value['stat'])
        $sql = "update book set stat = 0 where id_book=" . $_GET['able'];
    else
        $sql = "update book set stat = 1 where id_book=" . $_GET['able'];
    mysqli_query($conn, $sql);
    header('location:books_list.php');
}
$sql = "SELECT book.*, publisher.name as pub FROM book,publisher where book.id_pub = publisher.id_pub";
$result = mysqli_query($conn, $sql);

?>

<body>

    <div class="wrapper">

        <?php include("aside.php"); ?>

        <div class="main-panel">

            <?php include("header.php"); ?>

            <div class="content">
                <div class="container">
                    <div class="row">
                        <div class="col-3">
                            <p></p>
                        </div>
                        <div class="col-9">
                            <?php if (mysqli_num_rows($result) > 0) { ?>
                                <p>Livros - <button type="button" class="btn btn-secundary" value="" onclick="window.location='book_insert.php'">Inserir um novo livro</button></p>
                                <table class="table">
                                    <thead class="thead bg-primary text-white">
                                        <tr>
                                            <td>Id</td>
                                            <td>Nome</td>
                                            <td>D.publicação</td>
                                            <td>Preço</td>
                                            <td>ISBN</td>
                                            <td>Editora</td>
                                            <td>Estado</td>
                                            <td>Descontinuar/<br>Continuar</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        while ($book = mysqli_fetch_assoc($result)) {
                                            echo '<tr>
                                                    <td><a href="books_list.php?update=' . $book['id_book'] . '">' . $book['id_book'] . '</a></td>
                                                    <td>' . $book['name'] . '</td>
                                                    <td>' . $book['pbl_date'] . '</td>
                                                    <td>' . $book['price'] . '</td>
                                                    <td>' . $book['ISBN'] . '</td>
                                                    <td>' . $book['pub'] . '</td>';
                                            echo ($book['stat']) ? ' <td>Ativo</td>' : ' <td>Descontinuado</td>';
                                            echo    '<td><a href="books_list.php?able=' . $book['id_book'] . '">X</a></td>
                                                </tr>';
                                        }
                                        ?>
                                    </tbody>
                                </table>

                            <?php } else {
                                echo '<p>Sem registros de livros!</p>';
                            } ?>
                        </div>
                    </div>
                    <?php if (isset($_GET['update'])) {
                        $sql = "SELECT book.*, publisher.name as pub FROM book,publisher where book.id_pub = publisher.id_pub and id_book = " . $_GET['update'];
                        $book = mysqli_fetch_assoc(mysqli_query($conn, $sql));
                    ?>
                        <div class="row">
                            <div class="col-md-6">
                                <img src="<?php echo $book['pic'] ?>" alt="Image" class="img-fluid" width="400px">
                            </div>
                            <div class="col-md-6">
                                <h2 class="text-black"><?php echo $book['name'] ?></h2>
                                <?php
                                $sql = "SELECT author.name, author.id_author from author, book_author where author.id_author = book_author.id_author AND book_author.id_book = " . $book['id_book'];
                                $query = mysqli_query($conn, $sql);
                                echo '<p>Autores:';
                                for ($i = 0; $i < mysqli_num_rows($query); $i++) {
                                    $author = mysqli_fetch_assoc($query);
                                    echo '<a href="author_edit.php?id_author=' . $author['id_author'] . '">';
                                    echo ($i + 1 == mysqli_num_rows($query)) ? $author['name'] : $author['name'] . ' - ';
                                    echo '</a>';
                                }
                                echo '</p>';

                                echo '<p>Editora: <a href="publisher_edit.php?id_pub=' . $book['id_pub'] . '">' . $book['pub'] . '</a></p>';
                                ?>
                                <p><strong class="text-primary h7">
                                        <?php
                                        $sql = "SELECT gender.name, gender.id_gender from gender, book_gender where gender.id_gender = book_gender.id_gender AND book_gender.id_book = " . $book['id_book'];
                                        $query = mysqli_query($conn, $sql);
                                        for ($i = 0; $i < mysqli_num_rows($query); $i++) {
                                            $author = mysqli_fetch_assoc($query);
                                            echo '<a href="gender_edit.php?id_gender=' . $author['id_gender'] . '">';
                                            echo ($i + 1 == mysqli_num_rows($query)) ? $author['name'] : $author['name'] . ' - ';
                                            echo '</a>';
                                        }
                                        ?>
                                    </strong>
                                </p>
                                <p><?php echo $book['sinopse'] ?></p>
                                <p><strong class="text-primary h4"><?php echo $book['price'] ?> € </strong></p>
                                <p class="textt-primary h4"><a href="favorite"><span class="icon icon-heart-o"></span></a></p>
                                <input type="hidden" value="<?php echo $book['id_book'] ?>" name="id_book">
                                <a class="btn btn-primary btn-sm" href="book_edit.php?id_book=<?php echo $book['id_book']; ?>">editar</a>
                            </div>
                        </div>
                </div>
            <?php
                    } ?>
            </div>
        </div>

        <?php include("footer.php"); ?>

</body>

</html>