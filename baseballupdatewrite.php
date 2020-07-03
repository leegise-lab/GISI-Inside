<!DOCTYPE html>
<html lang="kr">
<head>
    <meta charset="UTF-8">
    <title>기씨인사이드</title>
    <?php session_start(); ?>
    <style>
        .info_text {
            margin: 0 auto;
        }
    </style>
    <?php include ("head.php"); ?>

</head>

<body>
<h1 style="margin-left: 40%; margin-top: 20px">국내야구 갤러리</h1>
<?php
$connect = mysqli_connect("localhost", "gs", "Rltp2ekd!", "db") or die("db 연결 실패");
$no = $_POST['no'];//11
$inputpw = $_POST['pw']; //ql
$query = "select * from baseball where no = '$no'";
$result = $connect ->query($query);
$info = mysqli_fetch_assoc($result);
if ($inputpw != $info['pw']) {
    ?>
    <script>
        alert("비밀번호가 일치하지 않습니다.");
        location.replace('baseball.php');
    </script>

    <?php

} else {
    ?>
    <form name="tx_editor_form" id="tx_editor_form" action="baseballupdateservercheck.php" method="post">
        <div class="info_text" style="margin-top: 20px">
            <input type="text" id="id" name="id" style="margin-left: 30%; height: 30px; width: 300px" placeholder="닉네임" value="<?php echo $info['id']?>">
            <input type="password" id="pw" name="pw" style="margin-left: 10px; height: 30px; width: 300px" placeholder="비밀번호" value="<?php echo $info['pw']?>">
            <input type="hidden" name="date" value="<?php echo $info['date']?>">
            <input type="hidden" name="no" value="<?php echo $info['no']?>">
        </div>
        <div class="info_text">
            <input maxlength="73" type="text" id="title" name="title" style="margin-left: 30%;margin-top: 10px; height: 30px; width: 615px" placeholder="제목을 입력해주세요." value="<?php echo $info['title']?>">
        </div>
        <div style="height:10px;"></div>
        <div style="margin-left: 30%; width:750px;">
            <script type="text/javascript" src="/smarteditor2/js/HuskyEZCreator.js"></script>
            <?
            // DB내 내용 칼럼의 항목을 가져와서 에디터 내에 뿌려 주기 위해 소스 정리한다.
            $content = preg_replace("/\r\n|\n/",'',stripslashes($info[contents]));
            $content = str_replace("'","\'",$content);
            $content = str_replace('"','\"',$content);
            ?>
            <textarea name="content" id="content" rows="10" cols="100" style="width:680px; height:300px; display:none;"></textarea>
            <script type="text/javascript">

                var oEditors = [];

                var sLang = "ko_KR"; // 언어 (ko_KR/ en_US/ ja_JP/ zh_CN/ zh_TW), default = ko_KR



                // 추가 글꼴 목록
                //var aAdditionalFontSet = [["MS UI Gothic", "MS UI Gothic"], ["Comic Sans MS", "Comic Sans MS"],["TEST","TEST"]];



                nhn.husky.EZCreator.createInIFrame({
                    oAppRef: oEditors,
                    elPlaceHolder: "content",
                    sSkinURI: "/smarteditor2/SmartEditor2Skin.html",
                    htParams : {
                        bUseToolbar : true,    // 툴바 사용 여부 (true:사용/ false:사용하지 않음)
                        bUseVerticalResizer : true,  // 입력창 크기 조절바 사용 여부 (true:사용/ false:사용하지 않음)



                        bUseModeChanger : true,   // 모드 탭(Editor | HTML | TEXT) 사용 여부 (true:사용/ false:사용하지 않음)
                        //bSkipXssFilter : true,  // client-side xss filter 무시 여부 (true:사용하지 않음 / 그외:사용)
                        //aAdditionalFontList : aAdditionalFontSet,  // 추가 글꼴 목록
                        fOnBeforeUnload : function(){
                            //alert("완료!");
                        },
                        I18N_LOCALE : sLang
                    }, //boolean
                    fOnAppLoad : function(){
                        //예제 코드
                        oEditors.getById["content"].exec("PASTE_HTML", ["<?=$content?>"]);
                    },
                    fCreator: "createSEditor2"
                });



                function pasteHTML() {
                    var sHTML = "<span style='color:#FF0000;'>이미지도 같은 방식으로 삽입합니다.<\/span>";
                    oEditors.getById["content"].exec("PASTE_HTML", [sHTML]);
                }

                function showHTML() {
                    var sHTML = oEditors.getById["content"].getIR();
                    alert(sHTML);
                }

                function submitContents(elClickedObj) {
                    oEditors.getById["content"].exec("UPDATE_CONTENTS_FIELD", []); // 에디터의 내용이 textarea에 적용됩니다.
                    oEditors2.getById["content_chn"].exec("UPDATE_CONTENTS_FIELD", []); // 에디터의 내용이 textarea에 적용됩니다.

                    // 에디터의 내용에 대한 값 검증은 이곳에서 document.getElementById("content").value를 이용해서 처리하면 됩니다.

                    try {

                        var form2 = document.f;
                        if (!form2.name.value) {
                            alert("작성자 이름을 입력해 주십시오");
                            form2.name.focus();
                            return;
                        }



                        if (!form2.subject.value) {
                            alert("글제목을 입력해 주십시오.");
                            form2.subject.focus();
                            return;
                        }



                        if (document.getElementById("content").value=="<p><br></p>") {
                            alert("내용을 입력해 주세요.");
                            oEditors.getById["content"].exec("FOCUS",[]);
                            return;
                        }



                        form2.action="baseballupdateservercheck.php";
                        //elClickedObj.form.submit();
                        form2.submit();
                    } catch(e) {alert(e);}
                }



                function setDefaultFont() {
                    var sDefaultFont = '궁서';
                    var nFontSize = 24;
                    oEditors.getById["content"].setDefaultFont(sDefaultFont, nFontSize);
                }


                function writeReset() {
                    document.f.reset();
                    oEditors.getById["content"].exec("SET_IR", ["<?=$content?>"]);

                }

            </script>
            <div>동영상 링크 첨부 : <input type="text" name="video"></div>
            <div align="right"><input style="margin-top: 30px;float: left; margin-left: 43%;margin-bottom: 30px" type="submit" onClick="submitContents(this);"  value="등록" /></div>
        </div>
    </form>
    <?php
}

?>

</body>
</html>
