<?php
include('connect_bd.php');
include('functions.php');

if (isset($_SESSION['id_user'])) {
    if (isset($_SESSION['cart'])) {
        $books = array_keys($_SESSION['cart']);
        $order = array();
        foreach ($books as $id) {
            $sql = 'SELECT price from book where id_book =' . $id;
            if ($query = mysqli_query($conn, $sql)) {
                $value = mysqli_fetch_assoc($query);
                $item = array();
                $item['price'] = $value['price'];
                $item['id_book'] = $id;
                $order[] = $item;
            } else
                $invalid = 1;
        }
        if (!isset($invalid)) {
            $id_user = $_SESSION['id_user'];
            $total = $_SESSION['cart_t'];
            $sql = 'INSERT INTO orders(o_date, id_user, total)
                    values ("' . date("Y-m-d") . '", ' . $id_user . ', ' . $total . ')';
            $result = mysqli_query($conn, $sql);
            if ($id_order = mysqli_insert_id($conn)) {
                foreach ($order as $item) {
                    $sql = 'INSERT INTO order_d (id_order, id_book, price)
                    values(' . $id_order . ', ' . $item['id_book'] . ', ' . $item['price'] . ')';
                    $query = mysqli_query($conn, $sql);
                    $sql = "INSERT INTO book_user (id_user, id_book) values(" . $id_user . ", " . $item['id_book'] . ")";
                    $query = mysqli_query($conn, $sql);
                }
            }
            unset($_SESSION['cart']);
            header('location:order_pdf.php?id_order=' . $id_order);
        } else {
            unset($_SESSION['cart'], $_SESSION['cart_t']);
            header('location:index.php');
        }
    }
} else
    header('location: login.php');
