<?php
$connect = mysqli_connect("localhost", "gs", "Rltp2ekd!", "db") or die("connect fail");
$id = $_POST['id'];
$reply = $_POST['reply'];
$pw = $_POST['pw'];
$no = $_POST['no'];
$query = "select * from soccerreply where id = '$id' and reply = '$reply'";
$result = $connect ->query($query);
$info = mysqli_fetch_assoc($result);

if ($info['pw']==$pw) {
    $delete = "delete from soccerreply where id = '$id' and reply = '$reply' and pw = '$pw'";
    $connect ->query($delete);
?>
<script>
    alert("댓글이 삭제되었습니다.");
    location.replace("soccerpostview.php?no=<?php echo $no ?>");
</script>
<?php
} else {
    ?>
    <script>
        alert("비밀번호가 틀립니다.");
        location.replace("soccerpostview.php?no=<?php echo $no ?>");
    </script>
    <?php
}

?>