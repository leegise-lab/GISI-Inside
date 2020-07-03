<?php session_start();

//접속 잘 되는거 확인함.
$connect = mysqli_connect("localhost", "gs", "Rltp2ekd!", "db") or die("mysql connect fail");

$id = $_POST['id'];
$pw = $_POST['pw'];


$sql = "SELECT * FROM member WHERE id = '$id'";

$result = $connect->query($sql);
if ($result->num_rows==1) {
    $row = $result->fetch_array(MYSQLI_ASSOC);
    if ($row['pw'] == $pw) {
        $_SESSION['id']=$id;
        if (isset($_SESSION['id'])) {
            session_start();
            ?>
            <script>
                alert("로그인 되었습니다.");
                location.replace("../main.php");
            </script>
        <?php } else {
            echo "세션 실패";
        }
    } else {
    }
    ?>
    <script>
    alert("아이디 혹은 비밀번호가 틀립니다.");
    location.replace("../main.php");

    </script><?php
} else {
    ?>
    <script>
    alert("아이디 혹은 비밀번호가 틀립니다.");
    location.replace("../main.php");

    </script><?php
}