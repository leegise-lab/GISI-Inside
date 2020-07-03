<?php
$connect = mysqli_connect("localhost", "gs", "Rltp2ekd!", "db") or die("connect fail");
$id = $_POST['id'];
$reply = $_POST['reply'];
$pw = $_POST['pw'];
$no = $_POST['no'];


$delete = "select * from baseballrereply where id = '$id' and reply = '$reply' and no = '$no'";
$result = $connect -> query($delete);

$info = mysqli_fetch_assoc($result);

if ($info['pw']==$pw) {
    $delete = "delete from baseballrereply where id = '$id' and reply = '$reply' and no = '$no' and pw = '$pw'";
    $connect ->query($delete);
    ?>
    <script>
        alert("댓글이 삭제되었습니다.");
        location.replace("baseballpostview.php?no=<?php echo $no ?>");
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