<?php
$a = $_REQUEST[checkbox];
$connect = mysqli_connect("localhost", "gs", "Rltp2ekd!", "db");


for ($i=0; $i<=count($a); $i++) {
    echo $a[$i];
    $query = "delete from baseball where no = '$a[$i]'";
    mysqli_query($connect, $query);
//게시글 삭제하는 함수
    mysqli_query($connect, "delete from baseball where no = '$a[$i]'");

//a.i 1로 초기화
    mysqli_query($connect, "ALTER TABLE baseball AUTO_INCREMENT=1;");
    mysqli_query($connect, "set @cnt=0;");
    mysqli_query($connect, "update baseball set no = @cnt:=@cnt+1;");

//게시글을 삭제했으니, 그 게시글에 대한 댓글들에다가 이 게시글은 삭제되었다고 바꿔줌
    $deletereply = "update baseballreply set isDeleted = 1 where no = '$a[$i]'";
    $connect ->query($deletereply);
}


?>
<script>
    alert("삭제가 완료되었습니다.");
    location.replace('post_lookup.php');
</script>
<?php
?>