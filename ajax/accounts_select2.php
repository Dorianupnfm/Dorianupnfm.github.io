<?php
include "../config/config.php";

$search = strip_tags(trim($_GET['q'])); 

$query = mysqli_query($con, "SELECT CONCAT(name, ' - Saldo disponible de: ', balance)  As Nombre, id, name, balance  FROM accounts WHERE  name LIKE '%$search%' LIMIT 40");

$list = array();
while ($list=mysqli_fetch_array($query)){
	$data[] = array('id' => $list['id'], 'text' => $list['Nombre'], 'balance'=> $list['balance']);
}
// devuelve el resultado en doc jason
echo json_encode($data);

?>