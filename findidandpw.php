<!DOCTYPE html>
<html>
<head>
<?php include ("head.php"); ?>
    <title>기씨:회원정보 찾기</title>
</head>
<body>

<article class="container" style="margin-top: 30px" >
    <div class="page-header">
        <div class="col-md-6 col-md-offset-3" style="margin-left: 500px;">
            <h2>회원정보 찾기</h2>
        </div>
    </div>
    <div class="col-sm-6 col-md-offset-3" style="margin-left: 300px;">
        <form method="post" action="findid.php">
        <div class="form-group">
            <h3 style="margin-top: 30px">아이디찾기</h3>
            <form method="post" action="join.php" role="form" name="fr">
                <input maxlength="10" type="text" class="form-control"name = "name" placeholder="이름을 입력해주세요">
        </div>
        <div class="form-group" >
            <input maxlength="20" type="email" class="form-control" name = "email" placeholder="이메일을 입력해주세요">
        </div>
        <input type="submit" class="btn btn-warning" value="아이디 찾기" >
        </form>
        <form method="post" action="findpw.php">
        <div class="form-group">
            <h3 style="margin-top: 30px">비밀번호 찾기</h3>
            <input maxlength="10" type="text" class="form-control" name="name" placeholder="이름을 입력해주세요">
        </div>
        <div class="form-group" >
            <input maxlength="20" type="text" class="form-control" name = "id" placeholder="아이디를 입력해주세요">
        </div>
        <div class="form-group" >
            <input maxlength="20" type="email" class="form-control" name = "email" placeholder="이메일을 입력해주세요">
        </div>
            <input type="submit"class="btn btn-warning" value="비밀번호 찾기" >
        </form>
    </div>
</article>








</body>
</html>

