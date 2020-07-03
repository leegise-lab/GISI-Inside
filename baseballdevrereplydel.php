<?php
$connect = mysqli_connect("localhost", "gs", "Rltp2ekd!", "db") or die("connect fail");
$id = $_POST['id'];
$reply = $_POST['reply'];
$no = $_POST['no'];
$text = "관리자에 의해 삭제된 댓글입니다.";

$delete = "update baseballrereply set reply = '$text' where id = '$id' and reply = '$reply' and no = '$no'";
$connect ->query($delete);

    ?>
    <script>
        alert("관리자 권한으로 댓글이 삭제되었습니다.");
        location.replace("baseballpostview.php?no=<?php echo $no ?>");
    </script>
<?php
mysqli_close($connect);
?>