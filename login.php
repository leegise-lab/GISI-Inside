<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>기씨 : 로그인</title>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script type="text/javascript">
        function includeHtml() {
            $("include-html").each(function() {
                element = $(this);
                element.load(element.attr("target"));
            });
        }
    </script>
    <include-html target="head.html"></include-html>
    <script>includeHtml();</script>

</head>
<body>
<div class="login" style="margin-left: 37%; margin-top: 100px">
    <form method="post" action="back/logincheck.php">
        <input type="text" name="id" placeholder="아이디">
        <input type="password" name="pw" placeholder="비밀번호">
        <input type="submit" value="로그인">
    </form>

</div>
</body>
</html>