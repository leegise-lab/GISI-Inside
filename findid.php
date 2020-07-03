<?php
$connect = mysqli_connect("localhost", "gs", "Rltp2ekd!", "db");

$name = $_POST['name'];
$email = $_POST['email'];

$query = "select * from member where name = '$name' and email ='$email'";
$result = mysqli_query($connect, $query);
$info = mysqli_fetch_assoc($result);
$getid = $info['id'];
if ($info != null) {
?>
<script>
    alert("회원님의 아이디는 '<?php echo $getid?>' 입니다.");
    location.replace("findidandpw.php");
</script>
<?php
} else {
    ?>
    <script>
    alert("존재하지 않는 회원정보입니다.");
    location.replace("findidandpw.php");
    </script>
<?php
}

?>

