<!DOCTYPE html>
<html lang="en" xmlns:float="http://www.w3.org/1999/xhtml" xmlns:border-radius="http://www.w3.org/1999/xhtml"
      xmlns:border="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8">
    <?php session_start(); ?>
    <style>
        .navbar-nav {
            margin: 0 auto;
        }
        .modal-header, h4, .close {
            background-color: #5cb85c;
            color:white !important;
            text-align: center;
            font-size: 30px;
            vertical-align: middle;
        }

        .modal-footer {
            background-color: #f9f9f9;
        }

        #myModal {
            margin-top: 8%;
        }

        #gisiinside {
            border: none;
            background-color: #e9ecef;
            font-size: 100px;
        }


    </style>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <?php
    if (!isset($_SESSION['id'])) {

        ?>
        <!--        <button id="gisiinside" onclick="location.href='main.php'"><img src="main.png"></button>-->
        <div class="main" style="margin-bottom:0;padding-left: 0px" >
            <button id="gisiinside" onclick="location.href='main.php'"><img src="main.png" style="width: 1850px; padding-right: 0.5%"></button>
        </div>
        <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
            <div class="collapse navbar-collapse" id="collapsibleNavbar">

                <ul class="navbar-nav">
                    <li class="nav-item"></li>
                    <a class="nav-link" href="main.php">메인 화면</a>
                    <li class="nav-item">
                        <a class="nav-link" href="baseball.php" id="baseball">국내야구 갤러리</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="soccer.php" id="soccer">해외축구 갤러리</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="lol.php" style="margin-right: 100px" id="lol">리그오브레전드 갤러리</a>
                    <li class="nav-item">
                    </li>
                    <li class="nav-item" >
                        <a class="nav-link" id="loginbt"  href="#" style="margin-left: 40px" >로그인</a>
                        <script>
                            $(document).ready(function(){
                                $("#loginbt").click(function(){
                                    $("#myModal").modal();
                                });
                            });
                        </script>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" id="signupbt" href="signup.php" >회원가입</a>
                    </li>
                </ul>

            </div>
        </nav>
        <?php
    } else {
        ?>
        <div class="main" style="margin-bottom:0;padding-left: 0px" >
            <button id="gisiinside" onclick="location.href='main.php'"><img src="main.png" style="width: 1850px; padding-right: 0.5%"></button>
        </div>

        <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
            <div class="collapse navbar-collapse" id="collapsibleNavbar">

                <ul class="navbar-nav">
                    <li class="nav-item"></li>
                    <a class="nav-link" href="main.php">메인 화면</a>
                    <li class="nav-item">
                        <a class="nav-link" href="baseball.php" id="baseball">국내야구 갤러리</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="soccer.php" id="soccer">해외축구 갤러리</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="lol.php" style="margin-right: 100px" id="lol">리그오브레전드 갤러리</a>
                    <li class="nav-item">
                    </li>
                    <li class="nav-item" >
                        <a class="nav-link" id="loginbt"  href="back/logout.php" style="margin-left: 40px" >로그아웃</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" id="signupbt" href="mysample.php" >마이페이지</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://localhost:3000" onclick="window.open(this.href, '_blank', 'width=500px,height=500px,toolbars=no,scrollbars=no'); return false;">채팅</a>
                </ul>

            </div>
        </nav>
        <?php
    }
    ?>
</head>
<body>



<!-- 로그인 Modal창 -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">

            <div class="modal-header" style="padding:20px 20px;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4><span class="glyphicon glyphicon-lock"></span> 닫기 </h4>
            </div>
            <div class="modal-body" style="padding:40px 50px;">
                <form method='post' action="back/logincheck.php" role="form">
                    <div class="form-group">
                        <span class="glyphicon glyphicon-user"></span> Username</label>
                        <input type="text" class="form-control" name="id" placeholder="아이디">
                    </div>
                    <div class="form-group">
                        <span class="glyphicon glyphicon-eye-open"></span> Password</label>
                        <input type="password" class="form-control" name="pw" placeholder="비밀번호">
                    </div>
                    <!--                    <div class="checkbox">-->
                    <!--                        <label><input type="checkbox" value="" checked>Remember me</label>-->
                    <!--                    </div>-->
                    <button type="submit" class="btn btn-success btn-block" value="로그인"><span class="glyphicon glyphicon-off"></span>로그인</button>
                </form>
            </div>
            <div class="modal-footer">
                <p>회원정보를 잊으셨나요? <a href="findidandpw.php">ID/비밀번호 찾기</a></p>
            </div>
        </div>

    </div>
</div>
</div>


</body>
</html>