<?php session_start();

$connect = mysqli_connect("localhost", "gs", "Rltp2ekd!", "db");

$id = $_SESSION['id'];
$query = "select * from member where id = '$id'";
$result = $connect->query($query);
$info = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<head>
    <style>
        .my_id {
            width: 800px;
            height: 400px;
            margin-left: 34%;
            margin-bottom: 30px;
            margin-top: 10px;
        }
        .my_id_box {
            float:left;
            margin-left: 50px;
        }

        .tap {
            margin-top: 30px;
            margin-left: 42%;
        }
        .tap-menu {
            color: black;
            float: left;
            width: 150px;
            height: 30px;
            border: 1px solid black;
            text-align: center;
            padding-top: 2px;
        }

    </style>
    <title>기씨:마이 페이지</title>
    <?php include ("head.php"); ?>
</head>
<body>

<div class="tap">
    <a class="tap-menu" href="mypage.php">회원 정보</a>
    <a class="tap-menu" href="post_lookup.php">내가 쓴 게시글확인</a>
</div>



<div class="my_id" >
    <div class="my_id_box">
        <form method="post" action="editid.php" style="margin-top: 25px">
            <div class="id_text" style="float:top;" >
                <a>아이디</a>
                <input readonly style="margin-top:30px; color: black;margin-left: 30px; border: 1px solid silver; padding-left: 5px" placeholder="<?php echo $info['id']?>">
                <input type="hidden" value="<?php echo $info['id']?>" name="id">
            </div>

            <div class="id_text" style="margin-top: 30px;">
                <a>닉네임</a>
                <input maxlength="6" style="margin-left: 30px; color: black; border: 1px solid silver; padding-left: 5px" placeholder="<?php echo $info['nick']?>"name="nick">
                <a style="float: bottom; color: #7d7d7d">닉네임은 1~6자까지 가능합니다.</a>
            </div>

            <div class="id_text" style="margin-top: 30px">
                <a>이름</a>
                <input readonly style="color: black; margin-left: 45px; border: 1px solid silver; padding-left: 5px" placeholder="<?php echo $info['name']?>">
            </div>

            <div class="id_text" style="margin-top: 30px">
                <a>이메일</a>
                <input readonly style="color: black; margin-left: 30px; border: 1px solid silver; padding-left: 5px" placeholder="<?php echo $info['email']?>">
            </div>
            <div class="edit_botton" style="margin-top: 30px">
                <input style="margin-left: 42%;background-color: rgba( 255, 255, 255, 0.5 ); border: 1px solid darkgray" type="submit" value="수정 완료">
                </form>
        <form method="post" action="signout.php">
            <input style="float: right;background-color: rgba( 255, 255, 255, 0.5 ); border: none; color: #4B48AE" type="submit" value="회원 탈퇴">
        </form>
                <form method="post" action="editpw.php">
                    <input style="float: left; margin-right: 10px; border: none;background-color: rgba( 255, 255, 255, 0.5 ); color: #DF4D4D" type="submit" value="비밀번호 변경">
                </form>
            </div>
</div>

</div>

</body>
</html>
<?php


