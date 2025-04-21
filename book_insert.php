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

    $table = 'book';
    $aux = array_keys($_POST);
    $genders = array();
    foreach ($aux as $value)
        if ($x = strstr($value, 'gender_')) {
            $genders[] = substr($x, 7);
            unset($_POST[$value]);
        }
    $authors = array();
    foreach ($aux as $value)
        if ($x = strstr($value, 'author_')) {
            $authors[] = substr($x, 7);
            unset($_POST[$value]);
        }
    $_POST['stat'] = 1;
    $_POST['id_disc'] = 1;
    $id_book = tool_insert($_POST, $table);
    foreach ($genders as $value) {
        $sql = 'INSERT INTO book_gender (id_book, id_gender) values (' . $id_book . ',' . $value . ')';
        $query = mysqli_query($conn, $sql);
    }
    foreach ($authors as $value) {
        $sql = 'INSERT INTO book_author (id_book, id_author) values (' . $id_book . ',' . $value . ')';
        $query = mysqli_query($conn, $sql);
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
                <p><strong class="text-primary h4">Inserir Livro</strong></p>
                    <form name="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" onsubmit="return validation()" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6">
                                <img id="blah" src="" alt="Image" class="img-fluid" width="400px">
                                <input type="file" name="pic" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <label for="name" class="text-black">Nome </label>
                                        <input type="text" class="form-control" name="name" placeholder="" value="<?php if (isset($_POST['name'])) echo $_POST['name'] ?>">
                                        <p id="a"></p>
                                    </div>
                                </div>
                                <label for="name" class="text-black">Autores: </label>
                                <div class="container">
                                    <?php
                                    $sql = "SELECT * FROM author";
                                    $result = mysqli_query($conn, $sql);
                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo '<label>' . $row['name'] . '</label>
                                    <input type="checkbox" id="" name="author_' . $row['id_author'] . '" value="' . $row['id_author'] . '"> ';
                                        }
                                    }
                                    ?>
                                </div>
                                <label for="name" class="text-black">géneros </label>
                                <div class="container">
                                    <?php
                                    $sql = "SELECT * FROM gender";
                                    $result = mysqli_query($conn, $sql);
                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo '<label>' . $row['name'] . '</label>
                                    <input type="checkbox" id="" name="gender_' . $row['id_gender'] . '" value="' . $row['id_gender'] . '"> ';
                                        }
                                    }
                                    ?>
                                </div>
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
                                        <textarea name="sinopse"><?php if (isset($_POST['sinopse'])) echo $_POST['sinopse']; ?></textarea>
                                        <span id="v_sinopse"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <label for="name" class="text-black">Preço: </label>
                                        <input type="number" min="00.00" step="0.01" name="price" <?php echo (isset($book['price']) ? 'value=' . $book['price'] : '') ?>>
                                        <p id="b"></p>
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