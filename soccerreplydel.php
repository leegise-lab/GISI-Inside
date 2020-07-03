<?php session_start();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<?php include ('head.php');
$id = $_POST['id'];
$reply = $_POST['reply'];
$no = $_POST['no'];
?>
    <style>
        .delete {
            margin-top: 150px;
            margin-left: 40%;
        }
    </style>
</head>
<body>
<div class="delete">
    <form action="soccerreplydelete.php" method="post">
        <input type="hidden" value="<?php echo $id ?>" name="id">
        <input type="hidden" value="<?php echo $reply ?>" name="reply">
        <input type="hidden" value="<?php echo $no ?>" name="no">
        <input style="width: 260px" type="password" name="pw" placeholder="삭제할 댓글의 비밀번호를 입력하세요.">
        <input type="submit" value="입력완료">
    </form>
</div>





</body>
</html>