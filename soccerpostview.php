<?php
$connect = mysqli_connect("localhost", "gs", "Rltp2ekd!", "db") or die("connect fail");
$no = $_GET['no'];

$query = "select * from soccer where no = '$no'";
$result = $connect ->query($query);
$info = mysqli_fetch_assoc($result);
$gettitle = $info['title'];

if (array_key_exists('good', $_POST)) {
    if (isset($_COOKIE[$no+good])) {
        echo "<script>alert(\"추천은 1일 1회만 가능합니다.\");</script>";
    } else {
        Setcookie($no+'good', "value", time() + 60, "/");
        $good = "update soccer set good=good+1 where no='$no'";
        $connect->query($good);
        echo "<script>alert(\"추천 버튼을 눌렀습니다.\");</script>";
    }
}
//싫어요 구현
if (array_key_exists('bad', $_POST)) {
    if (isset($_COOKIE[$no+bad]) || isset($_COOKIE[쿠키명])) {
        echo "<script>alert(\"비추천은 1일 1회만 가능합니다.\");</script>";
    } else {
        $bad = "update soccer set bad=bad+1 where no='$no'";
        $connect->query($bad);
        Setcookie($no+'bad', "value", time() + 60, "/");
        echo "<script>alert(\"비추천 버튼을 눌렀습니다.\");</script>";
    }
}

if (isset($_COOKIE[$gettitle+$no])) {

} else {
    $hit = "update soccer set view=view+1 where no='$no'";
    $connect->query($hit);
    setcookie($gettitle+$no, "value", time()+60*30);
}




?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta content="text/html; charset=UTF-8"/>
    <title>해외축구갤러리</title>
    <style>
        .post_box {
            background-color: silver;
            /*background-color: whitesmoke;*/
            width: 900px;
            height: auto;
            margin-left: 21%;
            margin-top: 20px;
        }
        .reply_box {
            width: 900px;
            height: auto;
            margin-top: 20px;
            margin-left: 21%;
            /*background-color: whitesmoke;*/
            background-color: silver;
        }
        .good_bad {
            /*border: 1px solid darkgray;*/
            margin-top: 30px;
            width: 210px;
            height: 100px;
            margin-left: 43%;
            margin-right: 40%;
        }
        .write_reply {
            width: 900px;
            height: 150px;
            background-color: lightsteelblue;
            float: bottom;
            margin-left: 21%;
            margin-top: 20px;
        }
    </style>
    <?php include ("head.php"); ?>
    <?php session_start(); ?>
</head>
<body>
<h1 style="margin-left: 40%; margin-top: 20px">해외축구 갤러리</h1>
<!--게시글 부분-->
<div class="post_box">
    <form action="soccerpostdelete.php" method="post">
        <input type="hidden" value="<?php $info['title']?>" name="title">
    </form>
    <div class="up_contents" style="margin-left: 10px; margin-top: 5px">
        <h5 class="title"><?php echo $info['title'] ?> </h5>
        <div class="up_down" style="margin-top: 5px">
            <div class='id' style="float: left"><?php echo $info['id']?></div>
            <div class="date">ㅣ<?php echo $info['date']?>
                <div style="float: right; margin-right: 5px"> 조회 <?php echo $info['view'] ?></div>
                <div style="float: right; margin-right: 5px"> 추천 <?php echo $info['good'] ?> </div></div>
        </div>
        <hr style="margin-top: 20px">
        <div class="contents"><?php echo $info['contents'] ?> </div>

    </div>
</div>
</div>
<!--좋아요 싫어요 보여주는 부분-->
<div class="good_bad">
    <div class="good" style="float: left;width: 49%; height: 99px">
        <p style="width: 100px; height: 30%; text-align: center"><?php echo $info['good']?></p>
        <form method="post">
            <input type="submit" style="width: 100px; height: 30px;"value="추천" name="good" >
        </form>
        <!--      good class-->
    </div>
    <div class="bad" style="float: left; width:49%; height:99px;">
        <p style="width: 100px; height: 30%; text-align: center"><?php echo $info['bad']?></p>
        <form method="post">
            <input type="submit" style="width: 100px; height: 30px;"value="비추천" name="bad">
        </form>
    </div>
</div>
<!--댓글 불러오는 부분-->
<?php
$reply = "select * from soccerreply where no = '$no'order by date desc ";
$result = $connect ->query($reply);
while ($setreply = mysqli_fetch_assoc($result)) {
    ?>
    <div class="reply_box" style="float: left; height: 28px">
        <form action="soccerreplydel.php" method="post">
        <div style="padding-left: 5px;float: left; width: 100px;" class="nick"><?php echo $setreply['id']?></div>
        <div style="width: 600px; height:28px;float: left;border-left: 1px solid darkgray; margin-left: 40px; padding-left: 5px;" class="reply;"><?php echo $setreply['reply'] ?></div>
        <input type="submit" value="X" style="margin-right: 1px;float: right;width: 28px; height: 28px;" >
            <input type="hidden" value="<?php echo $setreply['id']?>" name="id">
            <input type="hidden" value="<?php echo $setreply['reply']?>" name="reply">
            <input type="hidden" value="<?php echo $no?>" name="no">
        </form>
        <div style="float: right; margin-right: 3px;font-size: 5px"><?php echo $setreply['date']?></div>
    </div>
    <?php
}
?>






<!--댓글 작성하는 부분-->
    <div class="write_reply" style=" float: left;">
    <form action="soccerreplyuploadserver.php" method="post">
        <div class="nick_and_pw" style="float:left; margin-left: 5px; width: 155px; height: 100px">
            <div class="nick" >
                <input maxlength="6" style="margin-top: 5px; width: 150px"type="text" name="nick" placeholder="닉네임">
            </div>
            <div class="password" style="margin-top: 5px">
                <input style="width: 150px"type="password" name="pw" placeholder="비밀번호">
            </div>
        </div>
        <div class="reply_contents" style="float: left; width: 630px; height: 100px">
            <div class="write_contents" style="width: 630px">
                <input maxlength="40" type="text" style="width: 630px; height: 100px;margin-top: 5px; padding-bottom: 80px" name="reply" >
                <input type="hidden"value="<?php echo $info['no']?>" name="no">
                <input type="hidden"value="<?php echo $info['title']?>" name="title">
                <input style="word-wrap:break-word;margin-top: 10px;float: right" type="submit" value="등록하기">

    </form>
                <!--수정 삭제 버튼구현-->
                <div class="edit_button" style="margin-top: 80px; float: right">
                    <div class="editbt">
                        <form action="soccerpostupdate.php" method="post">
                            <input type="hidden" value="<?php echo $info['no']?>" name="no">
                            <input type="submit" value="수정">
                        </form>
                    </div>
                </div>
                    <div class="deletebt" style="margin-top: 80px; margin-right: 10px; float: right">
                        <form action="soccerpostdelete.php" method="post">
                            <input type="hidden" value="<?php echo $info['no']?>" name="no">
                            <input type="submit" value="삭제">
                        </form>
                    </div>

                </div>

            </div>
            <!--                reply_contents -->
        </div>

    </div>


</body>
</html>