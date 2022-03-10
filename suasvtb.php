<?php
// Kết nối CSDL
$conn = mysqli_connect ('localhost', 'root', '', 'qlsv') or die ('Không thể kết nối tới database');
mysqli_set_charset($conn, 'UTF8');
if($_SERVER['REQUEST_METHOD']=='GET'){
	if (isset($_GET['id']) && !empty(trim($_GET['id']))) {
		$idNhan =trim($_GET['id']);
		$queryXemsvtbTheoId = "SELECT * FROM studenttb WHERE id = $idNhan";
		$runquery =mysqli_query($conn,$queryXemsvtbTheoId);
		$countrow =mysqli_num_rows($runquery);
		if($countrow){
			$studenttb =mysqli_fetch_array($runquery);
		}
	}
}
if ($_SERVER['REQUEST_METHOD']=='POST') {
	$idsvpost = trim($_POST['id']);
	if($_POST['imgurl']===''){
		$queryUpdatesv = "UPDATE studenttb SET username = '$_POST[username]', achievement = '$_POST[achievement]' WHERE id='$idsvpost'";
	}else{
		$queryUpdatesv = "UPDATE studenttb SET username = '$_POST[username]', achievement = '$_POST[achievement]',imgurl= '$_POST[imgurl]' WHERE id='$idsvpost'";
	}
	
	if(mysqli_query($conn,$queryUpdatesv)){
		header('Location: svtb.php');
	    die;
	}
	else{
		echo "Lỗi";
	}	

}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
	<meta charset="utf-8">
	<title>	QUẢN LÝ SINH VIÊN</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
	<style type="text/css">
		.nav-link{
			color: #fff !important;
		}
	</style>
</head>
<body>
	<br><br>
	<div class="container">
		<h2 class="display-4 mb-5">Sửa thông tin sinh viên tiêu biểu</h2>
		<form action="suasvtb.php" method="post">
			<div class="form-group">
				<input type="text" class="form-control" name="id" id="id" hidden value="<?php echo trim($studenttb["id"]) ?>">
			</div>
			<div class="form-group">
				<label for="username">Họ và tên</label>
				<input type="text" class="form-control" name="username" id="username"  value="<?php echo trim($studenttb["username"]) ?>">
			</div>
			<div class="form-group">
				<label for="studentcode">Mã sinh viên</label>
				<input type="text" class="form-control" name="studentcode" id="studentcode"  value="<?php echo trim($studenttb["studentcode"]) ?>">
			</div>
			<div class="form-group">
				<label for="classcode">Mã lớp</label>
				<input type="text" class="form-control" name="classcode" id="classcode" value="<?php echo trim($studenttb["classcode"]) ?>">
			</div>
			<div class="form-group">
				<label for="achievement">Thành tích</label>
				<input type="text" class="form-control" name="achievement" id="achievement"  value="<?php echo trim($studenttb["achievement"]) ?>">
			</div>
			<div class="form-group">
				<label for="imgurl">imgURL</label>
				<input type="file" class="form-control" name="imgurl" id="imgurl"  value="<?php echo trim($studenttb["imgurl"]) ?>">
			</div>
			<button type="submit" class=" btn btn-success">Lưu</button>
			<a href="svtb.php" class="btn btn-danger">Quay lại</a>
		</form>
	</div>
</body>
</html>
