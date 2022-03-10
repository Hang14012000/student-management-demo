<?php
require_once('config.php');
/*them, sua,xoa*/
function execute($sql){
	$conn =mysqli_connect(HOST,USERNAME,PASSWORD,DATABASE);
	//QUERY
	mysqli_query($conn,$sql);

	//DONG CONNECTION
	mysqli_close($conn);
}
//su dung cho lenh select
function executeResult($sql){
   $conn =mysqli_connect(HOST,USERNAME,PASSWORD,DATABASE);
	//QUERY
	$resultset=mysqli_query($conn,$sql);
	$list =[];
	while($row = mysqli_fetch_array($resultset,1)){
		$list[] =$row;
	}
	//DONG CONNECTION
	mysqli_close($conn);
	return $list;
}