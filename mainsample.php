<!DOCTYPE html>
<html lang="en" xmlns:float="http://www.w3.org/1999/xhtml" xmlns:width="http://www.w3.org/1999/xhtml"
      xmlns:text-align="http://www.w3.org/1999/xhtml">
<head>
    <?php session_start();

    $title_array = array();
    $id_array = array();
    $date_array = array();
    $no_array = array();

    $connect = mysqli_connect('localhost', 'gs', 'Rltp2ekd!', 'db') or die ("connect fail");

    $query = 'select * from baseball order by good desc limit 5;';

    $result = mysqli_query($connect, $query);

    while ($row = mysqli_fetch_array($result)) {
        array_push($title_array, $row['title']);
        array_push($id_array, $row['id']);
        array_push($date_array, $row['date']);
        array_push($no_array, $row['no']);
    }
    for ($i = 0; $i<count($title_array); $i++) {
        $id_array[$i];
        $title_array[$i];
        $date_array[$i];
        $no_array[$i];
    }
    $query0 = "select * from baseballreply where no = '$no_array[0]';";
    $result0 = mysqli_query($connect, $query0);
    $cnt0 = mysqli_num_rows($result0);
    $rc0 = $cnt0;

    $query1 = "select * from baseballreply where no = '$no_array[1]';";
    $result1 = mysqli_query($connect, $query1);
    $cnt1 = mysqli_num_rows($result1);
    $rc1 = $cnt1;

    $query2 = "select * from baseballreply where no = '$no_array[2]';";
    $result2 = mysqli_query($connect, $query2);
    $cnt2 = mysqli_num_rows($result2);
    $rc2 = $cnt2;

    $query3 = "select * from baseballreply where no = '$no_array[3]';";
    $result3 = mysqli_query($connect, $query3);
    $cnt3 = mysqli_num_rows($result3);
    $rc3 = $cnt3;

    $query4 = "select * from baseballreply where no = '$no_array[4]';";
    $result4 = mysqli_query($connect, $query4);
    $cnt4 = mysqli_num_rows($result4);
    $rc4 = $cnt4




    ?>
    <title>기씨인사이드</title>
    <style>
        .best {
            width: 900px;
            height: 400px;
            border: 1px solid darkgray;
            margin: 0 auto;
            margin-top: 30px;
        }
        /*왼쪽 개념글 오른쪽개념*/

        /*ul 리스트에 점찍히는거 없앰*/
        ul {
            list-style:none;
        }
        #text {
            text-align: left;
            margin-left: 40px;
            margin-top: 15px;
        }

        .post_writer {
            width: 100px;
            height: 60px;

        }
        .best_post {
            margin-left: 20px;
        }
        .post_title {
            display: inline-block;
            width: auto;
            max-width: 550px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;

            color: black; float: left;height: 60px; padding-top: 15px
        }
        .best_post {
            width: auto;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 880px;
            table-layout: fixed;
            border: 1px solid darkgray;
        }

    </style>
    <meta charset="utf-8">
    <!--헤더 파일 적용 시작부분-->
    <?php include ("head.php"); ?>
    <!-- 헤더파일 적용 끝부분 -->

</head>

<body>

<div class="best">
    <div class="text" id="text" text-align:center>기씨인사이드 개념글</div>
    <hr>
    <!--개념글 내용 왼쪽 자리-->
    <div class="best_post" style="float: top; width: 880px">
        <div style="float: left;width: 150px; padding-left: 5px; padding-top: 15px" class="post_writer"><?php echo $id_array[0];?></div>
        <a href="baseballpostview.php?no=<?php echo $no_array[0]; ?>" class="post_title"><?php echo $title_array[0];?></a>
        <a style="margin-top: 18px;float: left;color: black; font-size: 11px;"
           href="baseballpostview.php?no=<?php echo $no_array[0]; ?>">
            <?php if ($rc0 <= 0) {
            ?></a> <?php } else { ?>
            [<?php echo $rc0?>]</a>
            <?php
        }?>
        </a>
        <div style="float: right; padding-right: 15px; padding-top: 15px"><?php echo $date_array[0];?></div>
    </div>

    <!--    2번째 개념글-->
    <div class="best_post" style="float: left; width: 878px">
        <div style="float: left;width: 150px; padding-left: 5px; padding-top: 15px" class="post_writer"><?php echo $id_array[1];?></div>
        <a href="baseballpostview.php?no=<?php echo $no_array[1]; ?>"class="post_title"><?php echo $title_array[1];?></a>
        <a style="margin-top: 18px;float: left;color: black; font-size: 11px;"
           href="baseballpostview.php?no=<?php echo $no_array[1]; ?>">
            <?php if ($rc1 <= 0) {
            ?></a> <?php } else { ?>
            [<?php echo $rc1?>]</a>
            <?php
        }?>
        </a>
        <div style="float: right; padding-right: 15px; padding-top: 15px"><?php echo $date_array[1];?></div>
    </div>
    <!--    3번째-->
    <div class="best_post" style="float: left; width: 878px">
        <div style="float: left;width: 150px; padding-left: 5px; padding-top: 15px" class="post_writer"><?php echo $id_array[2];?></div>
        <a href="baseballpostview.php?no=<?php echo $no_array[2]; ?>" class="post_title"><?php echo $title_array[2];?></a>
        <a style="margin-top: 18px;float: left;color: black; font-size: 11px;"
           href="baseballpostview.php?no=<?php echo $no_array[2]; ?>">
            <?php if ($rc2 <= 0) {
            ?></a> <?php } else { ?>
        [<?php echo $rc2?>]</a>
        <?php
        }?></a>
        <div style="float: right; padding-right: 15px; padding-top: 15px"><?php echo $date_array[2];?></div>
    </div>
    <!--    4번-->
    <div class="best_post" style="float: left; width: 878px">
        <div style="float: left;width: 150px; padding-left: 5px; padding-top: 15px" class="post_writer"><?php echo $id_array[3];?></div>
        <a href="baseballpostview.php?no=<?php echo $no_array[3]; ?>" class="post_title"><?php echo $title_array[3];?></a>
        <a style="margin-top: 18px;float: left;color: black; font-size: 11px;"
           href="baseballpostview.php?no=<?php echo $no_array[3]; ?>">
            <?php if ($rc3 <= 0) {
            ?></a> <?php } else { ?>
            [<?php echo $rc3?>]</a>
            <?php
        }?>

        <div style="float: right; padding-right: 15px; padding-top: 15px"><?php echo $date_array[3];?></div>
    </div>
    <!--    5번째-->
    <div class="best_post" style="float: left; width: 878px">
        <div style="float: left;width: 150px; padding-left: 5px; padding-top: 15px" class="post_writer"><?php echo $id_array[4];?></div>
        <a href="baseballpostview.php?no=<?php echo $no_array[4]; ?>"  class="post_title"><?php echo $title_array[4];?></a>
        <a style="margin-top: 18px;float: left;color: black; font-size: 11px;"
           href="baseballpostview.php?no=<?php echo $no_array[4]; ?>">
            <?php if ($rc4 <= 0) {
            ?></a> <?php } else { ?>
            [<?php echo $rc4?>]</a>
            <?php
        }?>
        </a>
        <div style="float: right; padding-right: 15px; padding-top: 15px"><?php echo $date_array[4];?></div>
    </div>
    <!--  best_post div닫기-->

</div>



</body>
</html>