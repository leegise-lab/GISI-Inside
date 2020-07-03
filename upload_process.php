<?php
echo "confirm file information <br />";
$uploadfile = $_FILES['upload'] ['name'];
if(move_uploaded_file($_FILES['upload']['tmp_name'],$uploadfile)){
    echo "파일이 업로드 되었습니다.<br />";
    echo "<img src ={$_FILES['upload']['name']}> <p>";
    echo "1. file name : {$_FILES['upload']['name']}<br />";
    echo "2. file type : {$_FILES['upload']['type']}<br />";
    echo "3. file size : {$_FILES['upload']['size']} byte <br />";
    echo "4. temporary file name : {$_FILES['upload']['size']}<br />";
} else {
    echo "파일 업로드 실패 !! 다시 시도해주세요.<br />";
}
?>