<?php
SESSION_START();
session_destroy();
?>
<html>
<head>
    <meta charset="utf-8" />
    <title> 로그아웃 </title>
</head>
<body>
<script>
    alert('로그아웃을 완료하였습니다.');
    location.replace("../main.php");
</script>
</body>
</html>
