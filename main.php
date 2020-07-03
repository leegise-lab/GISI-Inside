<!DOCTYPE html>
<html lang="en" xmlns:float="http://www.w3.org/1999/xhtml" xmlns:width="http://www.w3.org/1999/xhtml"
      xmlns:text-align="http://www.w3.org/1999/xhtml">
<head>
    <?php session_start();
//    개념글 상위 10개 가져오기

    $title_array = array();
    $id_array = array();
    $date_array = array();
    $no_array = array();
    //time_array에는 게시글 구분점인 time이 들어감
    $time_array = array();
    $img_array = array();
    $contents_array =  array();

    $connect = mysqli_connect('localhost', 'gs', 'Rltp2ekd!', 'db') or die ("connect fail");

    $query = 'select * from baseball order by good desc limit 10;';

    $result = mysqli_query($connect, $query);

    while ($row = mysqli_fetch_array($result)) {
        array_push($title_array, $row['title']);
        array_push($id_array, $row['id']);
        array_push($no_array, $row['no']);
        array_push($contents_array, $row['contents']);
        array_push($time_array, $row['time']);
        //        컨텐츠에 있이미지 주소받아옴
        $img = $row['contents'];
        $imgarray = explode( '"', $img);
        array_push($img_array, $imgarray[1]);
        $date = $row['date'];
        $datearray = explode( ' ', $date);
        array_push($date_array, $datearray[0]);
    }
    for ($i = 0; $i<count($title_array); $i++) {
        $id_array[$i];
        $title_array[$i];
        $date_array[$i];
        $no_array[$i];
        $img_array[$i];
    }

    $query = range(0, 9);
    $result = range(0, 9);
    $cnt = range(0, 9);
    $rc = range(0, 9);

    //게시글 10개의 쿼리문과 데이터를 담는 부분분
   for ($i=0; $i<10; $i++) {
        $query[$i] = "select * from baseballreply where time = '$time_array[$i]';";
        $result[$i] = mysqli_query($connect, $query[$i]);
        $cnt[$i] = mysqli_num_rows($result[$i]);
        $rc[$i] = $cnt[$i];
    }



    ?>
    <title>기씨인사이드</title>
    <style>
        .best {
            width: 1100px;
            height: 600px;
            border: 1px solid;
            margin: 0 auto;
            margin-top: 30px;
            margin-bottom: 30px;

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


        .picture {
            width: 150px;
            height: 90px;
            float: left;
            cursor: pointer;
            padding-left: 0.3px;
        }


        .best_post {
            margin-left: 13px;
            width: 530px;
            height: 92px;
            border: 1px solid darkgray;
            margin-top: 10px;
            float: left;
        }

        .num {
            border-right: 1px solid darkgray;
            width: 50px;
            height: 90px;
            text-align: center;
            padding-top: 33px;
            float: left;
        }

        .best_title {
            display: inline-block;
            width: 327px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;

            color: black;
            height: 50px;
            padding-top: 10px;
            padding-left: 5px;
            cursor: pointer;
        }

        .best_nick {
            float: left;
            margin-top: 10px;
            cursor: pointer;
            margin-left: 5px;
        }

        .best_date {
            float: right;
            margin-top: 10px;
            margin-right: 5px;
        }

        .atag {
            display: inline-block;
            max-width: 430px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

    </style>
    <meta charset="utf-8">
    <!--헤더 파일 적용 시작부분-->
    <?php include ("head.php"); ?>
    <!-- 헤더파일 적용 끝부분 -->

</head>

<body>



<div class="best">
    <div class="text" id="text" text-align:center; style="height: 30px; font-size: 15pt"><b>기씨인사이드 개념글</b></div>
    <hr>
    <div class="best_post" style="border: 1px solid green">
        <div class="num" style="border-right: 1px solid green"><a style="color: green">1</a></div>
        <!--        만약 사진이 있다면-->
        <?php if (strpos($contents_array[0], "<img src=\"/smarteditor2/upload/")) {
            ?>
            <div class="picture" onclick="location.href='baseballpostview.php?no=<?php echo $no_array[0]; ?>'"><img src="<?php echo $img_array[0]?>" style="width: 148px; height: 90px"></div>
            <div class="best_title" style="float: left"><a style="color: black; font-size: 15px;margin-left: 3px;">
                    <?php if ($rc[0] <= 0) {
                    //                 댓글이 없다면
                    ?></a> <?php } else { ?>
                    [<?php echo $rc[0]?>]</a>
                    <?php
                }?>
                <div style="float: left" onclick="location.href='baseballpostview.php?no=<?php echo $no_array[0]; ?>'" ><b><?php echo $title_array[0];?></b></div></div>
            <div class="best_nick" onclick="location.href='baseballpostview.php?no=<?php echo $no_array[0]; ?>'"><?php echo $id_array[0];?></div>
            <div class="best_date"><?php echo $date_array[0];?></div>
<!--            사진이 없다면-->
        <?php } else if (!strpos($img_array[0], "<img src=\"/smarteditor2/upload/")) {
            ?>
            <a class="atag" style="width:auto;float: left;cursor: pointer; padding-left: 5px;margin-top: 10px;" onclick="location.href='baseballpostview.php?no=<?php echo $no_array[0]; ?>'"><b><?php echo $title_array[0];?></b></a>
        <a style="margin-left: 3px;float:left; margin-top : 10px;color: black; font-size: 15px;width: auto"
           href="baseballpostview.php?no=<?php echo $no_array[0]; ?>">
            <?php if ($rc[0] <= 0) {
//                 댓글이 없다면
                ?></a> <?php } else { ?>
                [<?php echo $rc[0]?>]</a>
                <?php
            }?>
            </a>
            <div onclick="location.href='baseballpostview.php?no=<?php echo $no_array[0]; ?>'" style="cursor: pointer;padding-left: 5px;float: left; width: 350px; margin-top: 30px"><?php echo $id_array[0];?></div>
            <div style="float: left; margin-top: 30px;margin-left: 40px" ><?php echo $date_array[0];?></div>
            <?php
        } ?>
    </div>

    <div class="best_post">
        <div class="num">6</div>
        <!--        만약 사진이 있다면-->
        <?php if (strpos($contents_array[5], "<img src=\"/smarteditor2/upload/")) {
            ?>
            <div class="picture" onclick="location.href='baseballpostview.php?no=<?php echo $no_array[5]; ?>'"><img src="<?php echo $img_array[5]?>" style="width: 148px; height: 90px"></div>
            <div class="best_title" style="float: left"><a style="color: black; font-size: 15px;margin-left: 3px;">
                    <?php if ($rc[5] <= 0) {
                    //                 댓글이 없다면
                    ?></a> <?php } else { ?>
                    [<?php echo $rc[5]?>]</a>
                    <?php
                }?>
                <div style="float: left" onclick="location.href='baseballpostview.php?no=<?php echo $no_array[5]; ?>'" ><b><?php echo $title_array[5];?></b></div></div>
            <div class="best_nick" onclick="location.href='baseballpostview.php?no=<?php echo $no_array[5]; ?>'"><?php echo $id_array[5];?></div>
            <div class="best_date"><?php echo $date_array[5];?></div>
            <!--            사진이 없다면-->
        <?php } else if (!strpos($img_array[5], "<img src=\"/smarteditor2/upload/")) {
            ?>
            <a class="atag" style="width:auto;float: left;cursor: pointer; padding-left: 5px;margin-top: 10px;" onclick="location.href='baseballpostview.php?no=<?php echo $no_array[5]; ?>'"><b><?php echo $title_array[5];?></b></a>
        <a style="margin-left: 3px;float:left; margin-top : 10px;color: black; font-size: 15px;width: auto"
           href="baseballpostview.php?no=<?php echo $no_array[5]; ?>">
            <?php if ($rc[5] <= 0) {
//                 댓글이 없다면
                ?></a> <?php } else { ?>
                [<?php echo $rc[5]?>]</a>
                <?php
            }?>
            </a>
            <div onclick="location.href='baseballpostview.php?no=<?php echo $no_array[5]; ?>'" style="cursor: pointer;padding-left: 5px;float: left; width: 350px; margin-top: 30px"><?php echo $id_array[5];?></div>
            <div style="float: left; margin-top: 30px;margin-left: 40px" ><?php echo $date_array[5];?></div>
            <?php
        } ?>
    </div>

    <div class="best_post" style="border: 1px solid green">
        <div class="num" style="border-right: 1px solid green"><a style="color: green">2</a></div>
        <!--        만약 사진이 있다면-->
        <?php if (strpos($contents_array[1], "<img src=\"/smarteditor2/upload/")) {
            ?>
            <div class="picture" onclick="location.href='baseballpostview.php?no=<?php echo $no_array[1]; ?>'"><img src="<?php echo $img_array[1]?>" style="width: 148px; height: 90px"></div>
            <div class="best_title" style="float: left"><a style="color: black; font-size: 15px;margin-left: 3px;">
                    <?php if ($rc[1] <= 0) {
                    //                 댓글이 없다면
                    ?></a> <?php } else { ?>
                    [<?php echo $rc[1]?>]</a>
                    <?php
                }?>
                <div style="float: left" onclick="location.href='baseballpostview.php?no=<?php echo $no_array[1]; ?>'" ><b><?php echo $title_array[1];?></b></div></div>
            <div class="best_nick" onclick="location.href='baseballpostview.php?no=<?php echo $no_array[1]; ?>'"><?php echo $id_array[1];?></div>
            <div class="best_date"><?php echo $date_array[1];?></div>
            <!--            사진이 없다면-->
        <?php } else if (!strpos($img_array[1], "<img src=\"/smarteditor2/upload/")) {
            ?>
            <a class="atag" style="width:auto;float: left;cursor: pointer; padding-left: 5px;margin-top: 10px;" onclick="location.href='baseballpostview.php?no=<?php echo $no_array[1]; ?>'"><b><?php echo $title_array[1];?></b></a>
        <a style="margin-left: 3px;float:left; margin-top : 10px;color: black; font-size: 15px;width: auto"
           href="baseballpostview.php?no=<?php echo $no_array[1]; ?>">
            <?php if ($rc1 <= 0) {
//                 댓글이 없다면
                ?></a> <?php } else { ?>
                [<?php echo $rc1?>]</a>
                <?php
            }?>
            </a>
            <div onclick="location.href='baseballpostview.php?no=<?php echo $no_array[1]; ?>'" style="cursor: pointer;padding-left: 5px;float: left; width: 350px; margin-top: 30px"><?php echo $id_array[1];?></div>
            <div style="float: left; margin-top: 30px;margin-left: 40px" ><?php echo $date_array[1];?></div>
            <?php
        } ?>
    </div>

    <div class="best_post">
        <div class="num">7</div>
        <!--        만약 사진이 있다면-->
        <?php if (strpos($contents_array[6], "<img src=\"/smarteditor2/upload/")) {
            ?>
            <div class="picture" onclick="location.href='baseballpostview.php?no=<?php echo $no_array[6]; ?>'"><img src="<?php echo $img_array[6]?>" style="width: 148px; height: 90px"></div>
            <div class="best_title" style="float: left"><a style="color: black; font-size: 15px;margin-left: 3px;">
                    <?php if ($rc[6] <= 0) {
                    //                 댓글이 없다면
                    ?></a> <?php } else { ?>
                    [<?php echo $rc[6]?>]</a>
                    <?php
                }?>
                <div style="float: left" onclick="location.href='baseballpostview.php?no=<?php echo $no_array[6]; ?>'" ><b><?php echo $title_array[6];?></b></div></div>
            <div class="best_nick" onclick="location.href='baseballpostview.php?no=<?php echo $no_array[6]; ?>'"><?php echo $id_array[6];?></div>
            <div class="best_date"><?php echo $date_array[6];?></div>
            <!--            사진이 없다면-->
        <?php } else if (!strpos($img_array[6], "<img src=\"/smarteditor2/upload/")) {
            ?>
            <a class="atag" style="width:auto;float: left;cursor: pointer; padding-left: 5px;margin-top: 10px;" onclick="location.href='baseballpostview.php?no=<?php echo $no_array[6]; ?>'"><b><?php echo $title_array[6];?></b></a>
        <a style="margin-left: 3px;float:left; margin-top : 10px;color: black; font-size: 15px;width: auto"
           href="baseballpostview.php?no=<?php echo $no_array[6]; ?>">
            <?php if ($rc[6] <= 0) {
//                 댓글이 없다면
                ?></a> <?php } else { ?>
                [<?php echo $rc[6]?>]</a>
                <?php
            }?>
            </a>
            <div onclick="location.href='baseballpostview.php?no=<?php echo $no_array[6]; ?>'" style="cursor: pointer;padding-left: 5px;float: left; width: 350px; margin-top: 30px"><?php echo $id_array[6];?></div>
            <div style="float: left; margin-top: 30px;margin-left: 40px" ><?php echo $date_array[6];?></div>
            <?php
        } ?>
    </div>


    <div class="best_post" style="border: 1px solid green">
        <div class="num" style="border-right: 1px solid green"><a style="color: green">3</a></div>
        <!--        만약 사진이 있다면-->
        <?php if (strpos($contents_array[2], "<img src=\"/smarteditor2/upload/")) {
            ?>
            <div class="picture" onclick="location.href='baseballpostview.php?no=<?php echo $no_array[2]; ?>'"><img src="<?php echo $img_array[2]?>" style="width: 148px; height: 90px"></div>
            <div class="best_title" style="float: left"><a style="color: black; font-size: 15px;margin-left: 3px;">
                    <?php if ($rc[2] <= 0) {
                    //                 댓글이 없다면
                    ?></a> <?php } else { ?>
                    [<?php echo $rc[2]?>]</a>
                    <?php
                }?>
                <div style="float: left" onclick="location.href='baseballpostview.php?no=<?php echo $no_array[2]; ?>'" ><b><?php echo $title_array[2];?></b></div></div>
            <div class="best_nick" onclick="location.href='baseballpostview.php?no=<?php echo $no_array[2]; ?>'"><?php echo $id_array[2];?></div>
            <div class="best_date"><?php echo $date_array[2];?></div>
            <!--            사진이 없다면-->
        <?php } else if (!strpos($img_array[2], "<img src=\"/smarteditor2/upload/")) {
            ?>
            <a class="atag" style="width:auto;float: left;cursor: pointer; padding-left: 5px;margin-top: 10px;" onclick="location.href='baseballpostview.php?no=<?php echo $no_array[2]; ?>'"><b><?php echo $title_array[2];?></b></a>
        <a style="margin-left: 3px;float:left; margin-top : 10px;color: black; font-size: 15px;width: auto"
           href="baseballpostview.php?no=<?php echo $no_array[2]; ?>">
            <?php if ($rc[2] <= 0) {
//                 댓글이 없다면
                ?></a> <?php } else { ?>
                [<?php echo $rc[2]?>]</a>
                <?php
            }?>
            </a>
            <div onclick="location.href='baseballpostview.php?no=<?php echo $no_array[2]; ?>'" style="cursor: pointer;padding-left: 5px;float: left; width: 350px; margin-top: 30px"><?php echo $id_array[2];?></div>
            <div style="float: left; margin-top: 30px;margin-left: 40px" ><?php echo $date_array[2];?></div>
            <?php
        } ?>
    </div>

    <div class="best_post">
        <div class="num">8</div>
        <!--        만약 사진이 있다면-->
        <?php if (strpos($contents_array[7], "<img src=\"/smarteditor2/upload/")) {
            ?>
            <div class="picture" onclick="location.href='baseballpostview.php?no=<?php echo $no_array[7]; ?>'"><img src="<?php echo $img_array[7]?>" style="width: 148px; height: 90px"></div>
            <div class="best_title" style="float: left"><a style="color: black; font-size: 15px;margin-left: 3px;">
                    <?php if ($rc[7] <= 0) {
                    //                 댓글이 없다면
                    ?></a> <?php } else { ?>
                    [<?php echo $rc[7]?>]</a>
                    <?php
                }?>
                <div style="float: left" onclick="location.href='baseballpostview.php?no=<?php echo $no_array[7]; ?>'" ><b><?php echo $title_array[7];?></b></div></div>
            <div class="best_nick" onclick="location.href='baseballpostview.php?no=<?php echo $no_array[7]; ?>'"><?php echo $id_array[7];?></div>
            <div class="best_date"><?php echo $date_array[7];?></div>
            <!--            사진이 없다면-->
        <?php } else if (!strpos($img_array[7], "<img src=\"/smarteditor2/upload/")) {
            ?>
            <a class="atag" style="width:auto;float: left;cursor: pointer; padding-left: 5px;margin-top: 10px;" onclick="location.href='baseballpostview.php?no=<?php echo $no_array[7]; ?>'"><b><?php echo $title_array[7];?></b></a>
        <a style="margin-left: 3px;float:left; margin-top : 10px;color: black; font-size: 15px;width: auto"
           href="baseballpostview.php?no=<?php echo $no_array[7]; ?>">
            <?php if ($rc[7] <= 0) {
//                 댓글이 없다면
                ?></a> <?php } else { ?>
                [<?php echo $rc[7]?>]</a>
                <?php
            }?>
            </a>
            <div onclick="location.href='baseballpostview.php?no=<?php echo $no_array[7]; ?>'" style="cursor: pointer;padding-left: 5px;float: left; width: 350px; margin-top: 30px"><?php echo $id_array[7];?></div>
            <div style="float: left; margin-top: 30px;margin-left: 40px" ><?php echo $date_array[7];?></div>
            <?php
        } ?>
    </div>

    <div class="best_post" style="border: 1px solid mediumseagreen">
        <div class="num" style="border-right: 1px solid mediumseagreen"><a style="color: mediumseagreen">4</a></div>
        <!--        만약 사진이 있다면-->
        <?php if (strpos($contents_array[3], "<img src=\"/smarteditor2/upload/")) {
            ?>
            <div class="picture" onclick="location.href='baseballpostview.php?no=<?php echo $no_array[3]; ?>'"><img src="<?php echo $img_array[3]?>" style="width: 148px; height: 90px"></div>
            <div class="best_title" style="float: left"><a style="color: black; font-size: 15px;margin-left: 3px;">
                    <?php if ($rc[3] <= 0) {
                    //                 댓글이 없다면
                    ?></a> <?php } else { ?>
                    [<?php echo $rc[3]?>]</a>
                    <?php
                }?>
                <div style="float: left" onclick="location.href='baseballpostview.php?no=<?php echo $no_array[3]; ?>'" ><b><?php echo $title_array[3];?></b></div></div>
            <div class="best_nick" onclick="location.href='baseballpostview.php?no=<?php echo $no_array[3]; ?>'"><?php echo $id_array[3];?></div>
            <div class="best_date"><?php echo $date_array[3];?></div>
            <!--            사진이 없다면-->
        <?php } else if (!strpos($img_array[3], "<img src=\"/smarteditor2/upload/")) {
            ?>
            <a class="atag" style="width:auto;float: left;cursor: pointer; padding-left: 5px;margin-top: 10px;" onclick="location.href='baseballpostview.php?no=<?php echo $no_array[3]; ?>'"><b><?php echo $title_array[3];?></b></a>
        <a style="margin-left: 3px;float:left; margin-top : 10px;color: black; font-size: 15px;width: auto"
           href="baseballpostview.php?no=<?php echo $no_array[3]; ?>">
            <?php if ($rc[3] <= 0) {
//                 댓글이 없다면
                ?></a> <?php } else { ?>
                //댓글
                [<?php echo $rc[3]?>]</a>
                <?php
            }?>
            </a>
            <div onclick="location.href='baseballpostview.php?no=<?php echo $no_array[3]; ?>'" style="cursor: pointer;padding-left: 5px;float: left; width: 350px; margin-top: 30px"><?php echo $id_array[3];?></div>
            <div style="float: left; margin-top: 30px;margin-left: 40px" ><?php echo $date_array[3];?></div>
            <?php
        } ?>
    </div>

    <div class="best_post">
        <div class="num">9</div>
        <!--        만약 사진이 있다면-->
        <?php if (strpos($contents_array[8], "<img src=\"/smarteditor2/upload/")) {
            ?>
            <div class="picture" onclick="location.href='baseballpostview.php?no=<?php echo $no_array[8]; ?>'"><img src="<?php echo $img_array[8]?>" style="width: 148px; height: 90px"></div>
            <div class="best_title" style="float: left"><a style="color: black; font-size: 15px;margin-left: 3px;">
                    <?php if ($rc[8] <= 0) {
                    //                 댓글이 없다면
                    ?></a> <?php } else { ?>
                    [<?php echo $rc[8]?>]</a>
                    <?php
                }?>
                <div style="float: left" onclick="location.href='baseballpostview.php?no=<?php echo $no_array[8]; ?>'" ><b><?php echo $title_array[8];?></b></div></div>
            <div class="best_nick" onclick="location.href='baseballpostview.php?no=<?php echo $no_array[8]; ?>'"><?php echo $id_array[8];?></div>
            <div class="best_date"><?php echo $date_array[8];?></div>
            <!--            사진이 없다면-->
        <?php } else if (!strpos($img_array[8], "<img src=\"/smarteditor2/upload/")) {
            ?>
            <a class="atag" style="width:auto;float: left;cursor: pointer; padding-left: 5px;margin-top: 10px;" onclick="location.href='baseballpostview.php?no=<?php echo $no_array[8]; ?>'"><b><?php echo $title_array[8];?></b></a>
        <a style="margin-left: 3px;float:left; margin-top : 10px;color: black; font-size: 15px;width: auto"
           href="baseballpostview.php?no=<?php echo $no_array[8]; ?>">
            <?php if ($rc[8] <= 0) {
//                 댓글이 없다면
                ?></a> <?php } else { ?>
                [<?php echo $rc[8]?>]</a>
                <?php
            }?>
            </a>
            <div onclick="location.href='baseballpostview.php?no=<?php echo $no_array[8]; ?>'" style="cursor: pointer;padding-left: 5px;float: left; width: 350px; margin-top: 30px"><?php echo $id_array[8];?></div>
            <div style="float: left; margin-top: 30px;margin-left: 40px" ><?php echo $date_array[8];?></div>
            <?php
        } ?>
    </div>

    <div class="best_post" style="border: 1px solid mediumseagreen">
        <div class="num" style="border-right: 1px solid mediumseagreen"><a style="color: mediumaquamarine">5</a></div>
        <!--        만약 사진이 있다면-->
        <?php if (strpos($contents_array[4], "<img src=\"/smarteditor2/upload/")) {
            ?>
            <div class="picture" onclick="location.href='baseballpostview.php?no=<?php echo $no_array[4]; ?>'"><img src="<?php echo $img_array[4]?>" style="width: 148px; height: 90px"></div>
            <div class="best_title" style="float: left"><a style="color: black; font-size: 15px;margin-left: 3px;">
                    <?php if ($rc[4] <= 0) {
                    //                 댓글이 없다면
                    ?></a> <?php } else { ?>
                    [<?php echo $rc[4]?>]</a>
                    <?php
                }?>
                <div style="float: left" onclick="location.href='baseballpostview.php?no=<?php echo $no_array[4]; ?>'" ><b><?php echo $title_array[4];?></b></div></div>
            <div class="best_nick" onclick="location.href='baseballpostview.php?no=<?php echo $no_array[4]; ?>'"><?php echo $id_array[4];?></div>
            <div class="best_date"><?php echo $date_array[4];?></div>
            <!--            사진이 없다면-->
        <?php } else if (!strpos($img_array[4], "<img src=\"/smarteditor2/upload/")) {
            ?>
            <a class="atag" style="width:auto;float: left;cursor: pointer; padding-left: 5px;margin-top: 10px;" onclick="location.href='baseballpostview.php?no=<?php echo $no_array[4]; ?>'"><b><?php echo $title_array[4];?></b></a>
        <a style="margin-left: 3px;float:left; margin-top : 10px;color: black; font-size: 15px;width: auto"
           href="baseballpostview.php?no=<?php echo $no_array[4]; ?>">
            <?php if ($rc[4] <= 0) {
//                 댓글이 없다면
                ?></a> <?php } else { ?>
                [<?php echo $rc[4]?>]</a>
                <?php
            }?>
            </a>
            <div onclick="location.href='baseballpostview.php?no=<?php echo $no_array[4]; ?>'" style="cursor: pointer;padding-left: 5px;float: left; width: 350px; margin-top: 30px"><?php echo $id_array[4];?></div>
            <div style="float: left; margin-top: 30px;margin-left: 40px" ><?php echo $date_array[4];?></div>
            <?php
        } ?>
    </div>

    <div class="best_post">
        <div class="num">10</div>
        <!--        만약 사진이 있다면-->
        <?php if (strpos($contents_array[9], "<img src=\"/smarteditor2/upload/")) {
            ?>
            <div class="picture" onclick="location.href='baseballpostview.php?no=<?php echo $no_array[9]; ?>'"><img src="<?php echo $img_array[9]?>" style="width: 148px; height: 90px"></div>
            <div class="best_title" style="float: left"><a style="color: black; font-size: 15px;margin-left: 3px;">
                    <?php if ($rc[9] <= 0) {
                    //                 댓글이 없다면
                    ?></a> <?php } else { ?>
                    [<?php echo $rc[9]?>]</a>
                    <?php
                }?>
                <div style="float: left" onclick="location.href='baseballpostview.php?no=<?php echo $no_array[9]; ?>'" ><b><?php echo $title_array[9];?></b></div></div>
            <div class="best_nick" onclick="location.href='baseballpostview.php?no=<?php echo $no_array[9]; ?>'"><?php echo $id_array[9];?></div>
            <div class="best_date"><?php echo $date_array[9];?></div>
            <!--            사진이 없다면-->
        <?php } else if (!strpos($img_array[9], "<img src=\"/smarteditor2/upload/")) {
            ?>
            <a class="atag" style="width:auto;float: left;cursor: pointer; padding-left: 5px;margin-top: 10px;" onclick="location.href='baseballpostview.php?no=<?php echo $no_array[9]; ?>'"><b><?php echo $title_array[9];?></b></a>
        <a style="margin-left: 3px;float:left; margin-top : 10px;color: black; font-size: 15px;width: auto"
           href="baseballpostview.php?no=<?php echo $no_array[9]; ?>">
            <?php if ($rc[9] <= 0) {
//                 댓글이 없다면
                ?></a> <?php } else { ?>
                [<?php echo $rc[9]?>]</a>
                <?php
            }?>
            </a>
            <div onclick="location.href='baseballpostview.php?no=<?php echo $no_array[9]; ?>'" style="cursor: pointer;padding-left: 5px;float: left; width: 350px; margin-top: 30px"><?php echo $id_array[9];?></div>
            <div style="float: left; margin-top: 30px;margin-left: 40px" ><?php echo $date_array[9];?></div>
            <?php
        } ?>
    </div>

</div>




</body>
</html>