<!DOCTYPE html>

<html>
<head>
    <meta charset = 'utf-8'>
    <title>국내야구갤러리</title>
    <?php include("head.php"); ?>
    <?php session_start(); ?>
</head>
<style>
    table{
        border-top: 1px solid #444444;
        border-collapse: collapse;
    }
    tr{
        border-bottom: 1px solid #444444;
        padding: 10px;
    }
    td{
        border-bottom: 1px solid #efefef;
        padding: 10px;
    }
    table .even{
        background: #efefef;
    }
    .text{
        text-align:center;
        padding-top:20px;
        color:#000000
    }
    .text:hover{
        text-decoration: underline;
    }
    a:link {color : #79AAFF; text-decoration:none;}
    a:hover { text-decoration : underline;}
    a:visited {text-decoration: none; color: #333333;}
    .title {

    }

    .target {
        width: auto;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 450px;
    }



</style>
<body>
<!--게시판 내용 db에서 데이터 가져와서 보여주는 부분-->
<?php
$connect = mysqli_connect('localhost', 'gs', 'Rltp2ekd!', 'db') or die ("connect fail");

$search = $_POST['search'];
$select = $_POST['selectbx'];

// 토탈카운트를 구하기 위함
if ($select == "title") {
    $sql ="select * from baseball where title LIKE '%$search%';";
} else if ($select == "contents") {
    $sql ="select * from baseball where contents LIKE '%$search%'";
} else if ($select == "id") {
    $sql ="select * from baseball where id LIKE '%$search%'";
} else {
    $sql ="select * from baseball";
}
$result = $connect->query($sql);
$result = $connect->query($sql);

$total_count = mysqli_num_rows($result);



$pageNum = ($_GET['page']) ? $_GET['page'] : 1;     //page : default - 1
$list = ($_GET['list']) ? $_GET['list'] : 10;//한 페이지에 보여질 게시글 수

$b_pageNum_list = 5;// 블럭에 나타낼 페이지 번호 개수
$block = ceil($pageNum/$b_pageNum_list); //현재 리스트의 블럭을 구하는 식
$b_start_page = ( ($block - 1) * $b_pageNum_list ) + 1;//현재 블럭에서 시작페이지 번호
$b_end_page = $b_start_page + $b_pageNum_list - 1;//현재 블럭에서 마지막 페이지 번호
$total_page = ceil( ($total_count / $list)); //글의 총 개수 나누기 리스트
$limit = ($pageNum-1) *$list;
$d=$total_page;
$a=$total_count;
if ($b_end_page > $total_page) { $b_end_page = $total_page; }

if ($select == "title") {
    $query = "select * from baseball where title LIKE '%$search%' order by date desc limit $limit, $list";
} else if ($select == "contents") {
    $query = "select * from baseball where contents LIKE '%$search%' order by date desc limit $limit, $list";
} else if ($select == "id") {
    $query = "select * from baseball where id LIKE '%$search%'order by date desc limit $limit, $list";
} else {
    $query = "select * from baseball order by date desc limit $limit, $list";
}
$result = mysqli_query($connect, $query);

//$result = mysqli_query($connect, $query);

?>
<h2 align=center style="margin-top: 30px">국내야구 갤러리</h2>
<table align = center>
    <thead align = "center">
    <tr>
        <td width = "50" align="center">번호</td>
        <td width = "500" align = "center">제목</td>
        <td width = "150" align = "center">작성자</td>
        <td width = "200" align = "center">날짜</td>
        <td width = "50" align = "center">조회</td>
    </tr>
    </thead>

    <tbody>
    <?php

    //    result의 행을 가져와줌. ex) id = ㅇㅇ pw = 12 로 이루어진 데이터를 가져옴
    while($rows = mysqli_fetch_assoc($result)) {
        $no = $rows['no'];
        $getcontents = $rows['contents'];
        $getvideo = $rows['video'];
        $reply = "select * from baseballreply where no = '$no'";
        $replyresult = mysqli_query($connect, $reply);
        $replycnt = mysqli_num_rows($replyresult);


        ?>
        <form method="post" action="baseballpostview.php">
            <td width="50" align="center"><?php echo $rows['no'] ?></td>
            <td class="target" width="500" align="left" id="title">
                <a class="title" href="baseballpostview.php?no=<?php echo $rows['no'] ?>"><?php if (strpos($getcontents, "<img src=\"/smarteditor2/upload/") || $getvideo != "") {
                        ?>  <img src="yesimg.png"> <?php }

                    else {
                        ?>   <img src="noimg.png">

                        <?php
                    }?>
                    <?php echo $rows['title']; ?></a>
                <a name="replycount" style="color: black; font-size: 11px;"
                   href="baseballpostview.php?no=<?php echo $rows['no'] ?>">
                    <?php if ($replycnt <= 0) {
                    ?></a> <?php } else { ?>
                    [<?php echo $replycnt ?>]</a>
                    <?php
                }?>
            </td>
            <td width="100" align="center"><?php echo $rows['id'] ?></td>
            <td width="200" align="center"><?php echo $rows['date'] ?></td>
            <td width="50" align="center"><?php echo $rows['view'] ?></td>
        </form>
        </tr>

        <?php

    }
    ?>
    </tbody>
</table>

<div class = text>
    <button style="cursor: hand; float: right; margin-right: 27%; margin-top: 10px"onClick="location.href='baseballwrite.php'">글쓰기</button>
</div>
<div class="paging" style="margin-left: 49%;margin-top: 50px">
    <?php
    if($pageNum <= 1){?>

        <font size=2  color=red>처음</font>
    <?}else{?>
        <font size=2 ><a href="baseball.php?page=&list=<?=$list?>">처음</a></font>
    <?}
    if($block <=1){?>
        <font> </font>
    <?}else{?>
        <font size=2><a href="baseball.php?page=<?=$b_start_page-1?>&list=<?=$list?>">이전</a></font>

    <?}
    for($j = $b_start_page; $j <=$b_end_page; $j++)
    {
        if($pageNum == $j) //pageNum 와 j 가 같으면 현재 페이지 이므로
        {?>
            <font size=2 color=red><?=$j?></font>
        <?}else{?>
            <font size=2><a href="baseball.php?page=<?=$j?>&list=<?=$list?>"><?=$j?></a></font>
        <?}
    }
    $total_block = ceil($total_page/$b_pageNum_list);

    if($block >= $total_block){?>
        <font> </font>
    <?}else{?>
        <font size=2><a href="baseball.php?page=<?=$b_end_page+1?>&list=<?=$list?>">다음</a></font>
    <?}
    if($pageNum >= $total_page){?>
        <font size=2  color=red>마지막</font>
    <?}else{?>
        <font size=2><a  href="baseball.php?page=<?=$total_page?>&list=<?=$list?>">마지막</a></font>
    <?}

    ?>
</div>


<!--검색-->
<div class="search" style="margin-left: 42%;margin-top: 30px">
    <div class="search-container" style="float:left;">
        <form method="post" action="" style="float:right; margin-left: 5px;margin-top: 2px" name="frm" id="frm"">
        <select id="selectbx" name="selectbx" style="background-color: white; width: 100px; height: 30px; margin-top: 2px">
            <option <?php if ($_POST['selectbx']=="title") {?> selected="selected "<?php } ?> value="title">제목</option>
            <option <?php if ($_POST['selectbx']=="contents") {?> selected="selected "<?php } ?> value="contents">내용</option>
            <option <?php if ($_POST['selectbx']=="id") {?> selected="selected "<?php } ?> value="id">작성자</option>
            <input type="hidden" name="no" value="">
        </select>
        <input type="text" name="search" id="search" value="<?php echo $search?>">
        <button type="submit" style="border: none; width: 33px;margin-bottom: 30px; height: 30px; background-color: #2196f4"><img src="serch.png"></button>
        </form>
        <script>
            function changePage(num) {
                $('#page').val(num);
                $('#frm').submit();
                // ex) 모든 a태그를 찾고 싶을때 >>  $('a')
                // ex) 모든 a태그중에 두번 째를 찾고 싶을 때 >> $('a')[1]
                // ex) 특정 id를 기준으로 태그를 찾고싶을 때 >> $('#아이디')
                // ex) 특정 name을 찾고 싶을 때 >> $('[name=네임값]')
                // ex) 특정 class를 기준으로 찾고 싶을 때 >> $('.클래스명')
                // ex) 특정 input의 type으로 찾고 싶을 때 >> $('input[type=radio]')
            }
        </script>

    </div>
</div>
</body>
</html>