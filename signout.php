<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <?php include ("head.php"); ?>

    <style>
        .signout {
            margin-left: 40%;
            margin-top: 30px;
        }
    </style>
</head>
<div class="signout" >
<h2>회원 탈퇴</h2>
<form method="post" action="signoutserver.php">
    <input style="margin-top: 50px" type="password" placeholder="비밀번호를 입력하세요." name="nowpw">
    <input type="submit" value="탈퇴하기">
</form>
</div>
<body>
