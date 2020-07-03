<?php session_start();
$id = $_SESSION['id'];
$pw = $_POST['nowpw'];

$connect = mysqli_connect("localhost", "gs", "Rltp2ekd!", "db");
$query = "select * from member where id = '$id'";
$result = mysqli_query($connect, $query);
$info = mysqli_fetch_assoc($result);
$getpw = $info['pw'];
if ($pw != $getpw) {
    ?>
    <script>
        alert('비밀번호가 틀립니다.');
        location.replace("signout.php");
    </script>
    <?
} else {

    $deleteid = "delete from member where id = '$id'";
    mysqli_query($connect, $deleteid);
    session_destroy();
    ?>
    <script>
        alert('탈퇴가 완료되었습니다.');
        location.replace("main.php");
    </script>
    <?
}


?>