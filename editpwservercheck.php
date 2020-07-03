<?php session_start();

$id = $_SESSION['id'];
$nowpw = $_POST['nowpw'];
$pw = $_POST['pw'];

$connect = mysqli_connect("localhost", "gs", "Rltp2ekd!", "db");
$query = "select * from member where id = '$id'";
$result = mysqli_query($connect, $query);
$info = mysqli_fetch_assoc($result);




if ($info['pw'] != $nowpw) {
    ?>
    <script>
    alert('현재 비밀번호가 틀립니다.');
    location.replace("editpw.php");
    </script>
<?php
} else {

    $editpw = "update member set pw='$pw' where id='$id'";
    $result = $connect->query($editpw);

    if ($result) {
        ?>
        <script>
        alert('비밀번호가 변경되었습니다.');
        location.replace("mypage.php");
        </script>
        <?
    } else {
        ?>
        <script>
            alert('비밀번호 변경이 실패했습니다.');            location.replace("mypage.php");
        </script>
        <?
    }
}
?>