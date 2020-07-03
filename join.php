<?php

$servername = "localhost";
$username = "gs";
$password = "Rltp2ekd!";
$dbname = "db";


$connect = mysqli_connect($servername, $username, $password, $dbname);

//
$id=$_POST["id"];
$pw=$_POST["pw"];
$email=$_POST["email"];
$nick=$_POST['nick'];
$name=$_POST['name'];

$query2 = "select * from member where id = '$id'";
$result2 = $connect -> query($query2);
$info = mysqli_num_rows($result2);
if ($result2->num_rows==1) {
    ?>
    <script>
        alert('이미 존재하는 아이디입니다.');
        history.back();
    </script>
    <?
} else {
//입력받은 데이터를 DB에 저장
    $query = "INSERT INTO member (id, pw, email, nick, name) values ('$id' , '$pw' , '$email', '$nick', '$name')";

    $result = $connect->query($query);

//저장이 됬다면 (result = true) 가입 완료
    if ($result) {
        ?><
        <script>
            alert('회원가입이 완료되었습니다.');
            location.replace("main.php");
        </script>

    <?php } else {
        ?>
        <script>
            alert("회원가입이 실패했습니다.");
            location.replace("main.php");
        </script>

        <?php
    }

    mysqli_close($connect);
}
?>
