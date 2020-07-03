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
<script>

</script>
<body>
<!--게시판 내용 db에서 데이터 가져와서 보여주는 부분-->
<?php
$search = $_POST['search'];


$connect = mysqli_connect('localhost', 'gs', 'Rltp2ekd!', 'db') or die ("connect fail");
$sql = "select * from baseball where title like '%$search%'";
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

$query = "select * from baseball where title like '%$search%' order by date desc limit $limit, $list";
$result = mysqli_query($connect, $query);

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
        $reply = "select * from baseballreply where no = '$no'";
        $replyresult = mysqli_query($connect, $reply);
        $replycnt = mysqli_num_rows($replyresult);


        ?>
        <form method="post" action="baseballpostview.php">
            <td width="50" align="center"><?php echo $rows['no'] ?></td>
            <td class="target" width="500" align="left" id="title">
                <a class="title" href="baseballpostview.php?no=<?php echo $rows['no'] ?>"><?php if (strpos($getcontents, "<img src=\"/smarteditor2/upload/")) {
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
    <button style="cursor: hand; float: right; margin-right: 25%"onClick="location.href='baseballwrite.php'">글쓰기</button>
</div>
<div class="paging" style="margin-left: 49%;margin-top: 50px">
    <?php
    if($pageNum <= 1){?>

        <font size=2  color=red>처음</font>
    <?}else{?>
        <font size=2 ><a href="baseballsearch.php?page=&list=<?=$list?>">처음</a></font>
    <?}
    if($block <=1){?>
        <font> </font>
    <?}else{?>
        <font size=2><a href="baseballsearch.php?page=<?=$b_start_page-1?>&list=<?=$list?>">이전</a></font>

    <?}
    for($j = $b_start_page; $j <=$b_end_page; $j++)
    {
        if($pageNum == $j) //pageNum 와 j 가 같으면 현재 페이지 이므로
        {?>
            <font size=2 color=red><?=$j?></font>
        <?}else{?>
            <font size=2><a href="baseballsearch.php?page=<?=$j?>&list=<?=$list?>"><?=$j?></a></font>
        <?}
    }
    $total_block = ceil($total_page/$b_pageNum_list);

    if($block >= $total_block){?>
        <font> </font>
    <?}else{?>
        <font size=2><a href="baseballsearch.php?page=<?=$b_end_page+1?>&list=<?=$list?>">다음</a></font>
    <?}
    if($pageNum >= $total_page){?>
        <font size=2  color=red>마지막</font>
    <?}else{?>
        <font size=2><a href="baseballsearch.php?page=<?=$total_page?>&list=<?=$list?>">마지막</a></font>
    <?}

    ?>
</div>


<div class="search" style="margin-left: 42%;margin-top: 30px">
    <div class="search-container" style="float:left;">

        <select name="select" style="background-color: white; width: 100px; height: 30px; margin-top: 2px">
            <option value="title">제목</option>
            <option value="contents">내용</option>
            <option value="id">작성자</option>

        </select>
        <form action="" style="float:right; margin-left: 5px;margin-top: 2px">
            <input type="text"  name="search" id="search">
            <button type="submit" style="border: none; width: 33px;margin-bottom: 30px; height: 30px; background-color: #2196f4"><img src="serch.png"></button>
        </form>

    </div>
</div>
</body>
</html>

