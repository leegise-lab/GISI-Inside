<?php session_start();

$id = $_SESSION['id'];
$a = $_REQUEST[checkbox];
$connect = mysqli_connect("localhost", "gs", "Rltp2ekd!", "db");


for ($i=0; $i<=count($a); $i++) {
    $query = "delete from baseballreply where replyno = '$a[$i]'";
    mysqli_query($connect, $query);
}
?>
<script>
    alert("삭제가 완료되었습니다.");
    location.replace('reply_lookup.php');
</script>
<?php
?>