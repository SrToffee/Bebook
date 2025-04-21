<?php
include('connect_bd.php');
include('functions.php');
if (isset($_SESSION['id_user'])) {
  $sql = "SELECT u_type from users where id_user = " . $_SESSION['id_user'];
  $query = mysqli_query($conn, $sql);
  $type = mysqli_fetch_assoc($query);
  if ($type['u_type'] == 1) {
    $sql = "SELECT id_order from  orders where id_user = " . $_SESSION['id_user'].' && id_order ='.$_GET['id_order'];
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) == 0)
      header('location:user.php');
  }
} else
  header('location:login.php');

use Dompdf\Dompdf;
use Dompdf\options;

require_once 'dompdf/autoload.inc.php';
$pdf = new DOMPDF();


$html = '
<style>
table{
  width:100%;
}
th {
  background-color: grey;
  color: white;
}
td{
  text-align: center;
}
th, td {
  padding: 15px;
}
tbody, tfoot{
  border-bottom: 1px solid #ddd;
}
</style>
<div>
  <h3>Bebook</<h3>
</div>
<div class="overflw-x: auto">
<table class="table" >
  <thead>
      <tr>
        <th scope="col">Produto</th>
        <th scope="col">Preço Un</th>
        <th >SubTotal</th>
      </tr>
  </thead>
  <tbody>';
$id_order = $_GET['id_order'];
$sql = "SELECT order_d.* from orders, order_d WHERE orders.id_order = order_d.id_order && orders.id_order =" . $id_order;
$query = mysqli_query($conn, $sql);



while ($order = mysqli_fetch_assoc($query)) {
  $sql = "SELECT * FROM book WHERE  id_book=" . $order['id_book'];

  $result = mysqli_query($conn, $sql);
  $item = mysqli_fetch_assoc($result);
  $html = $html . '
                    <tr>
                    <td>' . $item['name'] . '</td>
                    <td>' . $item['price'] . ' €</td>
                    <td>' . $item['price'] . ' €</td>
                    </tr>';
}


$html .= '</tbody>';

$html .= '
</table></div>
';
$options = new Options();
$options->set('isRemoteEnabled', true);
$pdf = new DOMPDF($options);

$pdf->load_html($html);
$pdf->render();
$pdf->stream(
  "Fatura_bebook_" . $id_order . ".pdf",
  array(
    "Attachment" => false
  )
);
echo $html;
?>
<html>