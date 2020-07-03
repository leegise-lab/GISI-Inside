<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require "PHPMailer-master/src/PHPMailer.php";
require "PHPMailer-master/src/SMTP.php";
require "PHPMailer-master/src/Exception.php";


$connect = mysqli_connect("localhost", "gs", "Rltp2ekd!", "db");

$id = $_POST['id'];
$name = $_POST['name'];
$email = $_POST['email'];

$query = "select * from member where name = '$name' and email ='$email' and id = '$id'";
$result = mysqli_query($connect, $query);
$info = mysqli_fetch_assoc($result);
$getid = $info['id'];
$getpw = $info['pw'];
$getmail = $info['email'];
if ($info != null) {

    $mail = new PHPMailer(true);

    try {
        // 서버세팅
        $mail->SMTPDebug = 0;    // 디버깅 설정
        $mail->isSMTP();               // SMTP 사용 설정

        $mail->Host = "smtp.naver.com";                      // email 보낼때 사용할 서버를 지정
        $mail->SMTPAuth = true;                                // SMTP 인증을 사용함
        $mail->Username = "dlvpslr@naver.com";  // 메일 계정
        $mail->Password = "fkqna0828!";                   // 메일 비밀번호
        $mail->SMTPSecure = "ssl";                             // SSL을 사용함
        $mail->Port = 465;                                        // email 보낼때 사용할 포트를 지정
        $mail->CharSet = "utf-8";                                // 문자셋 인코딩

        // 보내는 메일
        $mail->setFrom("dlvpslr@naver.com", "기씨인사이");

        // 받는 메일
        $mail->addAddress("$getmail", "$id 님");



        // 메일 내용
        $mail->isHTML(true);                                                         // HTML 태그 사용 여부
        $mail->Subject = "기씨인사이드 회원정보입니다..";                  // 메일 제목
        $mail->Body = "요청하신 비밀번호는 \n$getpw\n입니다.";    // 메일 내용

        // 메일 전송
        $mail->send();

        echo "Message has been sent";

    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error : ", $mail->ErrorInfo;
    }
    ?>
    <script>
        alert("입력하신 메일 주소로 비밀번호가 발송되었습니다.");
        location.replace("main.php");
    </script>
    <?php
} else {
    ?>
    <script>
        alert("존재하지 않는 회원정보입니다.");
        location.replace("findidandpw.php");
    </script>
    <?php
}

?>

<?php
