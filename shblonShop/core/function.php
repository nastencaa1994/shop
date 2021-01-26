<?php
function connect(){
	$conn=mysqli_connect("localhost","root","03a11a2018a","eshop1");
	if(!$conn){
		die("Connection failed: ".mysqli_connect_error());
	}
	return $conn;
}
function loadGoods(){
	$conn=connect();//подгрузка всей таблици goods
	$sql="SELECT*FROM goods1";
	$result=mysqli_query($conn,$sql);
	if (mysqli_num_rows($result)>0){
		$out=array();
		while($row=mysqli_fetch_assoc($result)){
			$out[$row["id"]]=$row;
			}
		echo (json_encode($out));
	} 
	else{
		echo "0";
		}
		mysqli_close($conn);
}
function showCart(){
	//$id=array();
    $arr=$_POST['id'];
	$id=$arr[0];
	$out=array();
	$conn=connect();
	for($i=0;$i<count($arr);$i++){
		$id=$arr[$i];
		$sql="SELECT*FROM goods1 WHERE id='$id'";
		$result=mysqli_query($conn,$sql);
		if (mysqli_num_rows($result)>0){
		$row=mysqli_fetch_assoc($result);
		$out[$row["id"]]=$row;
	} 
	}
	if(count($out)>0)
	echo (json_encode($out));	
	else{
		 echo ('0');
		}
		
	mysqli_close($conn);
}
function  loadSingl(){
	//подгрузка одного определенного опбьекта
	$id=$_POST['id'];
	$conn=connect();
	$sql="SELECT*FROM goods1 WHERE id='$id'";
	$result=mysqli_query($conn,$sql);
	//$row=array();
	if (mysqli_num_rows($result)>0){
		$row=mysqli_fetch_assoc($result);
		echo (json_encode($row));
	} 
	else{
		echo "0";
		}
	mysqli_close($conn);
}
?>