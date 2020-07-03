<!DOCTYPE html>
<html lang="kr">
<head>
    <meta charset="UTF-8">
    <?php session_start(); ?>
    <script type="text/javascript" src="/smarteditor2/js/HuskyEZCreator.js"></script>
    <title>기씨인사이드</title>

    <style>
        .info_text {
            margin: 0 auto;
        }
    </style>
    <?php include ("head.php"); ?>

</head>

<body>
<?php
$connect = mysqli_connect("localhost", "gs", "Rltp2ekd!", "db");
$id = $_SESSION[id];
$query = "select * from member where id = '$id'";
$result = mysqli_query($connect, $query);
$info = mysqli_fetch_assoc($result);

if (isset($_SESSION['id'])) { ?>
    <h1 style="margin-left: 40%; margin-top: 20px">해외축구 갤러리</h1>
<form name="tx_editor_form" id="tx_editor_form" action="soccerpostserver.php" method="post" accept-charset="utf-8">
    <div class="info_text" style="margin-top: 20px">
        <input maxlength="6" type="text" id="id" name="id" style="margin-left: 350px; height: 30px; width: 300px" placeholder="닉네임" value="<?php echo $info['nick']?>"/>
        <input type="password" id="pw" name="pw" style="margin-left: 10px; height: 30px; width: 300px" placeholder="비밀번호"></div>
    <div class="info_text">
        <input maxlength="30" type="text" id="title" name="title" style="margin-left: 350px;margin-top: 10px; height: 30px; width: 615px" placeholder="제목을 입력해주세요."></div>
    <div style="height:10px;"></div>
    <div style="margin-left: 350px; width:750px;">
        <div>
            <textarea name="content" id="content" rows="10" cols="100" style="width:680px; height:300px; display:none;"></textarea>
            <script language="javascript">
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
                        //oEditors.getById["content"].exec("PASTE_HTML", ["로딩이 완료된 후에 본문에 삽입되는 text입니다."]);
                    },
                    fCreator: "createSEditor2"
                });

                function pasteHTML(filepath) {

// var sHTML = "<span style='color:#FF0000;'>이미지도 같은 방식으로 삽입합니다.<\/span>";
                    var sHTML = '<span style="color:#FF0000;"><img src="'+filepath+'"></span>';
                    oEditors.getById["content"].exec("PASTE_HTML", [sHTML]);

                }

                function showHTML() {
                    var sHTML = oEditors.getById["content"].getIR();
                    alert(sHTML);
                }

                function submitContents(elClickedObj) {
                    oEditors.getById["content"].exec("UPDATE_CONTENTS_FIELD", []); // 에디터의 내용이 textarea에 적용됩니다.
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

                        form2.action="soccerpostserver.php";
                        // elClickedObj.form.submit();
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
                    oEditors.getById["content"].exec("SET_IR", [""]);
                }
            </script>
            <?php echo nl2br($_POST[content]); ?>
</div>
<div align="right"><input style="margin-top: 30px;float: left; margin-left: 43%;margin-bottom: 30px" type="submit" onClick="submitContents(this);"  value="등록" /></div>
</div>
</form>
<?php
} else { ?>
<h1 style="margin-left: 40%; margin-top: 20px">해외축구 갤러리</h1>
<form name="tx_editor_form" id="tx_editor_form" action="soccerpostserver.php" method="post" accept-charset="utf-8">
    <div class="info_text" style="margin-top: 20px">
        <input maxlength="6" type="text" id="id" name="id" style="margin-left: 30%; height: 30px; width: 300px" placeholder="닉네임"/>
        <input type="password" id="pw" name="pw" style="margin-left: 10px; height: 30px; width: 300px" placeholder="비밀번호"></div>
    <div class="info_text">
        <input maxlength="38" type="text" id="title" name="title" style="margin-left: 30%;margin-top: 10px; height: 30px; width: 615px" placeholder="제목을 입력해주세요."></div>
    <div style="height:10px;"></div>
    <div style="margin-left: 30%; width:750px;">
        <div>
            <textarea name="content" id="content" rows="10" cols="100" style="max-width:800px;width:680px; height:300px; display:none;"></textarea>
            <script language="javascript">
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
                        //oEditors.getById["content"].exec("PASTE_HTML", ["로딩이 완료된 후에 본문에 삽입되는 text입니다."]);
                    },
                    fCreator: "createSEditor2"
                });

                function pasteHTML(filepath) {

// var sHTML = "<span style='color:#FF0000;'>이미지도 같은 방식으로 삽입합니다.<\/span>";
                    var sHTML = '<span style="color:#FF0000;"><img src="'+filepath+'"></span>';
                    oEditors.getById["content"].exec("PASTE_HTML", [sHTML]);

                }

                function showHTML() {
                    var sHTML = oEditors.getById["content"].getIR();
                    alert(sHTML);
                }

                function submitContents(elClickedObj) {
                    oEditors.getById["content"].exec("UPDATE_CONTENTS_FIELD", []); // 에디터의 내용이 textarea에 적용됩니다.
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

                        form2.action="soccerpostserver.php";
                        // elClickedObj.form.submit();
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
                    oEditors.getById["content"].exec("SET_IR", [""]);
                }
            </script>
            <?php echo nl2br($_POST[content]); ?>
        </div>
        <div style="float: left">
            <div align="right"><input style="margin-top: 30px;float: left; margin-left: 43%;margin-bottom: 30px" type="submit" onClick="submitContents(this);"  value="등록" /></div>
        </div>
    </div>
</form>
<?php
}?>


</body>
</html>