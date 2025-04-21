<?php
include('connect_bd.php');
include('functions.php');
if (isset($_GET['delete'])) {
    unset($_GET['delete']);
    $keys = array_keys($_GET);
    $table = $_GET['table'];
    $sql = "DELETE FROM " . $table . " WHERE " . $keys[0] . "=" . $_GET[$keys[0]];
} else {
    $keys = array_keys($_GET);
    $table = $_GET['table'];
    $sql = "UPDATE ".$_GET['table']." SET stats = 0 WHERE = id_book =".$_GET['id_book'];
}
$result = mysqli_query($conn, $sql);
    if ($result)
        header('location:' . $_GET['back']);
