<?php 
$connect = mysqli_connect("localhost", "gs", "Rltp2ekd!", "db") or die("db 연결 실패");

$title = $_POST['title'];
$no = $_POST['no'];
$nick = $_POST['nick'];
$pw = $_POST['pw'];
$reply = $_POST['reply'];
$date = date("Y-m-d H:i:s",time());
$time = $_POST['time'];
$commenttime = microtime();
$loginid = $_POST['loginid'];
$isdeleted = '0';
$query = "INSERT INTO baseballreply (id, pw, title, reply, date, time, commenttime, no, loginid, isDeleted) 
                        values ('$nick' , '$pw' , '$title' , '$reply', '$date', '$time', '$commenttime' ,'$no', '$loginid', '$isdeleted')";
$result = $connect -> query($query);
if($result) {
    ?>
    <script>
        alert('댓글이 등록되었습니다.');
        location.replace("baseballpostview.php?no=<?php echo $no?>")
    </script>

<?php   }
else{
    ?> <script>
        alert("댓글 등록을 실패했습니다.");
        location.replace("baseballpostview.php?no=<?php echo $no?>")
    </script>

    <?php
}

mysqli_close($connect);
?>