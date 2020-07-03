<!DOCTYPE html>
<html>
<head>
</head>
<body>
<?php
$connect = mysqli_connect("localhost", "gs", "Rltp2ekd!", "db");

$inputpw = $_POST['pw'];
$no = $_POST['no'];
$query = "select * from soccer where no = '$no'";
$result = $connect ->query($query);
$info = mysqli_fetch_assoc($result);
if ($info['pw'] == $inputpw) {
    ?> <p>비밀번호 일치</p><?php
//게시글 삭제하는 함수
mysqli_query($connect, "delete from soccer where no = '$no'");

//a.i 1로 초기화
mysqli_query($connect, "ALTER TABLE soccer AUTO_INCREMENT=1;");
mysqli_query($connect, "set @cnt=0;");
mysqli_query($connect, "update soccer set no = @cnt:=@cnt+1;");


    $deletereply = "delete from soccerreply where no = '$no'";
    $connect ->query($deletereply);
    ?>
    <script>
        alert("게시글이 삭제되었습니다.");
        location.replace('soccer.php');
    </script>
    <?php
} else {

    ?> <script>
    alert("비밀번호가 일치하지 않습니다.");
    location.replace('soccerpostview.php?no=<?php echo $no?>');
</script>

<?php
}
mysqli_close($connect);
?>

</body>
</html>

