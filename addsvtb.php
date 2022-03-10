<?php
/**--chèn dữ liệu vào database*/
require_once('dbhelp.php');
/*code chung kết hợp search và input nên để câu lệnh ra ngoài*/
$s_username = $s_studentcode = $s_classcode = $s_achievement = $s_imgurl ='';
if(!empty($_POST)){
    $s_id='';
    /**kiểm tra xem trong dữ liệu post có username hay ko */
    if(isset($_POST['username'])){
        $s_username = $_POST['username'];
    }
    if(isset($_POST['studentcode'])){
        $s_studentcode = $_POST['studentcode'];
    }
    if(isset($_POST['classcode'])){
        $s_classcode = $_POST['classcode'];
    }
    if(isset($_POST['achievement'])){
        $s_achievement = $_POST['achievement'];
    }
    if(isset($_POST['imgurl'])){
        $s_imgurl = $_POST['imgurl'];
    }
    

    if(isset($_POST['id'])){
        $s_id = $_POST['id'];
    }

    if($s_id != ''){
        //update
        $sql ="update studenttb set username='$s_username', studentcode='$s_studentcode', classcode='$s_classcode', achievement='$s_achievement',imgurl='$s_imgurl' where id= ".$s_id;
    }else{
        //insert
        $sql = "insert into studenttb(username, studentcode, classcode, achievement, imgurl) value('$s_username','$s_studentcode','$s_classcode','$s_achievement','$s_imgurl')";
    }

    

    /*tránh lỗi sql injection*/
    /*sql injection là một kỹ thuật lợi dụng những lỗ hổng về câu truy vấn của các ứng dụng*/
    $s_username = str_replace('\'', '\\\'', $s_username);
    $s_studentcode = str_replace('\'', '\\\'', $s_studentcode);
    $s_classcode = str_replace('\'', '\\\'', $s_classcode);
    $s_achievement = str_replace('\'', '\\\'', $s_achievement);
    $s_imgurl = str_replace('\'', '\\\'', $s_imgurl);
   
    $s_id = str_replace('\'', '\\\'', $s_id);
    /*Để an toàn về mặt dữ liệu
    Ví dụ nhập A','1','HN';delete from student;/* => xóa hết database*/
    execute($sql);

    /*Sau khi ấn lưu dữ liệu vào database và muốn quay về trang chủ */
    header('Location: svtb.php');
    die();
}

$id='';
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = 'select*from studenttb where id = '.$id;
    $studentList = executeResult($sql);
    if($studentList != null && count($studentList)>0){
        $std = $studentList[0];
        $s_username = $std['username'];
        $s_studentcode = $std['studentcode'];
        $s_classcode = $std['classcode'];
        $s_achievement = $std['achievement'];
        $s_imgurl = $std['imgurl'];
        

    }else{
        $id = '';/*phòng trường hợp bị người dùng nhập sai id*/
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
		<form method="post">
			<h1>Thêm sinh viên tiêu biểu</h1>
			<br>
		  <div class="form-row">
		    <div class="form-group col-md-6">
		      <label for="usr">Họ và tên</label>
		      <input type="number" name="id" value="<?=$id?>" style="display:none;"></input>
		      <input required="true" type="text" class="form-control" id="usr" name="username" value="<?=$s_username?>">
		    </div>
		    <div class="form-group col-md-6">
		      
		        <label for="usr">Mã sinh viên</label>
		        
		        <input required="true" type="text" class="form-control" id="usr" name="studentcode" value="<?=$s_studentcode?>">
		    </div>
		  </div>
		  <div class="form-row">
		    
		    <div class="form-group col-md-6">
		      <label for="usr">Mã lớp</label>
		      
		      <input required="true" type="text" class="form-control" id="usr" name="classcode" value="<?=$s_classcode?>">
		    </div>
		    <div class="form-group col-md-6">
		      <label for="achievement">Thành tích</label>
		      
		      <input required="true" type="text" class="form-control" id="achievement" name="achievement" value="<?=$s_achievement?>">
		    </div>
		  </div>
		  <div class="form-row">
		    <div class="form-group col-md-6">
		      <label for="email">imgurl</label>
		      
		      <input required="true" type="text" class="form-control" id="imgurl" name="imgurl" value="<?=$s_imgurl?>">
		    </div>
		    
		  </div>
		  
		  <br>
		  <button type="submit" class="btn btn-primary">Lưu</button>
		</form>
		
	</div>
	
</body>
</html>