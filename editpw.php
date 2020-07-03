<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <?php include ("head.php"); ?>
    <style>
        .input_pw_box {
            width: 250px;
            height: 300px;
            margin-left: 40%;
            margin-top: 30px;
        }
    </style>

    <script>
        function fun2() {

            var obj = document.fr;

            if (obj.nowpw.value =='') {
                alert('현재 비밀번호를 입력하세요');
                obj.nowpw.focus();
                return false;
            }

            if (obj.pw.value == '') {
                alert('새 비밀번호를 입력하세요');
                obj.pw.focus();
                return false;
            }
            else if (obj.pw2.value == '' || obj.pw2.value != obj.pw.value) {
                alert('변경할 비밀번호가 서로 다릅니다.')
                obj.pw2.focus();
                return false;
            }
            else if (obj.pw.value.length < 6 || obj.pw.value.length > 20) {
                alert('비밀번호는 6~20자 영문,숫자로 입력하세요');
                obj.pw.focus();
                return false;
            }

            if (true) {
                document.fr.submit();
            }

        }
        function fun4() {
            var obj = document.fr;

            if (obj.pw2.value == '' || obj.pw.value != obj.pw2.value) {
                document.getElementById("alert_pwd").innerHTML=('<span style="color: red;">비밀번호가 일치하지 않습니다.</span>');

                return;
            } else if (obj.pw2.value.length < 6 || obj.pw.value.length > 21) {
                document.getElementById("alert_pwd").innerHTML=('<span style="color: red;">6~20자 영문, 숫자로 입력해주세요.</span>');
                return;
            }

            else  {
                document.getElementById("alert_pwd").innerHTML=('<span style="color: green;">사용 가능한 비밀번호입니다.</span>');
                return;;
            }
        }
    </script>



</head>
<body>
<div style="margin-top: 30px">
<a name="alert_pwd" style="margin-left: 35%;">비밀번호는 영문, 숫자 6~20자 조합으로 설정해 주시기 바랍니다.</a>
</div>
<div class="input_pw_box">

    <div class="input_pw" >
    <form method="post" action="editpwservercheck.php" name="fr">
        <input style="float: top"type="password" placeholder="현재 비밀번호" name="nowpw">
        <input style="margin-top: 20px"type="password" placeholder="새 비밀번호" name="pw" onkeyup="fun4()">
        <a style="float: left">변경할 비밀번호를 입력해주세요</span></a>
        <input style="margin-top: 20px" type="password" placeholder="새 비밀번호 확인" name="pw2" onkeyup="fun4()">
        <span style="float: left" id="alert_pwd"><span style="color: #777"> 비밀번호를 한번 더 입력해주세요</span></span>
        <input type="hidden" value="<?php echo $_SESSION['id']?>" name="id">
        <input type="button" value="비밀번호 변경" onclick="fun2()" >
    </form>
    </div>
</div>



</body>
</html>

