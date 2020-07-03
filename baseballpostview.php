<?php session_start();
$connect = mysqli_connect("localhost", "gs", "Rltp2ekd!", "db") or die("connect fail");
$no = $_GET['no'];
$page = $_GET['page'];
//조회수 구현
if (isset($_COOKIE[$no])) {
} else {
    $hit = "update baseball set view=view+1 where no='$no'";
    $viewResult = $connect->query($hit);
    setcookie($no, "view", time()+60*30);

}

//추천 비추천 구현
if (array_key_exists('good', $_POST)) {
    if (isset($_COOKIE[$no.good])) {
        echo "<script>alert(\"추천은 1일 1회만 가능합니다.\");</script>";
    } else {
        Setcookie($no.good, "good", time() + 60*60*24, "/");
        $good = "update baseball set good=good+1 where no='$no'";
        $connect->query($good);
        echo "<script>alert(\"추천 버튼을 눌렀습니다.\");</script>";
        echo "<script>location.replace('baseballpostview.php?no=$no')</script>";
    }
}
//싫어요 구현
if (array_key_exists('bad', $_POST)) {
    if (isset($_COOKIE[$no.bad]) || isset($_COOKIE[쿠키명])) {
        echo "<script>alert(\"비추천은 1일 1회만 가능합니다.\");</script>";
    } else {
        $bad = "update baseball set bad=bad+1 where no='$no'";
        $connect->query($bad);
        Setcookie($no.'bad', "bad", time() + 60*60*24, "/");
        echo "<script>alert(\"비추천 버튼을 눌렀습니다.\");</script>";
        echo "<script>location.replace('baseballpostview.php?no=$no')</script>";
    }
}

