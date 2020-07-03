<!DOCTYPE html>
<html>
<head>

<?php
$connect = mysqli_connect("localhost", "gs", "Rltp2ekd!", "db") or die("db 연결 실패");

$id=$_POST["id"];
$pw=$_POST["pw"];
$no = $_POST['no'];
$contents =$_POST['content'];
$date = $_POST['date'];
$title = $_POST['title'];


$query = "select * from lol where no = '$no'";

$result = $connect ->query($query);
$info = mysqli_fetch_assoc($result);

mysqli_query($connect,"update lol set title = '$title', contents = '$contents', id='$id', pw='$pw' where no = '$no'");

//저장이 됐다면 (result = true) 가입 완료
mysqli_close($connect);
    ?>
    <script>
        alert('게시글 수정이 완료되었습니다.');
        location.replace("lolpostview.php?no=<?php echo $no?>");
    </script>

</head>
</html>

