<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>
<?php
include('connect_bd.php');
include('functions.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $table = 'publisher';
    tool_insert($_POST, $table);
    unset($_SERVER["REQUEST_METHOD"]);
    header('location:publisher_list.php');
}
?>

<body>
    <?php
    include("header.php"); ?>
    <div class="row">
        <div class="col-4">
        <h2>Inserir publisher</h2>
        <form name="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
            <div class="checkout__input">
                <p>Nome</p>
                <input type="text" id="name" name="name" value="<?php echo (isset($_POST['name'])) ? $_POST['name'] : ''; ?>">
            </div>
            <button type="submit">Finalizar</button>
        </form>
        </div>
        <div class="col-8">
            <div class="section-title">
                <h2>publisher</h2>
            </div>
            <div class="row">
                <table class="table" border="1px solid black">
                    <tr>
                        <td>Id</td>
                        <td>Nome</td>
                    </tr>
                    <?php
                    $sql = "SELECT * FROM publisher ORDER BY name";
                    $result = mysqli_query($conn, $sql);
                    $pub = mysqli_fetch_assoc($result);
                    if ($pub > 0) {
                        do {
                            echo '<tr><td>' . $pub['id_pub'] . '</td>
                            <td>' . $pub['name'] . ' ' . '</td>';
                        } while ($pub = mysqli_fetch_assoc($result));
                    } else
                        'sem registros';
                    ?>
                </table>
            </div>
        </div>
    </div>
</body>

</html>