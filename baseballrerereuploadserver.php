<?php

$connect = mysqli_connect("localhost", "gs", "Rltp2ekd!", "db") or die("db 연결 실패");


$no = $_POST['no'];
$nick = $_POST['nick'];
$pw = $_POST['pw'];
$reply = $_POST['rereply'];
$replyno = $_POST['replyno'];
$commenttime = $_POST['commenttime'];
$date = date("Y-m-d H:i:s",time());

$query = "INSERT INTO baseballrereply (id, pw, reply, date, no, replyno, commenttime) 
values ('$nick' , '$pw' , '$reply', '$date','$no', '$replyno', '$commenttime')";
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
        location.replace("baseballpostview.php?no=<?php echo $replyno?>")
    </script>

    <?php
}

mysqli_close($connect);
?>