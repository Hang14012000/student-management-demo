<?php

// Kết nối CSDL
$conn = mysqli_connect ('localhost', 'root', '', 'qlsv') or die ('Không thể kết nối tới database');
mysqli_set_charset($conn, 'UTF8');

// Khởi tạo SESSION
session_start();
if (isset($_SESSION['user'])){
unset($_SESSION['user']);
}

// Dùng Isset kiẻm tra
if (isset($_POST['login'])) {

$email = addslashes($_POST['email']);
$password = addslashes($_POST['password']);

if (!$email || !$password) {
echo "Nhập đầy đủ thông tin <a href='javascript: history.go(-1)'>Trở lại</a>";
exit;
}


//Kiểm tra tên đăng nhập có tồn tại không
$query = "SELECT email, password FROM users WHERE email='$email'";

$result = mysqli_query($conn, $query) or die( mysqli_error($conn));

$row = mysqli_fetch_array($result);

//So sánh 2 mật khẩu có trùng khớp hay không
if ($password != $row['password']) {
echo "Mật khẩu không đúng. Vui lòng nhập lại. <a href='javascript: history.go(-1)'>Trở lại</a>";
exit;
}

//Lưu tên đăng nhập
$_SESSION['user'] = $email;
//if(mysqli_num_rows($user) > 0){
        if($email== "admin@gmail.com") {
            $_SESSION["access"] = "admin";
            header('location: liststudent.php');
        }else {
            $_SESSION["access"] = "user";
            header('location: index.php');
        }
        exit;
//    }

die();
$connect->close();
}

?>
<!DOCTYPE html>
<html lang="vi">
<head>
	<meta charset="utf-8">
	<title>	Đăng nhập</title>
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
		<form method="POST" role="form">
			<h1>Đăng nhập</h1>
			<br>
		  
		  <div>
		    <div class="form-group ">
		      <label for="email">Tài khoản</label>
		      <input type="text" class="form-control" name="email" placeholder="email">

		    </div>
		    <div class="form-group ">
		      <label for="pwd">Mật khẩu</label>
		      <input type="password" class="form-control" name="password" placeholder="Nhập mật khẩu..." required>
		    </div>
		  </div>
		  
		  
		  <br>
		  <button type="submit" name="login" class="btn btn-primary">Đăng nhập</button>
		  <button type="submit" class="btn btn-danger"><a href="index.php"></a> Quay lại trang chủ</button>
		</form>
		
	</div>
</body>
</html>