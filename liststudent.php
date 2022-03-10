<?php
require_once('dbhelp.php');
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
	<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
	  <a class="navbar-brand" href="#"><h3> QUẢN LÝ SINH VIÊN</h3></a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" >
	    <span class="navbar-toggler-icon"></span>
	  </button>

	  <div class="collapse navbar-collapse" id="navbarSupportedContent">
	    <ul class="navbar-nav mr-auto">
	      <li class="nav-item active">
	        <!-- <a class="nav-link" href="quanly.html">TRANG CHỦ <span class="sr-only">(current)</span></a> -->
	      </li> 
	      <li class="nav-item">
	        <a class="nav-link" href="trangchu.php">TRANG CHỦ</a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="svtb.php">SINH VIÊN TIÊU BIỂU</a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="thongke.php">THỐNG KÊ</a>
	      </li>
	      
	      <li class="nav-item">
	        <a class="nav-link" href="notification.html">THÔNG BÁO</a>
	      </li>
	    </ul>
	    
	  </div>
	</nav> 
	<br><br>
	
		<div class="container" style="margin-top: 50px" id="list">
			<br>
			<h2>Danh sách sinh viên</h2>
			<br>
			<nav class="navbar navbar-light bg-light justify-content-between">
			  <a class="navbar-brand" href="input.php">
			  	<form class="container-fluid justify-content-start" >
			  		<button class="btn btn-primary my-2 my-sm-0" type="button">Thêm sinh viên</button>
			  		<!-- <button class="btn btn-primary my-2 my-sm-0" type="button" onclick="window.open('input.php','_self')">Thêm sinh viên</button> -->
			  	</form>
			  </a>
			  <form class="form-inline" method="get">
			    <input class="form-control mr-sm-2" placeholder="Tên sinh viên" aria-label="Search" type="text" name="s" class="form-control">
			    <button class="btn btn-success" type="submit">Tìm kiếm</button>
			  </form>
			</nav>
			<table class="table table-striped table-hover">
			  <thead>
			    <tr>
			      <th scope="col">STT</th>
			      <th scope="col">Họ và tên</th>
			      <th scope="col">Mã sinh viên</th>
			      <th scope="col">Mã lớp</th>
			      <th scope="col">GPA</th>
			      <th scope="col">Email</th>
			      <th scope="col">Địa chỉ</th>
			      <th scope="col" width="60px"></th>
			      <th scope="col" width="60px"></th>
			    </tr>
			  </thead>
			  <tbody>
			  	<?php
			  	/*tìm kiếm theo tên*/
			  	if(isset($_GET['s']) && $_GET['s']!=''){
			  	    $sql        =  'select*from student where fullname like "%'.$_GET['s'].'%"';
			  	}
			  	else{
			  	    $sql        =  'select * from student';
			  	}

			  	 
			  	 $studentlist=executeResult($sql);
			  	 $index = 1;
			  	 foreach ($studentlist as $std) {
			  	 	echo '<tr>
			  		         <td>'.($index++).'</td>
			  		         <td>'.$std['fullname'].'</td>
			  		         <td>'.$std['studentcode'].'</td>
			  		         <td>'.$std['classcode'].'</td>
			  		         <td>'.$std['mark'].'</td>
			  		         <td>'.$std['email'].'</td>
			  		         <td>'.$std['address'].'</td>
			  		         <td><button class="btn btn-primary" onclick=\'window.open("input.php?id='.$std['id'].'","_self")\'>Sửa</button></td>
			  		         <td><button class="btn btn-danger" onclick="deleteStudent('.$std['id'].')">Xóa</button></td>
			  	           </tr>';
			  	 }
			  	?>
			  	
			    
			  </tbody>
			</table>
			
		</div>
		<script type="text/javascript">
            function deleteStudent(id) {
            	option = confirm('Bạn muốn xóa sinh viên này không?')
            		if(!option){
            			return;
            		}
            	
                console.log(id)
                $.post('delete_student.php', {
                    'id': id
                }, function(data) {
                    alert(data)
                    location.reload()
                })
            }
        </script>
</body>
</html>