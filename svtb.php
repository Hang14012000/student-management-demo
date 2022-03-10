<?php
// Kết nối CSDL
$conn = mysqli_connect ('localhost', 'root', '', 'qlsv') or die ('Không thể kết nối tới database');
mysqli_set_charset($conn, 'UTF8');

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
	      <li class="nav-item">
	        <a class="nav-link" href="trangchu.php">TRANG CHỦ</a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="listStudent.php">DANH SÁCH SINH VIÊN</a>
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
			<h2>Sinh viên tiêu biểu</h2>
			<br>
			<nav class="navbar navbar-light bg-light justify-content-between">
			  <a class="navbar-brand" href="addsvtb.php">
			  	<form class="container-fluid justify-content-start" >
			  		<button class="btn btn-primary my-2 my-sm-0" type="button">Thêm sinh viên </button>
			  		
			  	</form>
			  </a>
			  <form class="form-inline" method="get">
			    <input class="form-control mr-sm-2" placeholder="MSV/Tên sinh viên" aria-label="Search" type="text" name="s" class="form-control">
			    
			  </form>
			</nav>
			
			<div id ="studenttb">
				<?php
				  $laytatcasv= "SELECT * FROM studenttb";
				  if($resultsvtb= mysqli_query($conn,$laytatcasv)){
				  	if (mysqli_num_rows($resultsvtb)>0) {
				  		echo '<table class= "table table-striped">';
				  		echo "<thead>";
				  		echo '<tr>';
				  		echo '<th scope ="col">STT</th>';
				  		echo '<th scope ="col">Họ và tên</th>';
				  		echo '<th scope ="col">Mã sinh viên</th>';
				  		echo '<th scope ="col">Mã lớp</th>';
				  		echo '<th scope ="col">Thành tích</th>';
				  		echo '<th scope ="col">imgUrl</th>';
				  		echo '<th scope ="col"></th>';
				  		echo '</tr>';
				  		echo '</thead>';
				  		echo '<tbody>';
				  		while($studenttb = mysqli_fetch_array($resultsvtb)){
				  			echo '<tr>';
				  			echo "<td>".$studenttb['id']."</td>";
				  			echo "<td>".$studenttb['username']."</td>";
				  			echo "<td>".$studenttb['studentcode']."</td>";
				  			echo "<td>".$studenttb['classcode']."</td>";
				  			echo "<td>".$studenttb['achievement']."</td>";
				  			echo "<td>".$studenttb['imgurl']."</td>";
				  			echo '<td>
				  			        <a href ="suasvtb.php?id='.$studenttb['id'].'" class="pr-2" title="suasvtb"><button class="btn btn-primary">Sửa</button></a>
				  			        <button class="btn btn-danger" onclick="deleteStudent('.$studenttb['id'].')">Xóa</button>
				  			      </td>';
				  			 echo '<tr>';     
				  		}
				  		echo '</tbody>';
				  		echo '</table>';
				  		mysqli_free_result($resultsvtb);
				  	}else{
				  		echo "<p>Không có sinh viên tiêu biểu nào</p>";
				  	}
				  }else{
				  	echo "Lỗi:". mysqli_connect_errno($conn);
				  }
				?>
			</div>
		</div>
				<script type="text/javascript">
		            function deleteStudent(id) {
		            	option = confirm('Bạn muốn xóa sinh viên này không?')
		            		if(!option){
		            			return;
		            		}
		            	
		                console.log(id)
		                $.post('delete_studenttb.php', {
		                    'id': id
		                }, function(data) {
		                    alert(data)
		                    location.reload()
		                })
		            }
		        </script>
		
</body>
</html>