$query = "select * from baseball where no = '$no'";
$result = $connect ->query($query);
$info = mysqli_fetch_assoc($result);
$gettitle = $info['title'];
$time = $info['time'];
$memberid = $_SESSION['id'];
$getid = "select * from member where id = '$memberid'";
$getidinfo = $connect -> query($getid);
$getinfo = mysqli_fetch_assoc($getidinfo);
$nick = $getinfo['nick'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta content="text/html; charset=UTF-8"/>
    <title>국내야구갤러리</title>
    <style>
        .post_box {
            background-color: silver;
            /*background-color: whitesmoke;*/
            width: 900px;
            height: auto;
            margin-left: 26%;
            margin-top: 20px;
        }
        .reply_box {
            width: 900px;
            height: auto;
            margin-top: 20px;
            margin-left: 26%;
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
            margin-left: 26%;
            margin-top: 20px;
        }


        a:link {color : black;
            text-decoration:none;
        }



    </style>
    <?php include ("head.php"); ?>
    <?php session_start(); ?>
    <script>
        function makereply(th) {

            var elements1 = $('.reply_box > form > a');

            var elements2 = document.getElementsByClassName("re_re");

            for (var i = 0; i < elements2.length; i++) {
                if (th == elements1[i]) {
                    if (elements2[i].style.display == "block"){
                        elements2[i].style.display= "none";
                        document.getElementsByName("rereply")[i].value='';
                    }else{
                        elements2[i].style.display= "block";
                    }
                }
            }
        }
    </script>
</head>
<body>
<h1 style="margin-left: 40%; margin-top: 20px">국내야구 갤러리</h1>
<!--게시글 부분-->
<div class="post_box">
    <form action="baseballpostdelete.php" method="post">
        <input type="hidden" value="<?php $info['title']?>" name="title">
    </form>
    <div class="up_contents" style="margin-left: 10px; margin-top: 5px">
        <h5 class="title"><?php echo $info['title'] ?> </h5>
        <div class="up_down" style="margin-top: 5px">
            <div class='id' style="float: left"><?php echo $info['id']?></div>
            <div class="date">ㅣ<?php echo $info['date']?>
                <div style="float: right; margin-right: 5px" id="viewCount"> 조회 <?php echo $info['view'] ?></div>
                <div style="float: right; margin-right: 5px"> 추천 <?php echo $info['good'] ?> </div>
            </div>

        </div>
        <hr style="margin-top: 20px">
        <!--        주소창에서 복붙해온 링크 스플릿해서 embed로 바꿔주는 부분-->
        <?php if ($info['video'] != "") {
            $videourl  = $info['video'];
           $pieces = explode("/", $videourl);
           $backpieces = explode("watch?v=", $pieces[3]);
           $naver = explode("v", $pieces[3]);
           $video = $pieces[0] ."//". $pieces[1]. $pieces[2]."/embed/".$backpieces[1];

            ?>
            <iframe src='<?php echo $video ?>'  style="border: none" WIDTH='600' HEIGHT='350' allowfullscreen>
            </iframe>
        <?php } else {} ?>
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

<!--게시글 수정 삭제버튼-->
<div class="edit_button" style="float: left; margin-left: 63%">
    <div class="editbt">
        <form action="baseballpostupdate.php" method="post">
            <input type="hidden" value="<?php echo $no?>" name="no">
            <input type="submit" value="수정" style="background-color: #505050; border: none;color: white">
        </form>
    </div>
</div>
<div class="deletebt" style="float: left;margin-left: 10px">
    <form action="baseballpostdelete.php" method="post">
        <input type="hidden" value="<?php echo $no?>" name="no">
        <input type="submit" value="삭제" style="background-color: #505050;border: none; color: white">
    </form>
</div>
<div class="dev">
    <!--    관리자 권한 게시글 삭제 버튼 -->
    <div class="dev" style="margin-top: 30px; ">
        <?php
        if ($_SESSION['id'] == "admin01") {
            ?>
            <form action="baseballdevpostdel.php" method="post">
                <input style="margin-left: 59%;background-color: #505050; border: none;color: white" type="submit" value="관리자권한 게시글 삭제">
                <input type="hidden" value="<?php echo $no ?>" name="no">
            </form>
            <?
        } ?>
    </div>
</div>




<!--댓글 불러오는 부분-->
<?php
//$isd = 0;
$reply = "select * from baseballreply where time = '$time' and isdeleted = 0 order by date asc";
$result = $connect ->query($reply);
while ($setreply = mysqli_fetch_assoc($result)) {
    ?>
    <div class="reply_box" style="float: left; height: auto">
<!--        댓글삭제부분 -->
        <form action="baseballreplydel.php" method="post">
            <div style="padding-left: 5px;float: left; width: 100px;" class="nick"><?php echo $setreply['id']?></div>
            <!-- 저기 파라미터칸에 this라는게 나 자신을 보내겠다는거임(엘리먼트)/  리턴 false는 클릭했을때 화면맨위로 이동하는걸 막기위함 -->
            <a style="width: 600px;float: left; margin-left: 30px; padding-left: 5px;color: black;text-decoration:none" class="reply" href="#" onclick="javascript:makereply(this); return false;"><?php echo $setreply['reply'] ?></a>
            <input type="submit" value="X" style="margin-right: 1px;float: right;width: 28px; height: 28px;" >
            <input type="hidden" value="<?php echo $setreply['id']?>" name="id">
            <input type="hidden" value="<?php echo $setreply['reply']?>" name="reply">
            <input type="hidden" value="<?php echo $setreply['time']?>" name="time">
            <input type="hidden" value="<?php echo $setreply['commenttime']?>" name="commenttime">
            <input type="hidden" value="<?php echo $no?>" name="no">
        </form>
        <?php if ($_SESSION['id']=="admin01") {
            ?>
            <form action="baseballdevreplydel.php" method="post">
                <input type="submit" value="관X" style="font-size: 5px;margin-right: 1px;float: right;width: 28px; height: 28px;" >
                <input type="hidden" value="<?php echo $setreply['id']?>" name="id">
                <input type="hidden" value="<?php echo $setreply['reply']?>" name="reply">
                <input type="hidden" value="<?php echo $setreply['time']?>" name="time">
                <input type="hidden" value="<?php echo $setreply['commenttime']?>" name="commenttime">
                <input type="hidden" value="<?php echo $no?>" name="no">
            </form>
            <?php
        } else {

        }?>
        <div style="float: right; margin-right: 3px;font-size: 5px"><?php echo $setreply['date']?></div>


        <!--    대댓글 작성부분 -->
        <div class="re_re" id ="re_re" style="background-color: darkgray;margin-top: 10px;margin-bottom: 10px;width: 820px; height:150px; border : 1px solid black;float: left; margin-left: 50px; display: none">
            <form method="post" action="baseballrerereuploadserver.php" name="rere">
                <div class="re_nick_and_pw" style="float: left;">
                    <div class="nick">
                        <input maxlength="6" style="margin-left: 5px;margin-top: 5px; width: 150px"type="text" name="nick" placeholder="닉네임" value="<?php echo $nick?>">
                    </div>
                    <div class="password" style="margin-left: 5px;margin-top: 5px">
                        <input style="width: 150px"type="password" name="pw" placeholder="비밀번호">
                    </div>
                </div>
                <div class="re_reply_contents" style="margin-left: 5px;margin-top: 5px;float: left;">
                    <!-- ID = 단일(오직 하나만. 유니크함) class, name = 배 -->
                    <textarea maxlength="320" type="text" style="width: 650px; height: 100px; padding-bottom: 80px" name="rereply" id="rereply"></textarea>
                    <input type="hidden" value="<?php echo $setreply['commenttime']?>" name="commenttime">
                    <input type="hidden" value="<?php echo $setreply['replyno']?>" name="replyno">
                    <input type="hidden" value="<?php echo $no?>" name="no">
                </div>
                <input style="margin-top: 10px;float: right;margin-right: 5px;border: 1px solid #4B48AE;background-color: #4B48AE; color: white" type="submit" value="등록" >
            </form>
            <!--       re_re-->
        </div>
<!--        대댓글 불러오는 부분 -->
        <?php
        $replyno = $setreply['replyno'];
        $commenttime = $setreply['commenttime'];
        $rereply = "select * from baseballrereply where replyno = '$replyno' and commenttime = '$commenttime'";
        $reresult = $connect->query($rereply);

        while ($setrereply = mysqli_fetch_assoc($reresult)) {
            if ($setrereply) {
                ?>
                <div class="re_reply">
                        <div class="re_id" style="background-color: darkgray;margin-top: 5px;float: left;margin-left: 50px; width: 130px; height: auto"><?php echo $setrereply['id'] ?></div>
                        <div class="re_reply" style="background-color: darkgray;margin-top: 5px;float: left; width: 550px; height: auto"><?php echo $setrereply['reply']?></div>
                        <div class="re_date" style="margin-top: 5px;float:left;margin-left: 20px;font-size: 5px;"><?php echo $setrereply['date']?></div>
                        <?php if ($_SESSION['id']=="admin01") {
                            ?>
                            <form method="post" action="baseballdevrereplydel.php">
                            <input type="hidden" value="<?php echo $setrereply['id']?>" name="id">
                        <input type="hidden" value="<?php echo $setrereply['reply']?>" name="reply">
                        <input type="hidden" value="<?php echo $no?>" name="no">
                            <button type="submit" style="margin-top:5px;float: left;width: 22px; height: 22px;text-align: center; font-size: 7px;">X</button>
                            </form>
                            <form method="post" action="baseballdeleterereply.php">

                                <input type="hidden" value="<?php echo $setrereply['id']?>" name="id">
                                <input type="hidden" value="<?php echo $setrereply['reply']?>" name="reply">
                                <input type="hidden" value="<?php echo $no?>" name="no">
                                <input type="hidden" value="<?php echo $setrereply['date']?>" name="date">
                                <button type="submit" style="margin-top:5px;float: left;width: 22px; height: 22px;text-align: center; font-size: 7px;">x</button>
                            </form>
                            <?php
                        } else {?>
                        <form method="post" action="baseballdeleterereply.php">
                            <input type="hidden" value="<?php echo $setrereply['id']?>" name="id">
                            <input type="hidden" value="<?php echo $setrereply['reply']?>" name="reply">
                            <input type="hidden" value="<?php echo $no?>" name="no">
                            <input type="hidden" value="<?php echo $setrereply['date']?>" name="date">
                        <button type="submit" style="margin-top:5px;float: left;width: 22px; height: 22px;padding-bottom: 5px; font-size: 7px;">x</button>
                        </form>
                
            
                    <?php } ?>
                
                </div>
                <?php
            } else {}
        }
        ?>


    </div>
    <?php
}
?>

<!-- 댓글 작성부분 -->
<div class="write_reply" style=" float: left; margin-bottom: 30px;">
    <form action="baseballreplyuploadserver.php" method="post" name="replyfr">
        <div class="nick_and_pw" style="float:left; margin-left: 5px; width: 155px; height: 100px">
            <div class="nick">
                <input maxlength="6" style="margin-top: 5px; width: 150px"type="text" name="nick" placeholder="닉네임" value="<?php echo $nick?>">
            </div>
            <div class="password" style="margin-top: 5px">
                <input style="width: 150px"type="password" name="pw" placeholder="비밀번호">
            </div>
        </div>
        <div class="reply_contents" style="float: left; width: 730px; height: 100px">
            <div class="write_contents">
                <textarea maxlength="320" type="text" style="width: 730px; height: 100px;margin-top: 5px; padding-bottom: 80px" name="reply" id="reply" ></textarea>

                <!--               textarea 엔터키 눌렀을때 댓글 등록되게 해주는 과정        -->
                <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
                <script>
                    //모든 페이지가 요청이 되었을 때
                    $(document).ready(function() {
                        // ID를 alpreah_input로 가지는 곳에서 키를 누를 경우
                        $("#reply").keydown(function(key) {
                            //키의 코드가 13번일 경우 (13번은 엔터키)
                            if (key.keyCode == 13) {
                                //등록이 된다다
                                document.replyfr.submit();
                            }
                        });
                    });
                </script>
                <!---->
                <input type="hidden" value="<?php echo $_SESSION['id']?>" name="loginid">
                <input type="hidden"value="<?php echo $info['no']?>" name="no">
                <input type="hidden"value="<?php echo $info['title']?>" name="title">
                <input type="hidden" value="<?php echo $info['time'] ?>" name="time">
                <input style="margin-top: 10px;float: right;border: 1px solid #4B48AE;background-color: #4B48AE; color: white" type="submit" value="등록" >
    </form>
</div>
<div class="list_view" style="float: right; margin-top: 10%; margin-bottom: 5%">
    <button style="background-color: rgba( 255, 255, 255, 0.5 ); border: 1px solid darkgray" type="button" onclick="location.href='baseball.php?page=<?php echo $page?>'">목록
</div>

<!--                reply_contents -->
</div>
</div>

</body>
</html>