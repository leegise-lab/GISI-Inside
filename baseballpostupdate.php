<!DOCTYPE html>
<html>
<head>
    <style>
        .input_info {
            margin-left: 40%;
            margin-top: 10%;
        }
    </style>
    <?php include ("head.php"); ?>
    <?php session_start(); ?>
</head>
<body>
<div class="input_info">
    <?php
    $no = $_POST["no"];
    ?>
<form method="post" action="baseballupdatewrite.php">
    <input type="hidden" value="<?php echo $no ?>" id="no" name="no">
    <input type="password" placeholder="비밀번호를 입력하세요" id="pw" name="pw">
    <input type="submit" value="확인">
<!--    여기까지 no 잘 들어있음-->
</form>



</div>

</body>

</html>
