<?php
$connect = mysqli_connect("localhost", "gs", "Rltp2ekd!", "db");


$no = $_POST['no'];
$query = "select * from baseball where no = '$no'";
$result = $connect ->query($query);
$info = mysqli_fetch_assoc($result);

//게시글 삭제하는 함수
mysqli_query($connect, "delete from baseball where no = '$no'");

mysqli_query($connect, "ALTER TABLE baseball AUTO_INCREMENT=1;");
mysqli_query($connect, "set @cnt=0;");
mysqli_query($connect, "update baseball set no = @cnt:=@cnt+1;");
//게시글을 삭제했으니, 그 게시글에 대한 댓글들에다가 이 게시글은 삭제되었다고 바꿔줌
$deletereply = "update baseballreply set isDeleted = 1 where no = '$no'";
$connect ->query($deletereply);
    ?>
    <script>
        alert("관리자 권한으로 게시글이 삭제되었습니다.");
        location.replace('baseball.php');
    </script>
    <?php
mysqli_close($connect);
?>
