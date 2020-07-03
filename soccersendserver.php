<?php

$servername = "localhost";
$username = "gs";
$password = "Rltp2ekd!";
$dbname = "db";

$connect = mysqli_connect($servername, $username, $password, $dbname);
if (!$connect) {
    die("mysql 연결에 실패했습니다.");
}

$ip = $_SERVER['REMOTE_ADDR'];

$title=$_POST['title'];
$contents=$_POST['content'];
$id=$_POST['id'];
$pw=$_POST['pw'];
$good=0;
$bad=0;
$view = 0;
$date = date("Y-m-d H:i:s",time());

//입력받은 데이터를 DB에 저장
$sql = "INSERT INTO soccer (title, contents, id, pw, good, bad, view, date, ip) values ('$title' , '$contents' , '$id' , '$pw' , '$good' , '$bad' , '$view', '$date', '$ip' )";


$result = $connect -> query($sql);

//저장이 됐다면 (result = true) 가입 완료
if($result) {
    ?>
    <script>
        alert('게시글 등록이 완료되었습니다.');
        location.replace("soccer.php");
    </script>

<?php   }
else{
    ?> <script>
        alert("게시글 등록이 실패하였습니다.");
        location.replace("soccer.php")
    </script>

    <?php
}

mysqli_close($connect);
?>
