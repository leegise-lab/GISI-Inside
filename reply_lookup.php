<?php session_start();
$id = $_SESSION['id']?>
    <!DOCTYPE html>
    <html>
<head>
    <?php include ("head.php"); ?>
    <style>
        .reply {
            width: 650px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

    </style>

</head>
<body>
<div>
    <div style="margin-top:30px"></div>
    <a style="margin-left:29.7%; padding-right:10px; border-right:1px solid silver; color:black" href="post_lookup.php">내가 작성한 게시글</a>
    <a style="float:right; color:black; margin-right:56.3%" href="reply_lookup.php">내가 작성한 댓글</a>
    <div style="width: 800px; height: auto; margin: 0 auto; margin-top: 30px;margin-bottom: 30px;">

        <div class="reply" style="float:left;width: 700px; text-align:center;">댓글</div>
        <div style="float: right; text-align:center;width: 100px;">작성일</div>
        <hr>

        <?php
        $connect = mysqli_connect('localhost', 'gs', 'Rltp2ekd!', 'db') or die ("connect fail");
        $query = "select * from baseballreply where loginid = '$id'";
        $result = $connect->query($query);
        $total_count = mysqli_num_rows($result);
        $pageNum = ($_POST['page']) ? $_POST['page'] : 1;     //page : default - 1
        //$list = ($_GET['list']) ? $_GET['list'] : 10;//한 페이지에 보여질 게시글 수
        $list = 10;
        $b_pageNum_list = 5;// 블럭에 나타낼 페이지 번호 개수
        $block = ceil($pageNum/$b_pageNum_list); //현재 리스트의 블럭을 구하는 식
        $b_start_page = ( ($block - 1) * $b_pageNum_list ) + 1;//현재 블럭에서 시작페이지 번호
        $b_end_page = $b_start_page + $b_pageNum_list - 1;//현재 블럭에서 마지막 페이지 번호
        $total_page = ceil( ($total_count / $list)); //글의 총 개수 나누기 리스트
        $limit = ($pageNum-1) *$list;
        $d=$total_page;
        $a=$total_count;
        if ($b_end_page > $total_page) { $b_end_page = $total_page; }



        $sql ="select * from baseballreply where loginid = '$id' order by date desc limit $limit, $list";
        $result = $connect->query($sql);
        while($rows = mysqli_fetch_assoc($result)) {
            $reply = $rows['reply'];
            $date = $rows['date'];
            $dates = explode(" ",$date);
            $no = $rows['no'];
            $replyno = $rows['replyno'];
            $isDeleted = $rows['isDeleted'];
            ?>
            <div class="replybx" style="width: 800px;float: left">
                <form method="post" action="mypagereplydelete.php" name="frm">
                <input name="checkbox[]" type="checkbox" style="float:left;width: 18px;height: 18px; margin-top: 2px" value="<?php echo $replyno?>">

                <script>
//                    체크박스 선택 함수
                    function checkbox_value() {
                        var value = document.getElementsByName("checkbox");
                        for (var i=0; i<value.length; i++) {
                            if (value[i].checked) {
                                document.frm.submit();
                            }
                        }
                    }
                </script>
                <a class="reply" style="float: left;color: black;margin-left: 10px;width: 650px;" href="javascript:void(0);" onclick="movePost('<?php echo $no?>');"><?php echo $reply?></a>
                <div style="float: right;text-align:center;width: 100px;"><?php echo $dates[0]?></div>
                <input type="hidden" value="<?php echo $replyno?>" name="replyno">
            </div>

            <?php
        }
        ?>

        <script>
//            삭제된 게시글 확인 함수
            function movePost(no) {
                if ('<?= $isDeleted?>' == 0) {
                    location.href="baseballpostview.php?no=" + no;
                } else if('<?= $isDeleted?>' == 1) {
                    alert("삭제된 게시글입니다.");
                }
            }
        </script>
        <br>
        <input name="checkAll" style="margin-top: 50px; margin-bottom: 30px;" type="checkbox">전체 선택
        <button onclick="checkbox_value();">삭제</button>
        </form>
        <script>
            /* 체크박스 전체선택, 전체해제 */
            $("input[name=checkAll]").click(function () {
                var chk = $(this).is(":checked");
                if (chk) {
                    $("input[name='checkbox[]']").prop("checked", true);//체크박스 전체 선택
                } else {
                    $("input[name='checkbox[]']").prop("checked", false); //체크박스 전체 해지
                }
            });

        </script>

    </div>

</div>
<!--페이징-->
<div class="paging" style="margin-left: 49%;margin-top: 50px; margin-bottom: 30px;">

    <?php
    if($pageNum <= 1){?>

        <font size=2  color=red>처음</font>
    <?}else{?>
        <font size=2 ><a style="color: black" href="javascript:changePage(1)">처음</a></font>
    <?}
    if($block <=1){?>
        <font> </font>
    <?}else{?>
        <font size=2><a style="color: black" href="javascript:changePage(<?=$b_start_page-1?>)">이전</a></font>

    <?}
    for($j = $b_start_page; $j <=$b_end_page; $j++)
    {
        if($pageNum == $j) //pageNum 와 j 가 같으면 현재 페이지 이므로
        {?>
            <font size=2 color=red><?=$j?></font>
        <?}else{?>
            <font size=2><a style="color: black" href="javascript:changePage(<?=$j?>);"><?=$j?></a></font>
        <?}
    }
    $total_block = ceil($total_page/$b_pageNum_list);

    if($block >= $total_block){?>
        <font> </font>
    <?}else{?>
        <font size=2><a style="color: black" onclick="changePage(<?= $b_end_page+1?>)" href="#none">다음</a></font>
    <?}
    if($pageNum >= $total_page){?>
        <font size=2  color=red>마지막</font>
    <?}else{?>
        <font size=2><a style="color: black" onclick="changePage(<?php echo $total_page?>);" href="javascript:void(0);">마지막</a></font>
    <?}

    ?>
</div>
<form method="post" action="reply_lookup.php" style="float:right; margin-left: 5px;margin-top: 2px" name="frm" id="frm">
    <input type="hidden" id="page" name="page" value="">
</form>
<script>
    function changePage(num) {
        document.getElementById('page').value = num;
        $('#frm').submit();
        // ex) 모든 a태그를 찾고 싶을때 >>  $('a')
        // ex) 모든 a태그중에 두번 째를 찾고 싶을 때 >> $('a')[1]
        // ex) 특정 id를 기준으로 태그를 찾고싶을 때 >> $('#아이디')
        // ex) 특정 name을 찾고 싶을 때 >> $('[name=네임값]')
        // ex) 특정 class를 기준으로 찾고 싶을 때 >> $('.클래스명')
        // ex) 특정 input의 type으로 찾고 싶을 때 >> $('input[type=radio]')
    }
</script>

</body>
    </html><?php
