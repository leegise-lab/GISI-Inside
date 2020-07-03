<?php

$connect = mysqli_connect("localhost", "gs", "Rltp2ekd!", "db") or die("db 연결 실패");

$title = $_POST['title'];
$no = $_POST['no'];
$nick = $_POST['nick'];
$pw = $_POST['pw'];
$reply = $_POST['reply'];
$date = date("Y-m-d H:i:s",time());

$query = "INSERT INTO soccerreply (id, pw, title, reply, date, no) values ('$nick' , '$pw' , '$title' , '$reply', '$date','$no')";
$result = $connect -> query($query);
if($result) {
    ?>
    <script>
        alert('댓글이 등록되었습니다.');
        location.replace("soccerpostview.php?no=<?php echo $no?>")
    </script>

<?php   }
else{
    ?> <script>
        alert("댓글 등록을 실패했습니다.");
        location.replace("soccerpostview.php?no=<?php echo $no?>")
    </script>

    <?php
}

mysqli_close($connect);
?>