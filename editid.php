<?php session_start();

$id = $_POST['id'];
$nick = $_POST['nick'];

$connect = mysqli_connect("localhost", "gs", "Rltp2ekd!", "db");
$query = "select * from member where id = '$id'";
$result = mysqli_query($connect, $query);


$editnick = "update member set nick='$nick' where id='$id'";
$result = $connect->query($editnick);


if ($result) {
    ?>
    <script>
        alert('닉네임 변경되었습니다.');
        location.replace("mypage.php");
    </script>
    <?
} else {
    ?>
    <script>
        alert('닉네임 변경이 실패했습니다.');            location.replace("mypage.php");
    </script>
    <?
}

?>

