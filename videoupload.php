
<form method="post" name="form1">
    <input type="hidden" name="ucc_url">
    제목 : <input style="WIDTH: 500px" maxlength="100" name="title">
    <button onclick="youtube_open();" class="btn_100">동영상 첨부</button>
</form>
<div><input onclick="check_in();" type="button" value="글저장"></div>
<form method="post" name="form2">
    <input type="hidden" name="title">
</form>
<script language="javascript">
    function youtube_open(){
        if(document.form1.title.value==''){
            alert('제목을 먼저 입력해주세요.\n유튜브 영상에 표시될 제목입니다.');
            document.form1.title.focus();
            return;
        }
        f = document.form2;
        window.open('','youtPop','width=400,height=300');
        f.target = 'youtPop';
        f.action = 'youtube_upload.php';
        f.title.value=document.form1.title.value;
        f.submit();
    }

    function check_in(){
        if(document.form1.ucc_url.value==''){
            alert('영상을 첨부해주세요.');
            return;
        }
        document.form1.action='ok.php';
        document.form1.submit();
    }
</script>