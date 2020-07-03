<?php
$connect = mysqli_connect("localhost", "gs", "Rltp2ekd!!", "db");
$id = $_POST['userid'];


if($id != NULL){
    $id_check = mysqli_query($connect, "select * from member where id='$id'");
    $id_check = $id_check->fetch_array();

    if($id_check >= 1){
        echo "존재하는 아이디입니다.";
    } else {
        echo "존재하지 않는 아이디입니다.";
    }
}
?>

