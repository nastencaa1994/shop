<?php
// читать json файл
$json=file_get_contents('../goods.json');
$json=json_decode($json,true);

//письмо

$email=htmlspecialchars ($_POST["email"]);
$name=htmlspecialchars ($_POST["ename"]);
$ephone=htmlspecialchars ($_POST["ephone"]);
$koment=htmlspecialchars ($_POST["koment"]);

$message='';
$message.='<h1>Заказ в магазине</h1>';
$message.='<p>Телефон: '.$ephone.'</p>';
$message.='<p>Почта: '.$email.'</p>';
$message.='<p>Клиент: '.$name.'</p>';
$message.='<p>Коментарий к заказу: '.$koment.'</p>';
$cart=$_POST['cart'];
$sum=0;
foreach($cart as $id=>$count){
	$message.=$json[$id]['name'].' - '.$count.'. Стоимость: '.$count*$json[$id][cost].'<br/>';
	$sum=$sum+$count*$json[$id][cost];
}
$message.='Итоговая сумма'.$sum;
//print_r($message);
$to='nastencaa1994@gmail.com'.',';
$to.=$email;
$spectext='<DOCTYPE HTML><html><head><title>Заказ</title></head><body>';
$headrs='MIME-Version:1.0'."\r\n";
$headrs.='Content-type:text/html;charset=utf-8'."\r\n";
$subject='заказ в магазине';
$m=mail($to,$subject,$spectext.$message.'</body></html>',$headrs);
if($m)echo 1;
else echo 0;
?>