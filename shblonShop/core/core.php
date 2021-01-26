<?php 
$action=$_POST['action'];
require_once 'function.php';

switch ($action) {
    case 'loadGoods':
        loadGoods();
        break;
	case 'loadSingl':
        loadSingl();
		break;
	case 'showCart':
        showCart();
		break;
}
?>