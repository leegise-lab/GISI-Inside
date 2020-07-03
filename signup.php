<!DOCTYPE html>
<html lang="kr">
<head>
    <meta charset="UTF-8">
    <title>기씨:회원가입</title>
    <style>

        .form-group{
            margin : 0 auto;
        }

        #canclebt {
            background-color: red;
            color: white;
        }

    </style>
    <?php include ("head.php");?>

    <script  src="http://code.jquery.com/jquery-latest.min.js"></script>
    <script>
        function fun1() {
            var obj = document.fr;
            obj.id.focus();
        }
        function fun2() {

            var obj = document.fr;

            if (obj.id.value == '') {
                alert('아이디를 입력하세요');
                obj.id.focus();
                return false;
            }
            else if (obj.id.value.length < 5 || obj.id.value.length > 20) {
                alert('아이디는 5~20자 영문,숫자로 입력하세요');
                obj.id.value = "";
                obj.id.focus();
                return false;
            }

            else if (obj.pw.value == '') {
                alert('비밀번호를 입력하세요');
                obj.pw.focus();
                return false;
            }
            else if (obj.pw2.value == '' || obj.pw2.value != obj.pw.value) {
                alert('비밀번호가 서로 다릅니다.')
                obj.pw2.focus();
                return false;
            }
            else if (obj.pw.value.length < 6 || obj.pw.value.length > 20) {
                alert('비밀번호는 6~20자 영문,숫자로 입력하세요');
                obj.pw.focus();
                return false;
            }
            else if (obj.nick.value == '') {
                alert('닉네임을 입력하세요');
                obj.nick.focus();
                return false;
            }
            else if (obj.name.value == '') {
                alert('이름을 입력하세요');
                obj.name.focus();
                return false;
            }
            else if (obj.email.value == '') {
                alert('이메일을 입력하세요');
                obj.email.focus();
                return false;
            }
            if (true) {
                document.fr.submit();
            }

        }

        function fun3() {
            var obj = document.fr;
            if (obj.id.value.length < 5 || obj.id.value.length > 20) {
                document.getElementById("alert_text").innerHTML=('<span style="color:red;">5~20자 영문, 숫자로 입력해주세요.</span>');
                return;
            }
            // var id = $('#id').val();
            var id = obj.id.value;
            $.ajax({
                url:'idcheck.php',
                type:'POST',
                data:{ id : id},

                success:function(data){
                    if(data){
                        // document.getElementById("alert_text").innerHTML=('<span style="color: green;">사용 가능한 아이디입니다.</span>');
                        document.getElementById("alert_text").innerHTML=(data);
                    }else{
                        document.getElementById("alert_text").innerHTML=(data);
                    }
                },
                error:function(){
                    alert("에러입니다");
                }
            });

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


<article class="container" style="margin-top: 30px" >
    <div class="page-header">
        <div class="col-md-6 col-md-offset-3" style="margin-left: 500px;">
            <h3>회원가입</h3>
        </div>
    </div>
    <div class="col-sm-6 col-md-offset-3" style="margin-left: 300px;">

        <div class="form-group">
            <p>아이디</p>
            <form method="post" action="join.php" role="form" name="fr">
                <input maxlength="20" type="text" class="form-control"name = "id" onkeyup="fun3();" placeholder="아이디를 입력해주세요">
                <span id="alert_text"><span style="color: #777">5~20자 영문, 숫자로 입력해주세요</span></span>
        </div>
        <div class="form-group" >
            <p>비밀번호</p>
            <input maxlength="20" type="password" class="form-control" name = "pw" placeholder="비밀번호를 입력해주세요" onkeyup="fun4()">
            <span>6~20자 영문, 숫자로 입력해주세요</span>
        </div>
        <div class="form-group">
            <p>비밀번호 확인</p>
            <input type="password" class="form-control" placeholder="비밀번호를 한번 더 입력해주세요" onkeyup="fun4()" name="pw2">
            <span id="alert_pwd"><span style="color: #777"> 비밀번호를 한번 더 입력해주세요</span></span>
        </div>
        <div class="form-group">
            <p>닉네임</p>
            <input maxlength="6" type="text" class="form-control" name="nick" placeholder="닉네임을 입력해주세요">
            <span>1~6자로 입력해 주세요</span>
        </div>
        <div class="form-group">
            <p>이름</p>
            <input type="text" class="form-control" placeholder="이름 입력해주세요" name="name">
            <span>ID/PW 분실시 사용되니 정확하게 입력해주세요</span>
        </div>
        <div class="form-group">
            <!--                <label for="email">이메일 주소</label>-->
            <span>이메일</span>
            <input type="email" class="form-control" name="email"  placeholder="이메일 주소를 입력해주세요">
            <span>ID/PW 분실시 사용되니 정확하게 입력해주세요</span>
        </div>

        <!--            <div class="form-group">-->
        <!--                <label>약관 동의</label>-->
        <!--                <div data-toggle="buttons">-->
        <!--                    <label class="btn btn-primary active">-->
        <!--                        <span class="fa fa-check"></span>-->
        <!--                        <input id="agree" type="checkbox" autocomplete="off" checked>-->
        <!--                    </label>-->
        <!--                    <a href="#">이용약관</a>에 동의합니다.-->
        <!--                </div>-->
        <!--            </div>-->

        <div class="form-group text-center">
            <input type="button" class="btn btn-warning" id="canclebt" value="취소" onclick="fun1()">
            <i class="fa fa-times spaceLeft"></i>
            </input>
            <input type="button" id="join-submit" class="btn btn-primary" value="회원가입" onclick="fun2()" >
            <i class="fa fa-check spaceLeft"></i>
            </input>
        </div>
        </form>
    </div>

</article>



</body>
</html>