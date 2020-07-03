<?php session_start();

$connect = mysqli_connect("localhost", "gs", "Rltp2ekd!", "db") or die;

$id = $_POST['id'];
$pw = $_POST['pw'];
$title = $_POST['title'];
$contents = $_POST['content'];
$good=0;
$bad=0;
$view = 0;
$date = date("Y-m-d H:i:s",time());
$time =microtime();
$ip = $_SERVER['REMOTE_ADDR'];
$video = $_POST['video'];
$loginid = $_SESSION['id'];
$sql = "insert into baseball (id, pw, title, contents, good, bad, view, date, time, ip, video, loginid) values 
                                ('$id', '$pw', '$title', '$contents', '$good', '$bad', '$view', '$date', '$time', '$ip', '$video', '$loginid')";
$result = $connect -> query($sql);

if ($result) {
    ?>
    <script>
        alert("게시글 등록이 완료되었습니다.");
        location.replace('baseball.php');
    </script>
    <?php
}
 else {
     ?>
<script>
    alert("게시글 등록이 실패하였습니다.");
    location.replace("baseball.php");
</script>
<?php
 }
 mysqli_close($connect);
?>
