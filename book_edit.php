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
    $table = "book";
    $condition = "id_book =" . $_GET['id_book'];
    if (tool_update($_POST, $condition, $table))
        header('location:books_list.php');
    else
        header('location: error.php?back=' . $_SERVER["PHP_SELF"]);
}
if (!empty($_GET)) {
    $aux = array_keys($_GET);
    foreach ($aux as $value) {
        switch ($value) {
            case 'id_book':
                $book = mysqli_fetch_assoc(mysqli_query($conn, 'SELECT book.*, publisher.name as pub FROM book,publisher where book.id_pub = publisher.id_pub and id_book = ' . $_GET['id_book']));
                break;
            case 'id_author':
                $sql = ($_GET['connect']) ? "DELETE FROM book_author WHERE book_author.id_author=" . $_GET['id_author'] . ' and book_author.id_book=' . $_GET['id_book']
                    : 'insert into book_author(id_book, id_author) values(' . $_GET['id_book'] . ',' . $_GET['id_author'] . ')';
                mysqli_query($conn, $sql);
                header('location:' . $_SERVER["PHP_SELF"] . '?id_book=' . $_GET['id_book']);
                break;
            case 'id_gender':
                $sql = ($_GET['connect']) ? "DELETE FROM book_gender WHERE book_gender.id_gender=" . $_GET['id_gender'] . ' and book_gender.id_book=' . $_GET['id_book']
                    : 'insert into book_gender(id_book, id_gender) values(' . $_GET['id_book'] . ',' . $_GET['id_gender'] . ')';
                mysqli_query($conn, $sql);
                unset($_GET['connect'], $_GET['id_gender']);
                header('location:' . $_SERVER["PHP_SELF"] . '?id_book=' . $_GET['id_book']);
                break;
            default:
                    header('books_list.php');
        }
    }
}
?>

<body>

    <div class="wrapper">

        <?php include("aside.php"); ?>

        <div class="main-panel">

            <?php include("header.php"); ?>

            <div class="content">
                <div class="container">
                    <form name="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id_book=' . $_GET['id_book']; ?>" onsubmit="return validation()" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6">
                                <img id="blah" src="<?php echo $book['pic'] ?>" alt="Image" class="img-fluid" width="400px">
                                <input type="file" name="pic" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <label for="name" class="text-black">Nome </label>
                                        <input type="text" class="form-control" name="name" placeholder="" value="<?php echo $book['name'] ?>">
                                        <span id="v_name"></span>
                                    </div>
                                </div>
                                <label for="name" class="text-black">Autores: </label>
                                <table class="table">
                                    <thead class="">
                                        <tr>
                                            <td>Id</td>
                                            <td>Nome</td>
                                            <td>Associar/<br>desassociar</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql = "select * from author";
                                        $result = mysqli_query($conn, $sql);
                                        while ($author = mysqli_fetch_assoc($result)) {
                                            echo '<tr>
                                            <td><a href="author_edit.php?id_author=' . $author['id_author'] . '">' . $author['id_author'] . '</a></td>
                                            <td>' . $author['name'] . '</td>';
                                            $sql = "select * from book_author where book_author.id_book =" . $book['id_book'] . ' and book_author.id_author =' . $author['id_author'];
                                            $query = mysqli_query($conn, $sql);
                                            echo '<td><a href="' . $_SERVER["PHP_SELF"] . '?id_author=' . $author['id_author'] . '&&connect=' . mysqli_num_rows($query) . '&&id_book=' . $_GET['id_book'] . '">';
                                            echo (mysqli_num_rows($query)) ? 'Associado' : 'desassociado';
                                            echo    '</a></td>
                                        </tr>';
                                        }
                                        ?>
                                    </tbody>
                                </table>
                                <label for="name" class="text-black">géneros </label>
                                <table class="table">
                                    <thead class="">
                                        <tr>
                                            <td>Id</td>
                                            <td>Nome</td>
                                            <td>Associar/<br>desassociar</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql = "select * from gender";
                                        $result = mysqli_query($conn, $sql);
                                        while ($gender = mysqli_fetch_assoc($result)) {
                                            echo '<tr>
                                            <td><a href="gender_edit.php?id_gender=' . $gender['id_gender'] . '">' . $gender['id_gender'] . '</a></td>
                                            <td>' . $gender['name'] . '</td>';
                                            $sql = "select * from book_gender where book_gender.id_book =" . $book['id_book'] . ' and book_gender.id_gender =' . $gender['id_gender'];
                                            $query = mysqli_query($conn, $sql);
                                            echo '<td><a href="' . $_SERVER["PHP_SELF"] . '?id_gender=' . $gender['id_gender'] . '&&connect=' . mysqli_num_rows($query) . '&&id_book=' . $_GET['id_book'] . '">';
                                            echo (mysqli_num_rows($query)) ? 'Associado' : 'desassociado';
                                            echo    '</a></td>
                                        </tr>';
                                        }
                                        ?>
                                    </tbody>
                                </table>
                                <select name="id_pub">
                                    <?php
                                    $sql = "SELECT name, id_pub FROM publisher";
                                    $result = mysqli_query($conn, $sql);
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo ((isset($book['id_book'])) && $row['id_pub'] == isset($book['id_pub'])) ?
                                            "<option value='" . $row['id_pub'] . "' selected>" : "<option value ='" . $row['id_pub'] . "'>";
                                        echo $row['name'] . "</option>";
                                    }
                                    ?>
                                </select>
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <label for="name" class="text-black">Sinopse: </label><br>
                                        <textarea name="sinopse"><?php echo $book['sinopse'] ?></textarea>
                                        <span id="v_sinopse"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <label for="name" class="text-black">Preço: </label>
                                        <input type="number" min="00.00" step="0.01" name="price" <?php echo (isset($book['price']) ? 'value=' . $book['price'] : '') ?>>
                                        <span id="v_preco"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <label for="name" class="text-black">ISBN: </label>
                                        <input type="text" name="ISBN" <?php echo (isset($book['ISBN']) ? 'value="' . $book['ISBN'] . '"' : 'placeholder="123456789"') ?>>
                                        <span id="v_name"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <label for="name" class="text-black">Data de publicação: </label>
                                        <input type="date" name="pbl_date" value="<?php echo (isset($book['pbl_date']) ? 'value=' . $book['pbl_date'] : '') ?>">
                                        <span id="v_name"></span>
                                    </div>
                                </div>
                                <input type="submit" class="btn btn-primary btn-lg btn-block" value="Atualizar">
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

                x = document.getElementsByName("price")[0].value;
                if (x == "") {
                    document.getElementById('b').innerHTML = "O preço não pode estar vazio!";
                    return false;
                } else
                    document.getElementById('b').innerHTML = "";

            }
        </script>
        <?php include("footer.php"); ?>

</body>

</html>