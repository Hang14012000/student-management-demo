<?php
if(isset($_POST['id'])){
    $id=$_POST['id'];

    require_once('dbhelp.php');
    $sql = 'delete from studenttb where id = '.$id;
    execute($sql);
    echo 'Xóa sinh viên thành công';
}