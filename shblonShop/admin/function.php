<?php
$servername="localhost";
$username="root";
$pasword="03a11a2018a";
$dhname="eshop1";

function connect(){
	$conn=mysqli_connect("localhost","root","","eshop1");
	if(!$conn){
		die("Connection failed: ".mysqli_connect_error());
	}
	return $conn;
}
function init(){
	//вывожу список товаров
	$conn=connect();
	$sql="SELECT id,name FROM goods1";
	$result=mysqli_query($conn,$sql);
	
	if (mysqli_num_rows($result)>0) {
		$out=array();
		while($row=mysqli_fetch_assoc($result)){
			$out[$row["id"]]=$row;
			}
			echo json_encode($out);
	} 
	else {
		echo "0";
		}
		mysqli_close($conn);
}
function selectOneGoods(){
	$conn=connect();
	$id=$_POST['gid'];
	$sql="SELECT*FROM `goods1` WHERE `id`='$id'";
	$result=mysqli_query($conn,$sql);
	
	if(mysqli_num_rows($result)>0){
		$row=mysqli_fetch_assoc($result);
		echo json_encode($row);
	} 
	else{
		echo "0";
		}
		mysqli_close($conn);
}
function delGoods(){
	$conn=connect();
	$id=$_POST['id'];
	$sql = "DELETE FROM goods1 WHERE id='$id'";

if ($conn->query($sql) === TRUE) {
  echo "1";
} else {
  echo "Error";
}
	
	mysqli_close($conn);
	writeJSON();
}
function updateGoods(){
	$conn=connect();
	$id=$_POST['id'];
	$name=$_POST['gname'];
	$cost=$_POST['gcost'];
	$descr=$_POST['gdescr'];
	$img=$_POST['gimg'];
	$ord=$_POST['gorder'];
	
	//INSERT INTO `goods1` (`id`, `name`, `cost`, `description`, `ord`, `img`) VALUES (NULL, 'Пудра', '200', 'Слоновая кость', '9', 'pudra.jpg');
	$sql = "UPDATE goods1 SET name='$name', cost='$cost', description='$descr', ord='$ord', img='$img' WHERE id='$id' ";

if(mysqli_query($conn, $sql)){
  echo "1";
} 
else {
  echo "Error updating record: " . mysqli_error($conn);
}
	
	mysqli_close($conn);
	writeJSON();
}
function newGoods(){
	$conn=connect();
	$name=$_POST['gname'];
	$cost=$_POST['gcost'];
	$descr=$_POST['gdescr'];
	$img=$_POST['gimg'];
	$ord=$_POST['gorder'];
	
	//INSERT INTO `goods1` (`id`, `name`, `cost`, `description`, `ord`, `img`) VALUES (NULL, 'Пудра', '200', 'Слоновая кость', '9', 'pudra.jpg');
	$sql = "INSERT INTO goods1 (name, cost, description, ord, img)
	VALUES ('$name', '$cost', '$descr', '$ord', '$img') ";

if ($conn->query($sql) === TRUE) {
  echo "1";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
	
	mysqli_close($conn);
	 writeJSON();
}
function writeJSON(){
	$conn=connect();
	$sql="SELECT*FROM goods1";
	$result=mysqli_query($conn,$sql);
	
	if (mysqli_num_rows($result)>0) {
		$out=array();
		while($row=mysqli_fetch_assoc($result)){
			$out[$row["id"]]=$row;
			}
		$a=file_put_contents('..\\goods.json',json_encode($out));
	} 
	else {
		echo "0";
		}
		mysqli_close($conn);
		
}
?>
