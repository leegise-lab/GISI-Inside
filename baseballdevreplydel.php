<?php
$connect = mysqli_connect("localhost", "gs", "Rltp2ekd!", "db") or die("connect fail");
$id = $_POST['id'];
$reply = $_POST['reply'];
$no = $_POST['no'];
$ctime = $_POST['commenttime'];
$time = $_POST['time'];
$text = "관리자에 의해 삭제된 댓글입니다.";

$delete = "update baseballreply set reply = '$text' where id = '$id' and reply = '$reply' 
                                            and time = '$time' and commenttime = '$ctime'";
$result = $connect ->query($delete);
if ($result) {
    ?>
    <script>
        alert("관리자 권한으로 댓글이 삭제되었습니다.");
        location.replace("baseballpostview.php?no=<?php echo $no ?>");
    </script>
<?php } else {?>
    <script>
    alert("오류 발생으로 댓글이 삭제되지 않았습니다.");
    location.replace("baseballpostview.php?no=<?php echo $no ?>");
    </script>
<?php }
mysqli_close($connect);
?>