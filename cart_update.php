<?php
include('connect_bd.php');
include('functions.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!(isset($_SESSION['cart'])))
        $_SESSION['cart'] = array();
    if (!isset($_SESSION['cart'][$_POST['id_book']]))
        $_SESSION['cart'][$_POST['id_book']] = 1;
    if (count($_SESSION['cart']) > 1) {
        $aux = array_keys($_SESSION['cart']);
        $cheap =  $value['exp'] = mysqli_fetch_assoc(mysqli_query($conn, "select max(price) as exp from book"));
        foreach ($aux as $id) {
            $sql = "select * from book where id_book =" . $id;
            $price = mysqli_fetch_assoc(mysqli_query($conn, $sql));
            if ($cheap >= $price['price'])
                $_SESSION['cheap'] = $id;
        }
    }else
    if(isset($_SESSION['cheap']))
      unset($_SESSION['cheap']);
    header('location:cart.php');
}
