<?php
$connect=mysqli_connect("localhost", "gs", "Rltp2ekd!", "db");
$id = $_POST['id'];
$query = "select * from member where id = '$id'";
$result = $connect -> query($query);
$rows = mysqli_fetch_row($result);
//



if ($rows >= 1) {
//    중복
    echo "<span style='color:red;'>사용 불가능한 아이디입니다.</span>";

} else {
//    사용가능
    echo "<span style='color:green;'>사용 가능한 아이디입니다.</span>";
}

?>

