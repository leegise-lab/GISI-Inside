<?php
$connect = mysqli_connect("localhost", "gs", "Rltp2ekd!", "db") or die("connect fail");
$id = $_POST['id'];
$reply = $_POST['reply'];
$pw = $_POST['pw'];
$no = $_POST['no'];
$time = $_POST['time'];
$ctime = $_POST['commenttime'];

$query = "select * from baseballreply where id = '$id' and reply = '$reply' and time = '$time' and commenttime = '$ctime'";
$result = $connect ->query($query);
$info = mysqli_fetch_assoc($result);
$text = "작성자에 의해 삭제된 댓글입니다.";

if ($info['pw']==$pw) {
    $delete = "delete from baseballreply where reply = '$reply' and time = '$time' and commenttime = '$ctime'";
//    $delete = "update baseballreply set reply = '$text' where no = '$no' and commenttime = '$ctime'";
    $connect ->query($delete);
?>
    <script>
        alert("댓글이 삭제되었습니다.");
        location.replace("baseballpostview.php?no=<?php echo $no?>");
    </script>
<?php
} else {
    ?>
    <script>
        alert("비밀번호가 틀립니다.");
        location.replace("baseballpostview.php?no=<?php echo $no ?>");
        </script>
    <?php
}
?>